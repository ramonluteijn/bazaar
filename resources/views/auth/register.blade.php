@extends('layouts.layout')

@section('title', 'Register')

@section('content')
    <div class="pb-[100px] min-h-[calc(100vh-50px-75px)] flex items-center justify-center">
        <div class="w-full max-w-md">
            <form method="POST" action="{{ route('register.save') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">E-mail</label>
                    <input type="email" name="email" id="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                    @if ($errors->has('email'))
                        <span class="text-red-500 text-xs italic">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" id="password" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" />
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role</label>
                    <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="user">User</option>
                        <option value="private_advertiser">Private advertiser</option>
                        <option value="business_advertiser">Business advertiser</option>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{route('login')}}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Login here</a>
                    <input type="submit" value="Register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                </div>
            </form>
        </div>
    </div>
@stop
