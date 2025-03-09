@extends('layouts.layout')

@section('title', 'Wishlist')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-3xl font-bold mb-4">Wishlist</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($wishlist as $item)
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <h5 class="text-xl font-bold">{{ $item->title }}</h5>
                            <p class="text-gray-700">{{ $item->description }}</p>
                            <div class="flex items-center">
                            </div>

                            <div class="w-full">
                                <a href="{{ route('advertisement.read-from-id', $item->id) }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    View Details
                                </a>
                            </div>
                            <div class="mt-4">
                                @livewire('heart-wishlist', ['advertisementId' => $item->id])
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
