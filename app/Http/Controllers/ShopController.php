<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Services\AdvertisementService;

class ShopController extends Controller
{
    private AdvertisementService $advertisementService;

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index()
    {
        $advertisers = $this->advertisementService->getAdvertisers();
        $advertisements = Advertisement::all()->where('expires_at' , '>', now());
        return view('shop.index', ['advertisers' => $advertisers, 'advertisements' => $advertisements]);
    }
}
