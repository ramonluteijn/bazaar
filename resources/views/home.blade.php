@extends('layouts.layout')

@section('title', 'Home')

@section('content')
<div>
    <x-blocks.hero :button_link="route('login')" :button_text="'login'"/> {{--todo change to ads --}}
    <div class="container mx-auto">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Welcome to the homepage</h1>
            </div>
        </div>
    </div>
    <x-blocks.cta :title="'Our newest shop items'" :content="'Shop category - recently added'" :button_text="'View all items'" :button_link="route('home')" />
</div>
@stop
