@extends('layouts.layout')

@section('title', __('Wishlist'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu/>
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-3xl font-bold mb-4">{{__('Wishlist')}}</h1>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                    @foreach($wishlist as $advertisement)
                        <a href="{{route('advertisement.read-from-id', ['id' => $advertisement->id])}}" class="block mb-4">
                            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex items-center">
                                <img src="{{ asset($advertisement->image_url) }}" alt="Advertisement Image" class="w-1/4 h-auto max-w-[200px] max-h-[200px] mr-4">
                                <div class="w-3/4">
                                    <h5 class="text-xl font-bold">{{ $advertisement->title }}</h5>
                                    <p class="text-gray-700">{{ $advertisement->description }}</p>
                                </div>

                                <form method="POST" action="{{ route('wishlist.delete', ['advertisement' => $advertisement]) }}" class="position-absolute m-0 w-100 wishlist-button">
                                    @method('DELETE')
                                    @csrf
                                    <input type="hidden" name="id" value="{{$advertisement->id}}">
                                    <button type="submit" class="btn btn-danger heartLink float-right d-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="19.858" viewBox="0 0 22 19.858">
                                            <path id="Icon_akar-heart" data-name="Icon akar-heart" d="M8,4.5A4.975,4.975,0,0,0,3,9.45c0,2.207.875,7.445,9.488,12.74a.985.985,0,0,0,1.024,0C22.125,16.9,23,11.657,23,9.45A4.975,4.975,0,0,0,18,4.5c-2.761,0-5,3-5,3S10.761,4.5,8,4.5Z" transform="translate(-2 -3.5)" fill="{{ $advertisement->isWishlisted() ? '#208b85' : 'none' }}" stroke="#208b85" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
