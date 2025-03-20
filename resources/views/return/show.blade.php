@extends('layouts.layout')

@section('title', __('Returns'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="w-full p-4">
            <h1 class="text-2xl font-bold mb-4">{{__('Return Form')}}</h1>
            <form action="{{ route('return.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <x-forms.input-field type="text" name="name" label="{{__('name')}}" :required="true" value="{{old('name')}}" />
                <x-forms.input-field type="email" name="email" label="{{__('email')}}" :required="true" value="{{old('email')}}" />
                <x-forms.input-field type="text" name="title" label="{{__('title')}}" :required="true" value="{{old('title')}}" />
                <x-forms.input-file name="image" :required="true" label="{{__('image')}}" value="{{old('image')}}"/>
                @foreach($settings as $setting)
                    <x-forms.input-switch :name="$setting->key" label="{{$setting->name}}" :checked="old($setting->key)"/>
                @endforeach

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('Submit')}}</button>
                </div>
            </form>
            @if(isset($wear))
                <div class="mt-4">
                <strong>{{__('Total Wear')}}: </strong>{{ $wear }}%
            </div>
            @endif
        </div>
    </div>
@endsection
