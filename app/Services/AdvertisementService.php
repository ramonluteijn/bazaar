<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementService
{

    public function updateAdvertisement(Request $request, $id)
    {
        $data = $this->validateAdvertisement($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/images', 'public');
        }
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update($data);
    }

    private function validateAdvertisement($request)
    {
        return $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|numeric|min:0|max:2147483647',
            'description' => 'nullable|max:65535',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|in:sale,hire',
        ]);
    }

    public function storeAdvertisement(Request $request)
    {
        $data = $this->validateAdvertisement($request);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $data['user_id'] = auth()->id();
        Advertisement::create($data);
    }

    public function deleteAdvertisement($id)
    {
        Advertisement::findOrFail($id)->delete();
    }
}
