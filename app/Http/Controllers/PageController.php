<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Advertisement;
use App\Models\ContentPage;
use App\Services\AdvertisementService;
use App\Services\PageService;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController
{
    private PageService $pageService;
    private AdvertisementService $advertisementService;
    private SearchService $searchService;
    private $types = ['newest' => 'New to old', 'oldest' => 'Old to new', 'highest' => 'High to low', 'lowest' => 'Low to high'];
    private $adTypes = ['hire' => 'hire', 'sale' => 'sale', 'bid' => 'bid'];
    public function __construct(PageService $pageService, AdvertisementService $advertisementService, SearchService $searchService)
    {
        $this->pageService = $pageService;
        $this->advertisementService = $advertisementService;
        $this->searchService = $searchService;
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

    public function showFromUrl(Request $request, $parent = null, $child = null, $grandchild = null): RedirectResponse|View
    {
        $url = request()->path();
        preg_match('/pages\/(.*)/', $url, $url);
        $pages = ContentPage::where('url', $url[1])->firstOrFail();
        if ($pages->url === 'home') {
            return to_route('home.index');
        }

        $query = $this->advertisementService->getSortedAdvertisements($request->selectSorting ?? 'newest')->where('user_id', $pages->user_id);

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has("search") && $request->search != '') {
           $this->searchService->search($query, $request->search, Advertisement::class);
        }

        $advertisements = $query->paginate(12)->appends(request()->query());
        $bindings = array_keys($request->query(), $url);

        return view('pages.show-from-url', ['pages' => $pages, 'advertisements' => $advertisements, 'types' => $this->types, 'adTypes' => $this->adTypes, 'bindings' => $bindings]);
    }
}
