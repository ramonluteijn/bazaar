@extends('layouts.layout')

@section('title', 'Agenda')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">Your Agenda</h1>
                @if($orders->isEmpty())
                    <p>No orders found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead>
                            <tr class="text-left">
                                <th class="py-2 px-4 border-b">Order ID</th>
                                <th class="py-2 px-4 border-b">Advertisement Title</th>
                                <th class="py-2 px-4 border-b">Order Date</th>
                                <th class="py-2 px-4 border-b">Collection Date</th>
                                <th class="py-2 px-4 border-b">Return Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                @foreach($order->orderDetails as $orderDetail)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $order->id }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->title }}</td>
                                        <td class="py-2 px-4 border-b">{{ $order->created_at }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->collection_date }}</td>
                                        <td class="py-2 px-4 border-b">{{ $orderDetail->advertisement->return_date }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
