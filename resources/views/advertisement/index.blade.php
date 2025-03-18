@extends('layouts.layout')

@section('title', __('Advertisements'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__('Advertisements')}}</h1>
                <a href="{{ route('advertisements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">{{__('Create advertisement')}}</a>
                @foreach($advertisements as $advertisement)
                    <a href="{{route('advertisements.show', ['id' => $advertisement->id])}}" class="block mb-4">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex items-center">
                            <img src="{{ asset($advertisement->image_url) }}" alt="Advertisement Image" class="w-1/4 h-auto max-w-[200px] max-h-[200px] mr-4">
                            <div class="w-3/4">
                                <h5 class="text-xl font-bold">{{ $advertisement->title }}</h5>
                                <p class="text-gray-700">{{ $advertisement->description }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach

                @if(Auth::user()->hasRole('business_advertiser') || Auth::user()->hasRole('admin') || Auth::user()->hasRole('owner'))
                    <div class="mt-4">
                        <h1 class="text-2xl font-bold mb-4">{{__('Upload Advertisements')}}</h1>
                        <form action="{{ route('advertisements.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="csv_file" class="block text-sm font-medium text-gray-700">{{__('CSV File')}}</label>
                                <input type="file" name="csv_file" id="csv_file" class="mt-1 block w-full">
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Upload')}}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
