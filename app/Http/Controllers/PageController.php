<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Advertisement;
use App\Models\ContentPage;
use App\Services\PageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PageController
{
    private PageService $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(): View
    {
        $pages = ContentPage::with('user')->select(['title', 'url', 'user_id'])->get();
        return view('pages.index', ['pages' => $pages]);
    }

    public function show(): View
    {
        $user = Auth::user();
        $fonts = collect($this->pageService->getGoogleFonts())->pluck('family', 'family');
        $page = $this->pageService->getCustomPageWithBlocks($user->id);
        return view('pages.show', ['page' => $page, 'fonts' => $fonts]);
    }

    public function store(PageRequest $request): RedirectResponse
    {
        $this->pageService->saveCustomPage($request);
        return to_route('pages.show');
    }

    public function showFromUrl($parent = null, $child = null, $grandchild = null): RedirectResponse|View
    {
        $url = request()->path();
        preg_match('/pages\/(.*)/', $url, $url);
        $pages = ContentPage::where('url', $url[1])->firstOrFail();
        if ($pages->url === 'home') {
            return to_route('home.index');
        }

        $advertisements = Advertisement::where('user_id', $pages->user_id)->get();

        return view('pages.show-from-url', ['pages' => $pages, 'advertisements' => $advertisements]);
    }
}
