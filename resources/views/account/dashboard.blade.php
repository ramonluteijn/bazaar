@extends('layouts.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <x-profile-menu />
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <p>Welcome to your dashboard, {{$user->name}}!</p>
            </div>
        </div>
    </div>
@endsection
