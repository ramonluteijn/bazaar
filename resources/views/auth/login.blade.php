@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <h3>Login</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required />
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
        <a href="{{route('register')}}" class="underline">Register here</a>
        <input type="submit" value="Login">
    </form>
@stop
