<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\AdvertisementController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:10,1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function () {
    Route::apiResource('advertisements', AdvertisementController::class);
});
