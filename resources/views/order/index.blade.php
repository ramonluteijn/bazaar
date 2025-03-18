@extends('layouts.layout')

@section('title', __('Orders'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__('Orders')}}</h1>
                @foreach($orders as $order)
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <h5 class="text-xl font-bold">{{__('Order')}} #{{ $order->id }}</h5>
                        <p class="text-gray-700">{{__('Total')}}: ${{ number_format($order->total, 2) }}</p>
                        <p class="text-gray-700">{{__('Status')}}: {{ ucfirst($order->status) }}</p>
                        <p class="text-gray-700">{{__('Created at')}}: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
                        <a href="{{ route('orders.show', ['id' => $order->id]) }}" class="text-blue-500 hover:underline">{{__('View Details')}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
