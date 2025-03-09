<?php

namespace App\Services;

use App\Models\Wishlist;

class WishlistService
{

    public function getWishlist($user_id)
    {
        return Wishlist::where('user_id', $user_id)
            ->with('advertisement')
            ->get()
            ->pluck('advertisement');
    }
}
