<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Str;

class SettingService
{
    public function storeSetting($request)
    {
        $data = $request->validated();
        $data['key'] = $this->generateKeyFromName($data['name']);
        Setting::create($data);
    }

    public function updateSetting($request, $id)
    {
        $data = $request->validated();
        $data['key'] = $this->generateKeyFromName($data['name']);
        $setting = Setting::findOrFail($id);
        $setting->update($data);
    }

    public function deleteSetting($id)
    {
        Setting::findOrFail($id)->delete();
    }

    private function generateKeyFromName($name)
    {
        return strtolower(preg_replace('/\s+/', '_', $name));
    }
}
