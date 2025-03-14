﻿@props(['review', 'advertisement_id' => "", 'user_id' => "" ])
<div class="mt-4">
    <h2 class="text-2xl w-full text-center font-bold mb-4">Create Review</h2>

    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf

        <x-forms.input-field type="text" name="title" :required="true" value="{{ old('title', $review->title ?? '') }}"/>
        <x-forms.input-textarea name="content" :required="true" :class="'min-h-[100px] max-h-[300px]'">{{ old('content', $review->content ?? '') }}</x-forms.input-textarea>
        <x-forms.input-field type="number" name="rating" :required="true" value="{{ old('rating', $review->rating ?? '') }}"/>
        <x-forms.input-field type="text" name="email" :required="true" value="{{ old('email', $review->email ?? '') }}"/>
        <x-forms.input-field type="text" name="name" :required="true" value="{{ old('name', $review->name ?? '') }}"/>

        <input type="hidden" name="advertisement_id" value="{{ old('advertisement_id', $advertisement_id) }}">
        <input type="hidden" name="user_id" value="{{ old('user_id', $user_id) }}">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
    </form>
</div>
