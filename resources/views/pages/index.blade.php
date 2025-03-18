@extends('layouts.layout')

@section('title', __('Custom Pages'))

@section('content')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6">{{__('Custom Pages')}}</h1>
        <ul class="list-disc pl-5 bg-gray-100 p-4 rounded-lg shadow-md">
            @foreach($pages as $page)
                <li class="mb-2 text-blue-500">
                    <a href="{{ route('pages.read-from-url', $page->url) }}" class="text-lg font-medium hover:underline hover:cursor-pointer">{{ $page->title }}</a>
                    <span class="text-sm text-gray-600">{{__('by')}} {{ $page->user->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@stop
