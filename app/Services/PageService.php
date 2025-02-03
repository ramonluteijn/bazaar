<?php
namespace App\Services;

use App\Models\ContentBlock;
use App\Models\ContentPage;
use App\Rules\UrlCreation;
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

        // Save blocks
        foreach ($request->input('blocks', []) as $blockData) {
            $block = new ContentBlock();
            $block->content_page_id = $page->id;
            $block->type = $blockData['type'];
            $block->title = $blockData['title'] ?? null;
            $block->content = $blockData['content'] ?? null;
            $block->image = $blockData['image'] ?? null;
            $block->background_color = $blockData['background_color'] ?? null;
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
            'url' => ['required', Rule::unique('content_pages')->ignore($request->route('id')), 'regex:/^\S*$/', new UrlCreation()],
        ]);
    }
}
