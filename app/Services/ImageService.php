<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function StoreImage($request, $image)
    {
        $data = [];
        if ($request->hasFile($image)) {
            $file = $request->file($image);
            $filePath = 'images/' . $file->getClientOriginalName();
            if (!Storage::disk('public')->exists($filePath)) {
                $filePath = $file->storeAs('images', $file->getClientOriginalName(), 'public');
            }
            $data[$image] = $filePath;
        }
        return $data;
    }
}
