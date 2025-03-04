<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class SettingController
{
    private SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(): View
    {
        $settings = Setting::all();
        return view('settings.index', ['settings' => $settings]);
    }

    public function create(): View
    {
        return view('settings.show');
    }

    public function store(SettingRequest $request): RedirectResponse
    {
        $this->settingService->storeSetting($request);
        return to_route('settings.index');
    }

    public function show($id): View
    {
        $setting = Setting::findOrFail($id);
        return view('settings.show', ['setting' => $setting]);
    }

    public function update(SettingRequest $request, $id): RedirectResponse
    {
        $this->settingService->updateSetting($request, $id);
        return to_route('settings.index');
    }

    public function delete($id): RedirectResponse
    {
        $this->settingService->deleteSetting($id);
        return to_route('settings.index');
    }
}
