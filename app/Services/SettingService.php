<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function storeSetting($request): void
    {
        $data = $request->validated();
        $data['key'] = $this->generateKeyFromName($data['name']);
        Setting::create($data);
    }

    public function updateSetting($request, $id): void
    {
        $data = $request->validated();
        $data['key'] = $this->generateKeyFromName($data['name']);
        $setting = Setting::findOrFail($id);
        $setting->update($data);
    }

    public function deleteSetting($id): void
    {
        Setting::findOrFail($id)->delete();
    }

    private function generateKeyFromName($name): string
    {
        return strtolower(preg_replace('/\s+/', '_', $name));
    }
}
