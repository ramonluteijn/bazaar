@extends('layouts.layout')

@section('title', __('Dashboard'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-3xl font-bold mb-4">{{__('Dashboard')}}</h1>
                <p class="text-lg">{{__('Welcome to your dashboard, (name)', ['name' => $user->name])}}!</p>
            </div>
        </div>
    </div>
@endsection
