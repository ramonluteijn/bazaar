@extends('layouts.layout')

@section('title', __('Order Details'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <h1 class="text-2xl font-bold mb-4">{{__('Order')}} #{{ $order->id }}</h1>
        <p class="text-gray-700">{{__('Total')}}: ${{ number_format($order->total, 2) }}</p>
        <p class="text-gray-700">{{__('Status')}}: {{ ucfirst($order->status) }}</p>
        <p class="text-gray-700">{{__('Created at')}}: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>

        <h2 class="text-xl font-bold mt-4">{{__('Order Details')}}</h2>
        <ul class="space-y-4">
            @foreach($order->orderDetails as $detail)
                <li class="bg-white shadow-md rounded p-4 flex items-center">
                    <div class="w-1/4">
                        <img src="{{ asset($detail->advertisement->image_url) }}" alt="{{ $detail->advertisement->title }}" class="w-full max-w-[200px] object-cover mb-4 rounded-lg">
                    </div>
                    <div class="w-3/4 pl-4">
                        <h3 class="text-lg font-bold">{{ $detail->advertisement->title }}</h3>
                        <p class="text-gray-700">{{__('Price')}}: ${{ number_format($detail->advertisement->price, 2) }}</p>
                        <p class="text-gray-700">{{__('Quantity')}}: {{ $detail->amount }}</p>
                        <p class="text-gray-700">{{__('Total Price')}}: ${{ number_format($detail->advertisement->price * $detail->amount, 2) }}</p>
                        @if($detail->advertisement->type === 'hire')
                            <p class="text-gray-700">{{__('Collection Date')}}: {{ $detail->advertisement->collection_date }}</p>
                            <p class="text-gray-700">{{__('Return Date')}}: {{ $detail->advertisement->return_date }}</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        <h2 class="text-xl font-bold mt-4">{{__('Overall Total Price')}}</h2>
        <p class="text-gray-700">{{__('Overall Total')}}: ${{ number_format($order->orderDetails->sum(fn($detail) => $detail->advertisement->price * $detail->amount), 2) }}</p>
    </div>
@stop
