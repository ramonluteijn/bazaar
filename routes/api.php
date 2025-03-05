<?php

use App\Http\Controllers\Api\V1\AdvertisementController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('advertisements', AdvertisementController::class);
});
