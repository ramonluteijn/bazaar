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
                $orders = $this->orderService->getIncomingOrders();
            }
            elseif($request->has('selectType') && $request->selectType == 'outgoing') {
                $orders = $this->orderService->getOutgoingOrders();
            }
            else {
                $orders = $this->orderService->getOwnOrders();
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

