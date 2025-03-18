@extends('layouts.layout')

@section('title', __('Home'))

@section('content')
<div>
    <x-blocks.hero />
    @livewire('new-items', ['title' => __('New Items'), 'amount' => 3, 'link' => route('shop.index'), 'linkText' => 'View all products'])
</div>
@stop
