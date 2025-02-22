<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\User;

class ShopController extends Controller
{
    public function index()
    {
        $advertisers = User::whereHas("roles", function($q){
            $q->where("name", "private_advertiser")->orWhere("name", "business_advertiser");
        })->get();

        $advertisements = Advertisement::all()->where('expires_at' , '>', now());
        return view('shop.shop', ['advertisers' => $advertisers, 'advertisements' => $advertisements]);
    }
}
