<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController
{
    private OrderService $orderService;
    private array $types = ['incoming' => 'incoming', 'outgoing' => 'outgoing'];

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        if(auth()->user()->hasRole('user')) {
            $orders = Order::where('user_id', auth()->id())->paginate(10);
        }
        else {
            if($request->has('selectType') && $request->selectType == 'incoming') {
                $orders = Order::whereHas('orderDetails.advertisement', function ($query) {
                    $query->where('user_id', auth()->id());
                })->paginate(10);
            }
            elseif($request->has('selectType') && $request->selectType == 'outgoing') {
                $orders = Order::where('user_id', auth()->id())->paginate(10);
            }
            else {
                $orders = Order::whereHas('orderDetails.advertisement', function ($query) {
                    $query->where('user_id', auth()->id());
                })->orWhere('user_id', auth()->id())->paginate(10);
            }
        }
        return view('order.index', ['orders' => $orders, 'types' => $this->types]);
    }

    public function show($id)
    {
        $order = Order::with('orderDetails.advertisement')->findOrFail($id);
        return view('order.show', ['order' => $order]);
    }

    public function store(OrderRequest $request)
    {
        $this->orderService->storeOrder($request);
        Cookie::queue(Cookie::forget('basket'));
        return to_route('orders.index');
    }
}

