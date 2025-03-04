<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    private AdvertisementService $advertisementService;
    private array $types = ['sale' => 'sale', 'hire' => 'hire', 'bid' => 'bid'];
    public function __construct(AdvertisementService $advertisementService)
    {
        $this->advertisementService = $advertisementService;
    }

    public function index()
    {
        $advertisements = Advertisement::where("user_id", auth()->id())->get();
        return view('advertisement.index', ['advertisements' => $advertisements]);
    }

    public function advertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('advertisement.show', ['advertisement' => $advertisement, 'types' => $this->types]);
    }

    public function updateAdvertisement(AdvertisementRequest $request, $id)
    {
        $this->advertisementService->updateAdvertisement($request, $id);
        return to_route('advertisements.index');
    }

    public function createAdvertisement()
    {
        return view('advertisement.show', ['advertisement' => null, 'types' => $this->types]);
    }

    public function storeAdvertisement(AdvertisementRequest $request)
    {
        $this->advertisementService->storeAdvertisement($request);
        return to_route('advertisements.index');
    }

    public function deleteAdvertisement($id)
    {
        $this->advertisementService->deleteAdvertisement($id);
        return to_route('advertisements.index');
    }

    public function showFromId($id)
    {
        $advertisement = Advertisement::where('id', $id)->firstOrFail();
        $relatedAdvertisements = Advertisement::where('user_id', $advertisement->user_id)->where('id', '!=', $id)->take(3)->get();
        $qrCode = new Builder(
            writer: new PngWriter(),
            data: route('advertisement.read-from-id', ['id' => $id])
        );

        $qrCodeDataUri = $qrCode->build()->getDataUri();

        return view('advertisement.show-from-id', [
            'advertisement' => $advertisement,
            'qrCode' => $qrCodeDataUri,
            'relatedAdvertisements' => $relatedAdvertisements,
        ]);
    }

    public function uploadAdvertisements(Request $request)
    {
        $this->advertisementService->uploadAdvertisements($request);
        return to_route('advertisements.index');
    }
}
