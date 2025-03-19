@extends('layouts.layout')

@section('title', $setting->title ?? __('Setting'))

@section('content')
<div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/4 p-4">
            <x-profile-menu />
        </div>
        <div class="w-full md:w-3/4 p-4">
            <h1 class="text-2xl font-bold mb-4">{{__('Setting')}}</h1>
            @if(isset($setting))
                <form method="POST" action="{{ route('settings.update', ['id' => $setting->id]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @method('PUT')
                    @csrf
                    @else
                        <form method="POST" action="{{ route('settings.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            @csrf
                            @endif
                            <x-forms.input-field type="text" name="name" label="{{__('name')}}" :required="true" value="{{ old('name',$setting->name ?? '' )}}"/>
                            <x-forms.input-field type="number" name="percentage" label="{{__('percentage')}}" :required="true" value="{{ old('percentage',$setting->percentage ?? '' )}}" :step="0.01"/>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ isset($setting) ? __('Update setting') : __('Add setting') }}</button>
                        </form>
                        @if(isset($setting))
                            <form method="POST" action="{{ route('settings.delete', ['id' => $setting->id]) }}" class="mt-4">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('Delete setting')}}</button>
                            </form>
            @endif
        </div>
    </div>
</div>

@stop
