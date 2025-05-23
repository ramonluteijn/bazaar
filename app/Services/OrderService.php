<?php

namespace App\Services;
use App\Http\Requests\OrderRequest;
use App\Models\Advertisement;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderService
{
    public function storeOrder(OrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Retrieve the basket from the session
        $basket = session('basket', []);

        // Calculate the total sum of the items in the basket
        $total = 0;
        foreach ($basket as $advertisementId => $quantity) {
            $advertisement = Advertisement::find($advertisementId);
            if ($advertisement) {
                $total += $advertisement->price * $quantity;
            }
        }

        // Add the total sum to the order data
        $data['total'] = $total;
        $data['status'] = 'pending';
        $order = Order::create($data);
        // Create OrderDetail entries for each item in the basket
        foreach ($basket as $advertisementId => $quantity) {
            $orderDetailData = [
                'order_id' => $order->id,
                'advertisement_id' => $advertisementId,
                'amount' => $quantity, // Ensure 'amount' is included
            ];
            OrderDetail::create($orderDetailData);
        }
    }

    public function getHiredOrders()
    {
        $orders = Order::query()->whereHas('orderDetails.advertisement', function ($query) {
            $query->where('type', 'hire');
        })->where('user_id', auth()->id())->with('orderDetails.advertisement')->paginate(10, ['*'], 'ordersPage');
        return $orders;
    }

    public function getIncomingOrders()
    {
        return Order::whereHas('orderDetails.advertisement', function ($query) {
            $query->where('user_id', auth()->id());
        })->paginate(10);
    }

    public function getOutgoingOrders()
    {
        return  Order::where('user_id', auth()->id())->paginate(10);
    }

    public function getOwnOrders()
    {
        return Order::whereHas('orderDetails.advertisement', function ($query) {
            $query->where('user_id', auth()->id());
        })->orWhere('user_id', auth()->id())->paginate(10);
    }
}
