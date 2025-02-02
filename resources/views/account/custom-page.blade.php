@extends('layouts.layout')

@section('title', 'Custom Page')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex flex-col">
            <x-profile-menu />
            <div class="w-full">
                <h1 class="text-2xl font-bold mb-4">Custom Page Creation</h1>
                <p class="mb-4">This is a custom page that you can create for your users.</p>
            </div>
            <form action="{{ route('custom-page.store') }}" method="post" class="space-y-4">
                @csrf
                <div class="form-group">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <label for="url" class="block text-sm font-medium text-gray-700 mt-4">URL</label>
                    <input type="text" name="url" id="url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="form-group">
                    <label for="blocks" class="block text-sm font-medium text-gray-700">Blocks</label>
                    <div id="blocks" class="space-y-4">
                        <div class="block p-4 border border-gray-300 rounded-md">
                            <select name="blocks[0][type]" class="form-control block-type w-full border-gray-300 rounded-md shadow-sm">
                                <option value="TEXT">Text</option>
                                <option value="TEXT_IMAGE">Text Image</option>
                                <option value="QUOTE">Quote</option>
                                <option value="CTA">Call to Action</option>
                                <option value="NEW_ITEMS">New Items</option>
                                <option value="HERO">Hero</option>
                            </select>
                            <input type="text" name="blocks[0][title]" placeholder="Block Title" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm">
                            <textarea name="blocks[0][content]" placeholder="Block Content" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                            <input type="text" name="blocks[0][image]" placeholder="Image URL" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-image">
                            <input type="text" name="blocks[0][button_link]" placeholder="Button Link" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-button-link">
                            <input type="text" name="blocks[0][link_text]" placeholder="Link Text" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-link-text">
                            <input type="text" name="blocks[0][background_color]" placeholder="Background Color" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-background-color">
                            <input type="text" name="blocks[0][author]" placeholder="Author" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-author">
                            <input type="text" name="blocks[0][site_link]" placeholder="Site Link" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-site-link">
                            <input type="number" name="blocks[0][amount]" placeholder="Amount" class="mt-2 block w-full border-gray-300 rounded-md shadow-sm block-field block-field-amount">
                        </div>
                    </div>
                    <button type="button" id="add-block" class="mt-4 btn btn-secondary bg-gray-500 text-white py-2 px-4 rounded-md">Add Block</button>
                </div>
                <input type="submit" value="Create" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded-md">
            </form>
        </div>
    </div>

    <script src="{{ asset('js/contentBlocks.js') }}"></script>
    <script>

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('block-type')) {
                setupFieldVisibility();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            setupFieldVisibility();
        });
    </script>
@endsection
