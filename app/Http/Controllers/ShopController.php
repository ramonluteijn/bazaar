<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShopController
{
    private AdvertisementService $advertisementService;
    private $types = ['newest' => 'New to old', 'oldest' => 'Old to new', 'highest' => 'High to low', 'lowest' => 'Low to high'];

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index(Request $request): View
    {
        if($request->selectSorting)
        {
            $advertisements = $this->advertisementService->getSortedAdvertisements($request->selectSorting);
        }
        else
        {
            $advertisements = $this->advertisementService->getSortedAdvertisements('newest');
        }
        $advertisers = $this->advertisementService->getAdvertisers();
        return view('shop.index', ['advertisers' => $advertisers, 'advertisements' => $advertisements, 'types' => $this->types]);
    }
}
