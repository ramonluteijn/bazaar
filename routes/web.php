<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ShopController;
use App\View\Components\Header;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => 'RedirectIfAuthenticated'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.save');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.save');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
    Route::prefix( '/advertisement')->group(function () {
        Route::get('/create', [AdvertisementController::class, 'createAdvertisement'])->name('advertisement.create');
        Route::post('/store', [AdvertisementController::class, 'storeAdvertisement'])->name('advertisement.store');
        Route::post('/advertisements/upload', [AdvertisementController::class, 'uploadAdvertisements'])->name('advertisements.upload');

        Route::get('/{id}', [AdvertisementController::class, 'advertisement'])->name('advertisement.show');
        Route::put('/update/{id}', [AdvertisementController::class, 'updateAdvertisement'])->name('advertisement.update');
        Route::delete('/delete/{id}', [AdvertisementController::class, 'deleteAdvertisement'])->name('advertisement.delete');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::get('change-locale/{locale}', [Header::class, 'changeLocale'])->name('change-locale');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/advertisement/{id}', [AdvertisementController::class, 'showFromId'])->name('advertisement.read-from-id');
