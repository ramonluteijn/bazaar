<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class AgendaController
{
    private $types = ['hire' => 'hire', 'sale' => 'sale', 'bid' => 'bid'];
    private OrderService $orderService;
    private AdvertisementService $advertisementService;

    public function __construct(OrderService $orderService, AdvertisementService $advertisementService)
    {
        $this->orderService = $orderService;
        $this->advertisementService = $advertisementService;
    }

    public function index(Request $request)
    {
        $tables = [
            'orders' => 'orders',
        ];
        if(!auth()->user()->hasRole('user')) {
            $tables['advertisements'] = 'advertisements';
        }

        if($request->has('selectTable') && $request->selectTable == 'orders') {
            $orders = $this->orderService->getHiredOrders();
        }
        if($request->has('selectTable') && $request->selectTable == 'advertisements') {
            if ($request->selectType == '') {
                $advertisements = $this->advertisementService->getOwnAdvertisements();
            }
            else {
                $this->advertisementService->getOwnAdvertisementsByType($request->selectType);
            }
        }
        return view('agenda.index', ['orders' => $orders ?? null, 'advertisements' => $advertisements ?? null, 'tables' => $tables, 'types' => $this->types]);
    }
}
