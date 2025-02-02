<?php
namespace App\Services;

use App\Models\ContentPage;
use App\Rules\UrlCreation;
use Illuminate\Validation\Rule;

class PageService
{
    public function saveCustomPage($request)
    {
        $validated = $this->validateCustomPage($request);
        $page = $request->route('id') ? ContentPage::find($request->route('id')) : new ContentPage();
        $page->fill($validated);
        $page->save();
    }

    private function validateCustomPage($request)
    {
            return $request->validate([
                'title' => 'required',
                'url' => ['required', Rule::unique('content_pages')->ignore($request->route('id')), 'regex:/^\S*$/', new UrlCreation()],
            ]);
    }
}
