<?php

namespace App\Services;

use App\Models\ReturnProduct;
use App\Models\Setting;

class ReturnService
{
    public function createReturn($request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $imageData = ImageService::StoreImage($request, 'image');
            if ($imageData) {
                $data = array_merge($data, $imageData);
            }
        }

        $data['wear'] = $this->calculatedWear($request);

        ReturnProduct::create($data);
        return ReturnProduct::latest()->first();
    }

    private function calculatedWear($request)
    {
        $wear = 0;
        foreach (Setting::all() as $setting) {
            if ($request->has($setting->key) && $request->input($setting->key) == 'on') {
                $wear += $setting->percentage;
            }
        }
        if ($wear > 100) {
            $wear = 100;
        }
        return $wear;
    }
}
