@extends('layouts.layout')

@section('title', 'Advertisements')

@section('content')
    <div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
        <div class="w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Advertisements</h1>
            <a href="{{ route('advertisement.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create advertisement</a>
            @foreach($advertisements as $advertisement)
                <a href="{{route('advertisement.show', ['id' => $advertisement->id])}}" class="block mb-4">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <h5 class="text-xl font-bold">{{ $advertisement->title }}</h5>
                            <p class="text-gray-700">{{ $advertisement->description }}</p>
                            <img src="{{ $advertisement->image_url}}" alt="Advertisement Image">
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@stop
