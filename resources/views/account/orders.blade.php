@extends('layouts.layout')

@section('title', 'Orders')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">Orders</h1>
                @foreach($orders as $order)
                    {{$order}}
{{--                    <a href="{{route('contract.show', ['id' => $contract->id])}}" class="block mb-4">--}}
{{--                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex items-center">--}}
{{--                            <div class="w-4/4">--}}
{{--                                <h5 class="text-xl font-bold">{{ $contract->title ?? 'Name: '.$contract->businessAdvertiser->name }}</h5>--}}
{{--                                <p class="text-gray-700">{{ $contract->description ?? 'Email: '.$contract->businessAdvertiser->email }}</p>--}}
{{--                            </div>--}}
{{--                            <div class="w-1/4 text-right">--}}
{{--                                <a href="{{ route('contract.download', ['id' => $contract->id]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Download</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
                @endforeach
            </div>
        </div>
    </div>


@stop
