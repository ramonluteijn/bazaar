@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div>
    <x-hero />
    <div class="container mx-auto">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">{{__("Welcome to the homepage")}}</h1>
            </div>
        </div>
    </div>
</div>
@stop
