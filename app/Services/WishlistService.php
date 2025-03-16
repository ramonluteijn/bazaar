<?php

namespace App\Services;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistService
{
    public function addWishlist( $advertisement_id)
    {
        Auth::User()->fetchWishlistProducts()->attach($advertisement_id);
    }
    public function removeWishlist($advertisement_id)
    {
        Auth::User()->fetchWishlistProducts()->detach($advertisement_id);
        }
}
