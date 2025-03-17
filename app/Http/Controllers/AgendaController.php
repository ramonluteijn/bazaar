<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Order;
use Illuminate\Http\Request;

class AgendaController
{
    private $types = ['hire' => 'hire', 'sale' => 'sale', 'bid' => 'bid'];

    public function index(Request $request)
    {
        $tables = [
            'orders' => 'orders',
        ];
        if(!auth()->user()->hasRole('user')) {
            $tables['advertisements'] = 'advertisements';
        }

        if($request->has('selectTable') && $request->selectTable == 'orders') {
            $orders = Order::query()->whereHas('orderDetails.advertisement', function ($query) {
                $query->where('type', 'hire');
            })->where('user_id', auth()->id())->with('orderDetails.advertisement')->paginate(10, ['*'], 'ordersPage');
        }
        if($request->has('selectTable') && $request->selectTable == 'advertisements') {
            if ($request->selectType == '') {
                $advertisements = Advertisement::query()->where('user_id', auth()->id())->paginate(10, ['*'], 'adsPage');
            }
            else {
                $advertisements = Advertisement::query()->where('user_id', auth()->id())->where('type', $request->selectType)->paginate(10, ['*'], 'adsPage');
            }
        }

        return view('agenda.index', ['orders' => $orders ?? null, 'advertisements' => $advertisements ?? null, 'tables' => $tables, 'types' => $this->types]);
    }
}
