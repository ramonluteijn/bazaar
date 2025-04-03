@extends('layouts.layout')

@section('title', __('Shop'))

@section('content')
    <div>
        <x-blocks.hero />
        <x-shop-component :advertisements="$advertisements" :types="$types" :adTypes="$adTypes" :bindings="$bindings"/>
    </div>
@stop
