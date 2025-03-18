@extends('layouts.layout')

@section('title', $advertisement->title ?? __('Advertisement'))

@section('content')
<div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
    <div class="flex flex-wrap">
        <div class="w-full md:w-1/4 p-4">
            <x-profile-menu />
        </div>
        <div class="w-full md:w-3/4 p-4">
            <h1 class="text-2xl font-bold mb-4">{{__("Advertisement")}}</h1>
            @if(isset($advertisement))
                <form method="POST" action="{{ route('advertisements.update', ['id' => $advertisement->id]) }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @method('PUT')
                    @csrf
                    @else
                        <form method="POST" action="{{ route('advertisements.store') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            @csrf
                            @endif
                            <x-forms.input-field type="text" name="title" label="{{__('title')}}" :required="true" value="{{ $advertisement->title ?? '' }}"/>
                            <x-forms.input-textarea name="description" label="{{__('description')}}" :class="'min-h-[100px] max-h-[300px]'">{{ $advertisement->description ?? '' }}</x-forms.input-textarea>
                            <x-forms.input-field type="number" name="price" label="{{__('price')}}" :required="true" value="{{ $advertisement->price ?? '' }}"/>
                            <x-forms.input-select name="type" :required="true" label="{{__('type')}}" :list="$types" value="{{ $advertisement->type ?? '' }}"/>
                            <x-forms.input-field type="date" name="expires_at" label="{{__('expires at')}}" :required="true" value="{{ $advertisement->expires_at ?? '' }}"/>
                            <x-forms.input-field type="date" name="collection_date" label="{{__('collection date')}}" value="{{ $advertisement->collection_date ?? '' }}"/>
                            <x-forms.input-field type="date" name="return_date" label="{{__('return date')}}" value="{{ $advertisement->return_date ?? '' }}"/>
                            <x-forms.input-file name="image" :title="($advertisement->title ?? '')" label="{{__('image')}}" value="{{ $advertisement->image ?? '' }}"/>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{ isset($advertisement) ? __('Update advertisement') : __('Add advertisement') }}</button>
                        </form>
                        @if(isset($advertisement))
                            <form method="POST" action="{{ route('advertisements.delete', ['id' => $advertisement->id]) }}" class="mt-4">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">{{__('Delete advertisement')}}</button>
                            </form>
            @endif
        </div>
    </div>
</div>

@stop

