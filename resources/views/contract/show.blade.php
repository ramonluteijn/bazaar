@extends('layouts.layout')

@section('title', $contract->title ?? __('Contract'))

@section('content')
    @php
        $contractTitle = isset($contract) && isset($contract->businessAdvertiser->name) ? ': ' . $contract->businessAdvertiser->name : '';
    @endphp

    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{__('Contract')}}{{ $contractTitle }}</h1>
                @if(isset($contract))
                    <form method="POST" action="{{ route('contracts.update', ['id' => $contract->id]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        @method('PUT')
                        @csrf
                        @else
                            <form method="POST" action="{{ route('contracts.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                                @csrf
                                @endif
                                <x-forms.input-field type="text" name="title" label="{{__('title')}}" :required="true" value="{{ old('title',$contract->title ?? '' )}}"/>
                                <x-forms.input-textarea name="description" label="{{__('description')}}" :required="true" :class="'min-h-[100px] max-h-[300px]'">{{ old('description',$contract->description ?? '' )}}</x-forms.input-textarea>
                                <x-forms.input-select name="status" label="{{__('status')}}" :required="true" :list="$types" value="{{ old('status',$contract->status ?? '' )}}"/>
                                <x-forms.input-field type="date" name="signed_at" label="{{__('signed at')}}" :required="true" value="{{ old('signed_at',$contract->signed_at ?? '' )}}"/>
                                <x-forms.input-file name="contract" label="{{__('contract')}}" :required="(isset($contract) ? false : true)" value="{{ $contract->contract ?? '' }}"/>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ isset($contract) ? __('Update contract') : __('Add contract') }}</button>
                            </form>
                            @if(isset($contract))
                                <form method="POST" action="{{ route('contracts.delete', ['id' => $contract->id]) }}" class="mt-4">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('Delete contract')}}</button>
                                </form>
                @endif
            </div>
        </div>
    </div>
@stop
