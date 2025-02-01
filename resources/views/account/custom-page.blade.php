@extends('layouts.layout')

@section('title', 'Custom Page')

@section('content')
    <div class="container">
        <div class="row">
            <x-profile-menu />
            <div class="col-md-12">
                <h1>Custom Page Creation</h1>
                <p>This is a custom page that you can create for your users.</p>
            </div>
        </div>
    </div>
@endsection
