<?php

namespace App\Services;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;

class AdvertisementService
{
    public function updateAdvertisement(AdvertisementRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/images', 'public');
        }
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update($data);
    }

    public function storeAdvertisement(AdvertisementRequest $request)
    {
        $data = $request->validated();
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
