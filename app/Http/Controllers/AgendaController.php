<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AgendaController
{
    public function index()
    {
        $orders = Order::whereHas('orderDetails.advertisement', function ($query) {
            $query->where('type', 'hire');
        })->where('user_id', auth()->id())->with('orderDetails.advertisement')->get();

        return view('agenda.index', ['orders' => $orders]);
    }
}
