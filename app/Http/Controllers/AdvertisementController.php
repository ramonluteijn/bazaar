<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use App\Services\ImageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvertisementController
{
    private AdvertisementService $advertisementService;
    private array $types = ['sale' => 'sale', 'hire' => 'hire', 'bid' => 'bid'];
    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index(): View
    {
        $advertisements = Advertisement::where("user_id", auth()->id())->get();
        return view('advertisement.index', ['advertisements' => $advertisements]);
    }

    public function show($id): View
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('advertisement.show', ['advertisement' => $advertisement, 'types' => $this->types]);
    }

    public function update(AdvertisementRequest $request, $id): RedirectResponse
    {
        $this->advertisementService->updateAdvertisement($request, $id);
        return to_route('advertisements.index');
    }

    public function create(): View
    {
        return view('advertisement.show', ['types' => $this->types]);
    }

    public function store(AdvertisementRequest $request): RedirectResponse
    {
        $this->advertisementService->storeAdvertisement($request);
        return to_route('advertisements.index');
    }

    public function delete($id): RedirectResponse
    {
        $this->advertisementService->deleteAdvertisement($id);
        return to_route('advertisements.index');
    }

    public function showFromId($id): View
    {
        $advertisement = Advertisement::where('id', $id)->firstOrFail();
        $relatedAdvertisements = Advertisement::where('user_id', $advertisement->user_id)->where('id', '!=', $id)->take(3)->get();
        $qrCodeDataUri = ImageService::getQrCode($id);

        return view('advertisement.show-from-id', [
            'advertisement' => $advertisement,
            'qrCode' => $qrCodeDataUri,
            'relatedAdvertisements' => $relatedAdvertisements,
        ]);
    }

    public function upload(Request $request): RedirectResponse
    {
        $this->advertisementService->uploadAdvertisements($request);
        return to_route('advertisements.index');
    }
}
