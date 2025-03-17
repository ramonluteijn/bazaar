<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Order;

class AgendaController
{
    public function index()
    {
        $orders = Order::query()->whereHas('orderDetails.advertisement', function ($query) {
            $query->where('type', 'hire');
        })->where('user_id', auth()->id())->with('orderDetails.advertisement')->paginate(1, ['*'], 'ordersPage');

        if(!auth()->user()->hasRole("user")) {
            $advertisements = Advertisement::query()->where('user_id', auth()->id())->paginate(1, ['*'], 'adsPage');
        }

        return view('agenda.index', ['orders' => $orders, 'advertisements' => $advertisements ?? null]);
    }
}
