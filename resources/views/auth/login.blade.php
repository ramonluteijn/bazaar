@extends('layouts.layout')

@section('title', 'Login')

@section('content')
    <div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
        <div class="w-full max-w-md">
            <form method="POST" action="{{ route('login.save') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-6">
                    <x-forms.input-field type="email" name="email" :required="true" value="{{old('email')}}"/>
                    <x-forms.input-field type="password" name="password" :required="true"/>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{route('register.show')}}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Register here</a>
                    <input type="submit" value="Login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                </div>
            </form>
        </div>
    </div>
@stop
