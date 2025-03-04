<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\ContentPage;
use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    private PageService $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }
    public function index()
    {
        $user = Auth::user();
        $fonts = collect($this->pageService->getGoogleFonts())->pluck('family', 'family');
        $page = $this->pageService->getCustomPageWithBlocks($user->id);
        return view('account.index', ['page' => $page, 'fonts' => $fonts]);
    }

    public function store(Request $request)
    {
        $this->pageService->saveCustomPage($request);
        return to_route('pages.index');
    }

    public function show($parent = null, $child = null, $grandchild = null)
    {
        $url = request()->path();
        preg_match('/pages\/(.*)/', $url, $url);
        $pages = ContentPage::where('url', $url[1])->firstOrFail();
        if ($pages->url === 'home') {
            return to_route('home.index');
        }

        $advertisements = Advertisement::where('user_id', $pages->user_id)->get();

        return view('pages.show', ['pages' => $pages, 'advertisements' => $advertisements]);
    }
}
