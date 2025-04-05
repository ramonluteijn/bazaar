<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Services\AdvertisementService;
use App\Services\SearchService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShopController
{
    private AdvertisementService $advertisementService;
    private SearchService $searchService;
    private $types = ['newest' => 'New to old', 'oldest' => 'Old to new', 'highest' => 'High to low', 'lowest' => 'Low to high'];
    private $adTypes = ['hire' => 'hire', 'sale' => 'sale', 'bid' => 'bid'];

    public function __construct(AdvertisementService $advertisementService, SearchService $searchService)
    {
        $this->advertisementService = $advertisementService;
        $this->searchService = $searchService;
    }

    public function index(Request $request): View
    {
        $query = $this->advertisementService->getSortedAdvertisements($request->selectSorting ?? 'newest');

        if ($request->has('type') && $request->type != '') {
            $query->where('type', $request->type);
        }

        if ($request->has("search") && $request->search != '') {
            $this->searchService->search($query, $request->search, Advertisement::class);
        }

        $advertisements = $query->paginate(12)->appends(request()->query());
        $bindings = array_keys(request()->query());

        $advertisers = $this->advertisementService->getAdvertisers();
        return view('shop.index', [
            'advertisers' => $advertisers,
            'advertisements' => $advertisements,
            'types' => $this->types,
            'adTypes' => $this->adTypes,
            'bindings' => $bindings,
        ]);
    }
}
