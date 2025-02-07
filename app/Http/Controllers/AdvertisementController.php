<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;

class AdvertisementController extends Controller
{
    private AdvertisementService $advertisementService;
    private array $types = ['sale', 'hire'];
    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index()
    {
        $advertisements = Advertisement::where("user_id", auth()->id())->get();
        return view('account.advertisements', ['advertisements' => $advertisements]);
    }

    public function advertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('account.advertisement', ['advertisement' => $advertisement, 'types' => $this->types]);
    }

    public function updateAdvertisement(AdvertisementRequest $request, $id)
    {
        $this->advertisementService->updateAdvertisement($request, $id);
        return redirect()->route('advertisements.index');
    }

    public function createAdvertisement()
    {
        return view('account.advertisement', ['advertisement' => null, 'types' => $this->types]);
    }

    public function storeAdvertisement(AdvertisementRequest $request)
    {
        $this->advertisementService->storeAdvertisement($request);
        return redirect()->route('advertisements.index');
    }

    public function deleteAdvertisement($id)
    {
        $this->advertisementService->deleteAdvertisement($id);
        return redirect()->route('advertisements.index');
    }
}
