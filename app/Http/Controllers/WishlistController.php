<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use App\Models\User;

class WishlistController
{
    private $wishlistService;
    public function __construct(WishlistService $wishlistService )
    {
        $this->wishlistService = $wishlistService;
    }

    public function index(){

        $wishlist = $this->wishlistService->getWishlist(auth()->id());

        return view('livewire.wishlist-show', ['wishlist' => $wishlist]);
    }
}
