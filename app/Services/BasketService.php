<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Support\Facades\Cookie;

class BasketService
{
    public function updateBasket($id, $action)
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        if ($action === 'increase') {
            $basket[$id]++;
        } elseif ($action === 'decrease' && $basket[$id] > 1) {
            $basket[$id]--;
        } elseif ($action === 'delete') {
            unset($basket[$id]);
        }
        return $basket;
    }

    public function checkExpiredBids($userId)
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

    public function addExpiredBidToCart($expiredBids)
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];

        foreach ($expiredBids as $bid) {
            $advertisementId = $bid->id;
            if (!isset($basket[$advertisementId])) {
                $basket[$advertisementId] = 1;
            }
        }
        return $basket;
    }
}
