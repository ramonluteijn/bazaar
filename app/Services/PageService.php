<?php

namespace App\Services;

use App\Models\ContentBlock;
use App\Models\ContentPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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
        $booleanFields = ['hero', 'text', 'cta', 'quote'];

        $blockFields = [
            'text' => ['title', 'text', 'button_text', 'button_link'],
            'cta' => ['title', 'text', 'button_text', 'button_link'],
            'quote' => ['title'],
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
                    if ($blockField === 'image') {
                        $imageFieldName = "{$field}_{$blockField}";
                        if ($request->hasFile($imageFieldName)) {
                            $block->$blockField = ImageService::StoreImage($request, $imageFieldName)[$imageFieldName] ?? $request->input($imageFieldName);
                        } else {
                            $block->$blockField = $request->input($imageFieldName);
                        }
                    } else {
                        $block->$blockField = $request->input("{$field}_{$blockField}");
                    }
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
            'header_font' => 'nullable',
            'body_font' => 'nullable',
            'primary_color' => 'nullable|hex_color',
            'secondary_color' => 'nullable|hex_color',
        ]);
    }

    public function getGoogleFonts()
    {
        $apiKey = config('app.google_fonts');

        $response = Http::get("https://www.googleapis.com/webfonts/v1/webfonts?key={$apiKey}");

        if ($response->successful()) {
            return $response->json()['items'];
        }

        return [];
    }
}
