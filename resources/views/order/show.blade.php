@extends('layouts.layout')

@section('title', 'Order Details')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <h1 class="text-2xl font-bold mb-4">Order #{{ $order->id }}</h1>
        <p class="text-gray-700">Total: ${{ number_format($order->total, 2) }}</p>
        <p class="text-gray-700">Status: {{ ucfirst($order->status) }}</p>
        <p class="text-gray-700">Created at: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>

        <h2 class="text-xl font-bold mt-4">Order Details</h2>
        <ul class="space-y-4">
            @foreach($order->orderDetails as $detail)
                <li class="bg-white shadow-md rounded p-4 flex items-center">
                    <div class="w-1/4">
                        <img src="{{ asset($detail->advertisement->image_url) }}" alt="{{ $detail->advertisement->title }}" class="w-full max-w-[200px] object-cover mb-4 rounded-lg">
                    </div>
                    <div class="w-3/4 pl-4">
                        <h3 class="text-lg font-bold">{{ $detail->advertisement->title }}</h3>
                        <p class="text-gray-700">Price: ${{ number_format($detail->advertisement->price, 2) }}</p>
                        <p class="text-gray-700">Quantity: {{ $detail->amount }}</p>
                        <p class="text-gray-700">Total Price: ${{ number_format($detail->advertisement->price * $detail->amount, 2) }}</p>
                    </div>
                </li>
            @endforeach
        </ul>

        <h2 class="text-xl font-bold mt-4">Overall Total Price</h2>
        <p class="text-gray-700">Overall Total: ${{ number_format($order->orderDetails->sum(fn($detail) => $detail->advertisement->price * $detail->amount), 2) }}</p>
    </div>
@stop
