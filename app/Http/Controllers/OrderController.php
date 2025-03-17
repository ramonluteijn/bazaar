<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Support\Facades\Cookie;

class OrderController
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::all();
        return view('order.index', ['orders' => $orders]);
    }

    public function show($id)
    {
        $order = Order::with('orderDetails.advertisement')->findOrFail($id);
        return view('order.show', ['order' => $order]);
    }

    public function createOrder()
    {
        return view('account.order');
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->storeOrder($request);
        Cookie::queue(Cookie::forget('basket'));
        return to_route('orders.index');
    }
}

