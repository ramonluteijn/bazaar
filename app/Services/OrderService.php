<?php

namespace App\Services;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderService
{
    public function storeOrder(OrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Order::create($data);

        $order = Order::latest()->first();
        $orderDetailData['order_id'] = $order->id;
        $orderDetailData['advertisement_id'] = $request->advertisement_id;
        OrderDetail::create($orderDetailData);
    }
}
