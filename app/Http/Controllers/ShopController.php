<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Illuminate\Contracts\View\View;

class ShopController
{
    private AdvertisementService $advertisementService;

    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index(): View
    {
        $advertisers = $this->advertisementService->getAdvertisers();
        $advertisements = Advertisement::all()->where('expires_at' , '>', now());
        return view('shop.index', ['advertisers' => $advertisers, 'advertisements' => $advertisements]);
    }
}
