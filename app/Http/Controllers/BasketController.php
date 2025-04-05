<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Services\BasketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController
{
    private BasketService $basketService;
    public function __construct()
    {
        $this->basketService = new BasketService();
    }

    public function show()
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        $advertisementIds = array_keys($basket);
        $advertisements = Advertisement::whereIn('id', $advertisementIds)->get();

        $advertisementsWithCount = $advertisements->map(function ($advertisement) use ($basket) {
            return [
                'advertisement' => $advertisement,
                'count' => $basket[$advertisement->id],
            ];
        });
        return view('basket.show', ['advertisements' => $advertisementsWithCount]);
    }

    public function update(Request $request, $id)
    {
        $basket = $this->basketService->updateBasket($id, $request->action);
        Cookie::queue('basket', json_encode($basket), 10080); // Store for 7 days
        return redirect()->route('basket.show');
    }

    public function checkout(Request $request)
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        session(['basket' => $basket]);
        return view('basket.checkout');
    }

    public function addExpiredBidsToCart()
    {
        $expiredBids = $this->basketService->checkExpiredBids(auth()->id());
        $basket = $this->basketService->addExpiredBidToCart($expiredBids);
        Cookie::queue('basket', json_encode($basket), 10080);
    }
}
