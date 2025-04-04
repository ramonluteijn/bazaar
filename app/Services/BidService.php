<?php

namespace App\Services;

use App\Models\Advertisement;
use App\Models\Bid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BidService
{
    public function placeBid($advertisementId, $userId, $bidAmount)
    {
        $advertisement = Advertisement::findOrFail($advertisementId);

        if (now()->greaterThan($advertisement->expires_at)) {
            throw new \Exception(__('The bidding period has ended.'));
        }
        if ($bidAmount <= $advertisement->price) {
            return redirect()->back()->withErrors(['bid_amount' => __('The bid amount must be higher than the advertisement price.')]);
        }
        if ($advertisement->buyout_price && $bidAmount >= $advertisement->buyout_price) {
            // Set the auction expiration date to now
            $advertisement->expires_at = Carbon::now();
            $advertisement->save();
        } else {
            $highestBid = $advertisement->bids()->max('amount');

            if ($bidAmount <= $highestBid) {
                throw new \Exception(__('The bid amount must be higher than the current highest bid.'));
            }
        }


        return DB::transaction(function () use ($advertisementId, $userId, $bidAmount) {
            return Bid::create([
                'advertisement_id' => $advertisementId,
                'user_id' => $userId,
                'amount' => $bidAmount,
            ]);
        });
    }
}
