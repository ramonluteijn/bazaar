<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\SettingService;

class SettingController extends Controller
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = Setting::all();
        return view('settings.index', ['settings' => $settings]);
    }

    public function create()
    {
        return view('settings.show');
    }

    public function store(SettingRequest $request)
    {
        $this->settingService->storeSetting($request);
        return to_route('settings.index');
    }

    public function show($id)
    {
        $setting = Setting::findOrFail($id);
        return view('settings.show', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, $id)
    {
        $this->settingService->updateSetting($request, $id);
        return to_route('settings.index');
    }

    public function delete($id)
    {
        $this->settingService->deleteSetting($id);
        return to_route('settings.index');
    }
}
