<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShopController
{
    private AdvertisementService $advertisementService;
    private $types = ['newest' => 'New to old', 'oldest' => 'Old to new', 'highest' => 'High to low', 'lowest' => 'Low to high'];
    private $adTypes = ['hire' => 'hire', 'sale' => 'sale', 'bid' => 'bid'];

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index(Request $request): View
    {
        $query = $this->advertisementService->getSortedAdvertisements($request->selectSorting ?? 'newest');

        $this->advertisementService->applyFilters($request, $query);

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
