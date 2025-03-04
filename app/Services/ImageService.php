<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function StoreImage($request, $image): array
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

    public static function getQrCode($id): string
    {
        $qrCode = new Builder(
            writer: new PngWriter(),
            data: route('advertisement.read-from-id', ['id' => $id])
        );

        return $qrCode->build()->getDataUri();
    }
}
