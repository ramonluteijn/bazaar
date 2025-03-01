<?php

namespace App\Services;

use App\Models\ContentBlock;
use App\Models\ContentPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PageService
{
    public function saveCustomPage($request)
    {
        $validated = $this->validateCustomPage($request);
        $page = $request->route('id') ? ContentPage::find($request->route('id')) : new ContentPage();
        $page->user_id = Auth::id();
        $page->fill($validated);
        $page->save();

        // Define the boolean fields
        $booleanFields = ['hero', 'text', 'testimonial', 'cta', 'quote', 'text_image', 'gallery'];

        $blockFields = [
            'text' => ['title', 'text', 'button_text', 'button_link'],
            'testimonial' => ['title', 'text'],
            'cta' => ['title', 'text', 'button_text', 'button_link'],
            'quote' => ['text'],
            'text_image' => ['title', 'text', 'image', 'button_text', 'button_link'],
            'gallery' => ['title', 'image'],
            'hero' => ['title', 'text', 'image', 'button_text', 'button_link'],
        ];

        foreach ($booleanFields as $field) {
            $block = ContentBlock::firstOrNew([
                'content_page_id' => $page->id,
                'type' => $field,
            ]);
            $block->active = $request->input($field) === 'on';

            if (isset($blockFields[$field])) {
                foreach ($blockFields[$field] as $blockField) {
                    $block->$blockField = $request->input("{$field}_{$blockField}");
                }
            }

            $block->save();
        }
    }

    public function getCustomPageWithBlocks($id)
    {
        return ContentPage::with('blocks')->find($id);
    }

    private function validateCustomPage($request)
    {
        return $request->validate([
            'title' => 'required',
            'url' => ['required', Rule::unique('content_pages')->ignore($request->route('id')), 'regex:/^\S*$/'],
            'primary_color' => 'nullable|hex_color',
            'secondary_color' => 'nullable|hex_color',
        ]);
    }
}
