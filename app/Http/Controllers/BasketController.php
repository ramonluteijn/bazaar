<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class BasketController
{
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
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        if ($request->action === 'increase') {
            $basket[$id]++;
        } elseif ($request->action === 'decrease' && $basket[$id] > 1) {
            $basket[$id]--;
        } elseif ($request->action === 'delete') {
            unset($basket[$id]);
        }
        Cookie::queue('basket', json_encode($basket), 10080); // Store for 7 days
        return redirect()->route('basket.show');
    }

    public function checkout(Request $request)
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        session(['basket' => $basket]);
        return view('basket.checkout');
    }

    public function checkExpiredBids()
    {
        $userId = auth()->id();
        $basket = json_decode(Cookie::get('basket'), true) ?? [];

        $expiredBids = Advertisement::where('type', 'bid')
            ->where('expires_at', '<', now())
            ->whereHas('bids', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->orderBy('amount', 'desc')
                    ->limit(1);
            })
            ->whereDoesntHave('orderDetails', function ($query) use ($userId) {
                $query->where('user_id', $userId)
                    ->whereDoesntHave('advertisement', function ($query) {
                        $query->whereColumn('advertisement_id', 'advertisements.id');
                    });
            })
            ->get()
            ->filter(function ($advertisement) use ($basket) {
                return !isset($basket[$advertisement->id]);
            });

        return $expiredBids;
    }

    public function addExpiredBidsToCart()
    {
        $expiredBids = $this->checkExpiredBids();
        $basket = json_decode(Cookie::get('basket'), true) ?? [];

        foreach ($expiredBids as $bid) {
            $advertisementId = $bid->id;
            if (!isset($basket[$advertisementId])) {
                $basket[$advertisementId] = 1;
            }
        }

        Cookie::queue('basket', json_encode($basket), 10080);
    }
}
