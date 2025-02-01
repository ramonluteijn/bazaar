@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    <h3>Register</h3>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="email">name</label>
        <input type="text" name="name" id="name" required />
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" required />
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required />
        <select name="role" id="role">
            <option value="user">User</option>
            <option value="private_advertiser">Private advertiser</option>
            <option value="business_advertiser">Business advertiser</option>
        </select>
        <input type="submit" value="Register">
    </form>
@stop
