<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\AdvertisementsFilter;
use App\Http\Resources\V1\AdvertisementCollection;
use App\Http\Resources\V1\AdvertisementResource;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class AdvertisementController
{
    public function index(Request $request): AdvertisementCollection
    {
        $filter = new AdvertisementsFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) > 0) {
            return new AdvertisementCollection(Advertisement::where($queryItems)->get());
        }
        return new AdvertisementCollection(Advertisement::all());
    }

    public function show(Advertisement $advertisement): AdvertisementResource
    {
        return new AdvertisementResource($advertisement);
    }
}
