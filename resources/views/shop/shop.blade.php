@extends('layouts.layout')

@section('title', 'Shop')

@section('content')
    @livewire('shop',['advertisements' => $advertisements, 'advertisers' => $advertisers])
@stop
