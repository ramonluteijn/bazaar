@extends('layouts.layout')

@section('title', 'Review')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <x-reviews.reviews :reviews="$reviews"/>
        <x-reviews.review-form :user_id="$user->id"/>
    </div>
@endsection
