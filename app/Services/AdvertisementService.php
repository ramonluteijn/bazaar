<?php

namespace App\Services;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use Illuminate\Http\Request;

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

    public function uploadAdvertisements(Request $request)
    {
        $data = $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));

        $header = array_shift($data);
        foreach ($data as $row) {
            $row = array_combine($header, $row);
            Advertisement::create([
                'title' => $row['title'],
                'description' => $row['description'],
                'price' => $row['price'],
                'image' => $row['image'],
                'type' => $row['type'],
                'user_id' => auth()->id(),
                'expires_at' => $row['expires_at'],
            ]);
        }
    }
}
