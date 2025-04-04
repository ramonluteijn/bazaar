@extends('layouts.layout')

@section('title', isset($page) ? __('Edit Custom Page') : __('Create Custom Page'))

@section('content')
    <div class="container mx-auto p-4 min-h-[calc(100vh-50px-75px)]">
        <div class="flex flex-wrap">
            <div class="w-full md:w-1/4 p-4">
                <x-profile-menu />
            </div>
            <div class="w-full md:w-3/4 p-4">
                <h1 class="text-2xl font-bold mb-4">{{ isset($page) ? 'Edit Custom Page' : 'Create Custom Page' }}</h1>
                <p class="mb-4">{{__('This is a custom page that you can (edit/create) for your users.', ['state' => isset($page) ? 'edit' : 'create'])}}</p>
                <form action="{{ isset($page) ? route('pages.update', $page->id) : route('pages.store') }}" enctype="multipart/form-data" method="post" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    @if(isset($page))
                        @method('PUT')
                    @endif
                    <div class="mb-4">
                        <x-forms.input-field type="text" :name="'title'" label="{{__('title')}}" :required="true" :value="old('title',$page->title ?? '')"/>
                        <x-forms.input-field type="text" :name="'url'" label="{{__('url')}}" :required="true" :value="old('url',$page->url ?? '')"/>
                        @if(isset($page))
                            <a href="{{route('pages.read-from-url', $page->url)}}" target="_blank" class="text-blue-500 mb-4 inline-block">{{__('View Page')}}</a>
                        @endif
                        <x-forms.input-select :name="'header_font'" label="{{__('header font')}}" :list="$fonts" :value="old('header_font',$page->header_font ?? '')"/>
                        <x-forms.input-select :name="'body_font'" label="{{__('body font')}}" :list="$fonts" label="body font" :value="old('body_font',$page->body_font ?? '')"/>
                        <x-forms.input-field type="color" :name="'primary_color'" label="{{__('primary color')}}" :value="old('primary_color',$page->primary_color ?? '')" class="py-0 px-0"/>
                        <x-forms.input-field type="color" :name="'secondary_color'" label="{{__('secondary color')}}" :value="old('secondary_color',$page->secondary_color ?? '')" class="py-0 px-0"/>
                    </div>

                    <div class="mt-12">
                        <h1 class="text-2xl font-bold mb-4">{{isset($page) ? __('Blocks') : __('Please create a page first to gain access to the blocks')}}</h1>
                        @if(isset($page->blocks))
                            @foreach($page->blocks as $block)
                                <x-forms.input-switch name="{{$block->type}}" label="{{__($block->type)}}" checked="{{$block->active}}" />
                                <div class="block-fields" data-block-type="{{$block->type}}" style="display: none;">
                                    <x-forms.input-field type="text" name="{{$block->type}}_title" label="{{__('title')}}" value="{{$block->title}}" />
                                    <x-forms.input-textarea name="{{$block->type}}_text" label="{{__('description')}}" class="mb-4">{{$block->text}}</x-forms.input-textarea>
                                    <x-forms.input-field type="text" name="{{$block->type}}_button_text" label="{{__('button text')}}" value="{{$block->button_text}}"/>
                                    <x-forms.input-field type="url" name="{{$block->type}}_button_link" label="{{__('button url')}}" value="{{$block->button_link}}"/>
                                    <x-forms.input-file name="{{$block->type}}_image" :title="$block->image" label="{{__('image')}}" value="{{$block->image}}" />
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <input type="submit" value="{{ isset($page) ? __('Update') : __('Create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/content-pages.js') }}"></script>
@endsection
