@extends('layouts.layout')

@section('title', __('Your Basket'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <h1 class="text-2xl font-bold mb-4">{{__('Your Basket')}}</h1>
        <ul class="space-y-4">
            @php
                $totalAmount = 0;
            @endphp
            @foreach($advertisements as $item)
                @php
                    $totalAmount += $item['advertisement']->price * $item['count'];
                @endphp
                <li class="bg-white shadow-md rounded p-4 flex items-center">
                    <img src="{{ asset($item['advertisement']->image_url) }}" alt="Advertisement Image" class="w-1/4 h-auto max-w-[200px] max-h-[200px] mr-4">
                    <div class="w-3/4">
                        <h2 class="text-xl font-bold">{{ $item['advertisement']->title }}</h2>
                        <p class="text-gray-700">{{ $item['advertisement']->description }}</p>
                        <p class="text-gray-700">{{__('Price')}}: ${{ $item['advertisement']->price }}</p>
                        <p class="text-gray-700">{{__('Quantity')}}: {{ $item['count'] }}</p>
                        <p class="text-gray-700">{{__('Total')}}: ${{ $item['advertisement']->price * $item['count'] }}</p>
                        <div class="flex space-x-2 mt-2">
                            <form action="{{ route('basket.update', $item['advertisement']->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">-</button>
                            </form>
                            <form action="{{ route('basket.update', $item['advertisement']->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="increase">
                                <button type="submit" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-2 rounded">+</button>
                            </form>
                            <form action="{{ route('basket.update', $item['advertisement']->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">{{__('Delete')}}</button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            <h2 class="text-xl font-bold">{{__('Total Amount')}}: ${{ $totalAmount }}</h2>
            <form action="{{ route('basket.checkout') }}" method="GET">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">{{__('Checkout')}}</button>
            </form>
        </div>
    </div>
@stop
