@extends('layouts.layout')

@section('title', isset($page) ? 'Edit Custom Page' : 'Create Custom Page')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex flex-col">
            <x-profile-menu />
            <div class="w-full">
                <h1 class="text-2xl font-bold mb-4">{{ isset($page) ? 'Edit Custom Page' : 'Create Custom Page' }}</h1>
                <p class="mb-4">This is a custom page that you can {{ isset($page) ? 'edit' : 'create' }} for your users.</p>
            </div>
            <form action="{{ isset($page) ? route('custom-page.update', $page->id) : route('custom-page.store') }}" method="post">
                @csrf
                @if(isset($page))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <x-forms.input-field type="text" :name="'title'" :value="$page->title ?? ''"/>
                    <x-forms.input-field type="text" :name="'url'" :value="$page->url ?? ''"/>
{{--                    <x-forms.input-field type="text" :name="'header_font'" :value="$page->header_font ?? ''"/>--}}
{{--                    <x-forms.input-field type="text" :name="'body_font'" :value="$page->body_font ?? ''"/>--}}
                    <x-forms.input-field type="color" :name="'primary_color'" :value="$page->primary_color ?? ''"/>
                    <x-forms.input-field type="color" :name="'secondary_color'" :value="$page->secondary_color ?? ''"/>
                </div>

                <div class="mt-[50px]">
                    @if(isset($page->blocks))
                        @foreach($page->blocks as $block)
                            <x-forms.input-switch name="{{$block->type}}" checked="{{$block->active}}"/>
                            <div class="block-fields" data-block-type="{{$block->type}}" style="display: none;">
                                <x-forms.input-field type="text" name="{{$block->type}}_title" value="{{$block->title}}"/>
                                <x-forms.input-textarea name="{{$block->type}}_text" value="{{$block->content}}"/>
                                <x-forms.input-field type="text" name="{{$block->type}}_button_text" value="{{$block->link_text}}"/>
                                <x-forms.input-field type="text" name="{{$block->type}}_button_link" value="{{$block->button_link}}"/>
                                <x-forms.input-file name="{{$block->type}}_image" value="{{$block->image}}"/>
                            </div>
                        @endforeach
                    @endif
                </div>
                <input type="submit" value="{{ isset($page) ? 'Update' : 'Create' }}" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded-md">
            </form>
        </div>
    </div>
    <script src="{{ asset('js/content-pages.js') }}"></script>

@endsection
