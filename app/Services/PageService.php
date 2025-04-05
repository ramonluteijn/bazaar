<?php

namespace App\Services;

use App\Models\ContentBlock;
use App\Models\ContentPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
class PageService
{
    public function saveCustomPage($request): void
    {
        $data = $request->validated();
        $isNewPage = !$request->route('id');
        $page = $isNewPage ? new ContentPage() : ContentPage::find($request->route('id'));
        $page->user_id = Auth::id();
        $page->fill($data);
        $page->save();

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
            if(!$isNewPage) {
                $block->active = $request->input($field) === 'on';
                if (isset($blockFields[$field])) {
                    $rules = [];
                    foreach ($blockFields[$field] as $blockField) {
                        if ($blockField === 'image') {
                            $rules["{$field}_{$blockField}"] = 'nullable|image';
                        } elseif ($blockField === 'text') {
                            $rules["{$field}_{$blockField}"] = 'nullable|max:65535';
                        } else {
                            $rules["{$field}_{$blockField}"] = 'nullable|string|max:255';
                        }
                    }
                    $validatedBlockData = $request->validate($rules);

                    foreach ($blockFields[$field] as $blockField) {
                        if ($blockField === 'image') {
                            $imageFieldName = "{$field}_{$blockField}";
                            if ($request->hasFile($imageFieldName)) {
                                $block->$blockField = ImageService::StoreImage($request, $imageFieldName)[$imageFieldName] ?? $request->input($imageFieldName);
                            } else {
                                $block->$blockField = $request->input($imageFieldName);
                            }
                        } else {
                            $block->$blockField = $validatedBlockData["{$field}_{$blockField}"];
                        }
                    }
                }
            }
            $block->save();
        }
    }

    public function getCustomPageWithBlocks($id)
    {
        return ContentPage::with('blocks')->where('user_id', $id)->first();
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
