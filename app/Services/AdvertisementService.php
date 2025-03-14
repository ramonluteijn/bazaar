<?php

namespace App\Services;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use App\Models\User;
use Illuminate\Http\Request;

class AdvertisementService
{
    public function updateAdvertisement(AdvertisementRequest $request, $id): void
    {
        $data = $request->validated();
        $advertisement = Advertisement::findOrFail($id);
        if ($request->hasFile('image')) {
            $imageData = ImageService::StoreImage($request, 'image');
            if ($imageData) {
                $data = array_merge($data, $imageData);
            }
        } else {
            $data['image'] = $advertisement->image;
        }
        $advertisement->update($data);
    }

    public function storeAdvertisement(AdvertisementRequest $request): void
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageData = ImageService::StoreImage($request, 'image');
            if ($imageData) {
                $data = array_merge($data, $imageData);
            }
        }
        $data['user_id'] = auth()->id();
        Advertisement::create($data);
    }

    public function deleteAdvertisement($id): void
    {
        Advertisement::findOrFail($id)->delete();
    }

    public function uploadAdvertisements(Request $request): void
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ], [
            'csv_file.required' => 'The CSV file is required.',
            'csv_file.mimes' => 'The CSV file must be a file of type: csv, txt.'
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

    public function getAdvertisers()
    {
        return User::whereHas("roles", function($q){
            $q->where("name", "private_advertiser")->orWhere("name", "business_advertiser");
        })->get();
    }
}
