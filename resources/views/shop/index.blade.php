@extends('layouts.layout')

@section('title', __('Shop'))

@section('content')
    @livewire('shop',['advertisements' => $advertisements, 'advertisers' => $advertisers])
@stop
