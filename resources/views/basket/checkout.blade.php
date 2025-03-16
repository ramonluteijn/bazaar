@extends('layouts.layout')

@section('title', 'Checkout')

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <h1 class="text-2xl font-bold mb-4">Checkout</h1>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <x-forms.input-field name="name" :required="true" />
            <x-forms.input-field name="address" :required="true" />
            <x-forms.input-field name="delivery_address" :required="true" />
            <x-forms.input-field name="phone" :required="true" />
            <x-forms.input-field name="email" type="email" :required="true" />
            <x-forms.input-field name="zip" :required="true" />
            <x-forms.input-field name="city" :required="true" />
            <x-forms.input-field name="state" :required="true" />
            <x-forms.input-field name="country" :required="true" />
            <x-forms.input-textarea name="comment" />
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit Order</button>
        </form>
    </div>
@stop
