@extends('layouts.layout')

@section('title', __('Checkout'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <h1 class="text-2xl font-bold mb-4">{{__('Checkout')}}</h1>
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <x-forms.input-field name="name" label="{{__('name')}}" :required="true" value="{{old('name')}}"/>
            <x-forms.input-field name="address" label="{{__('address')}}" :required="true" value="{{old('address')}}"/>
            <x-forms.input-field name="delivery_address" label="{{__('delivery address')}}" :required="true" value="{{old('delivery_address')}}"/>
            <x-forms.input-field name="phone" label="{{__('phone')}}" :required="true" value="{{old('phone')}}"/>
            <x-forms.input-field name="email" label="{{__('email')}}" type="email" :required="true" value="{{old('email')}}"/>
            <x-forms.input-field name="zip" label="{{__('zip')}}" :required="true" value="{{old('zip')}}"/>
            <x-forms.input-field name="city" label="{{__('city')}}" :required="true" value="{{old('city')}}"/>
            <x-forms.input-field name="state" label="{{__('state')}}" :required="true" value="{{old('state')}}"/>
            <x-forms.input-field name="country" label="{{__('country')}}" :required="true" value="{{old('country')}}"/>
            <x-forms.input-textarea name="comment" label="{{__('comment')}}" value="{{old('comment')}}"/>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{__('Submit Order')}}</button>
        </form>
    </div>
@stop
