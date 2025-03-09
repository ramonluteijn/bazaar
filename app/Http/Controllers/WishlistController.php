<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use App\Services\WishlistService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WishlistController
{
    private $wishlistService;
    public function __construct(WishlistService $wishlistService )
    {
        $this->wishlistService = $wishlistService;
    }

    public function index(){

        $wishlist = Auth::user()->fetchWishlistProducts;
        return view('livewire.wishlist-show', ['wishlist' => $wishlist]);
    }

    public function delete($id){
        Auth::user()->fetchWishlistProducts()->detach($id);
        return redirect()->back();
    }
}
