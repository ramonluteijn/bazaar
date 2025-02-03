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
            <form action="{{ isset($page) ? route('custom-page.update', $page->id) : route('custom-page.store') }}" method="post" class="space-y-4">
                @csrf
                @if(isset($page))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $page->title ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <label for="url" class="block text-sm font-medium text-gray-700 mt-4">URL</label>
                    <input type="text" name="url" id="url" value="{{ old('url', $page->url ?? '') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="form-group">
                    <label for="blocks" class="block text-sm font-medium text-gray-700">Blocks</label>
                    <div id="blocks" class="space-y-4">
                        @if(isset($page))
                            @dump($page->blocks)
                            @foreach($page->blocks as $index => $block)
                                @dump($index)
                                <div class="block p-4 border border-gray-300 rounded-md">
                                    <select name="blocks[{{ $index }}][type]" class="form-control block-type w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="TEXT" {{ $block->type == 'TEXT' ? 'selected' : '' }}>Text</option>
                                        <option value="TEXT_IMAGE" {{ $block->type == 'TEXT_IMAGE' ? 'selected' : '' }}>Text Image</option>
                                        <option value="QUOTE" {{ $block->type == 'QUOTE' ? 'selected' : '' }}>Quote</option>
                                        <option value="CTA" {{ $block->type == 'CTA' ? 'selected' : '' }}>Call to Action</option>
                                        <option value="NEW_ITEMS" {{ $block->type == 'NEW_ITEMS' ? 'selected' : '' }}>New Items</option>
                                        <option value="HERO" {{ $block->type == 'HERO' ? 'selected' : '' }}>Hero</option>
                                    </select>
                                    <input type="text" name="blocks[{{ $index }}][title]" value="{{ $block->title }}" placeholder="Block Title" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm">
                                    <textarea name="blocks[{{ $index }}][content]" placeholder="Block Content" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm">{{ $block->content }}</textarea>
                                    <input type="text" name="blocks[{{ $index }}][image]" value="{{ $block->image }}" placeholder="Image URL" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-image">
                                    <input type="text" name="blocks[{{ $index }}][button_link]" value="{{ $block->button_link }}" placeholder="Button Link" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-button-link">
                                    <input type="text" name="blocks[{{ $index }}][link_text]" value="{{ $block->link_text }}" placeholder="Link Text" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-link-text">
                                    <input type="text" name="blocks[{{ $index }}][background_color]" value="{{ $block->background_color }}" placeholder="Background Color" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-background-color">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" id="add-block" class="mt-4 btn btn-secondary bg-gray-500 text-white py-2 px-4 rounded-md">Add Block</button>
                </div>
                <input type="submit" value="{{ isset($page) ? 'Update' : 'Create' }}" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded-md">
            </form>
        </div>
    </div>

    <script src="{{ asset('js/contentBlocks.js') }}"></script>
@endsection
