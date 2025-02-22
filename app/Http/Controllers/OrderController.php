<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\OrderService;

class OrderController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::all();
        return view('account.orders', ['orders' => $orders]);
    }

    public function order($id)
    {
        $order = Order::findOrFail($id);
        return view('account.order', ['order' => $order]);
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

