<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;

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
        $order = Order::findOrFail($id);
        return view('orders.show', ['order' => $order]);
    }

    public function createOrder()
    {
        return view('account.order');
    }

    public function storeOrder(OrderRequest $request)
    {
        $this->orderService->storeOrder($request);
        return to_route('orders.index');
    }
}

