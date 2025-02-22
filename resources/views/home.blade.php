@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div>
    <x-hero />
    @livewire('new-items', ['title' => 'New Items', 'amount' => 3, 'link' => route('shop'), 'linkText' => 'View all products'])
</div>
@stop
