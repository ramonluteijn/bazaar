<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdvertisementRequest;
use App\Http\Requests\BidRequest;
use App\Models\Advertisement;
use App\Services\AdvertisementService;
use App\Services\BidService;
use App\Services\ImageService;
use App\Services\ReviewService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdvertisementController
{
    private AdvertisementService $advertisementService;
    private ReviewService $reviewService;
    private BidService $bidService;

    private array $types = ['sale' => 'sale', 'hire' => 'hire', 'bid' => 'bid'];
    public function __construct(AdvertisementService $advertisementService, ReviewService $reviewService, BidService $bidService)
    {
        $this->advertisementService = $advertisementService;
        $this->reviewService = $reviewService;
        $this->bidService = $bidService;
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

        $reviews = $this->reviewService->getReviewsAdvertisement($id);


        return view('advertisement.show-from-id', [
            'advertisement' => $advertisement,
            'qrCode' => $qrCodeDataUri,
            'relatedAdvertisements' => $relatedAdvertisements,
            'reviews' => $reviews,
        ]);
    }

    public function upload(Request $request): RedirectResponse
    {
        $this->advertisementService->uploadAdvertisements($request);
        return to_route('advertisements.index');
    }

    public function bid(BidRequest $request): RedirectResponse
    {
        try {
            $this->bidService->placeBid(
                $request->advertisement_id,
                $request->user()->id,
                $request->bid_amount
            );
            return redirect()->back()->with('success', __('Bid placed successfully.'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['bid_amount' => $e->getMessage()]);
        }
    }
}
