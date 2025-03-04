<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\View\Components\Header;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home.index');

Route::group(['middleware' => 'RedirectIfAuthenticated'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.show');
    Route::post('/login', [AuthController::class, 'login'])->name('login.save');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('register.save');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard.show');

    Route::prefix('/advertisements')->group(function () {
        Route::get('/', [AdvertisementController::class, 'index'])->name('advertisements.index');
        Route::get('/create', [AdvertisementController::class, 'createAdvertisement'])->name('advertisements.create');
        Route::post('/store', [AdvertisementController::class, 'storeAdvertisement'])->name('advertisements.store');
        Route::get('/{id}', [AdvertisementController::class, 'advertisement'])->name('advertisements.show');
        Route::put('/update/{id}', [AdvertisementController::class, 'updateAdvertisement'])->name('advertisements.update');
        Route::delete('/delete/{id}', [AdvertisementController::class, 'deleteAdvertisement'])->name('advertisements.delete');
        Route::post('/upload', [AdvertisementController::class, 'uploadAdvertisements'])->name('advertisements.upload');
    });

    Route::prefix('/contracts')->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('contracts.index');
        Route::get('/create', [ContractController::class, 'createContract'])->name('contracts.create');
        Route::post('/store', [ContractController::class, 'storeContract'])->name('contracts.store');
        Route::get('/{id}', [ContractController::class, 'contract'])->name('contracts.show');
        Route::put('/update/{id}', [ContractController::class, 'updateContract'])->name('contracts.update');
        Route::delete('/delete/{id}', [ContractController::class, 'deleteContract'])->name('contracts.delete');
        Route::get('/download/{id}', [ContractController::class, 'downloadContract'])->name('contracts.download');
    });

    Route::prefix('/settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
        Route::post('/store', [SettingController::class, 'store'])->name('settings.store');
        Route::get('/{id}', [SettingController::class, 'show'])->name('settings.show');
        Route::put('/update/{id}', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('/delete/{id}', [SettingController::class, 'delete'])->name('settings.delete');
    });
    Route::prefix('/pages')->group(function () {
        Route::get('/', [PageController::class, 'index'])->name('pages.index');
        Route::post('/store', [PageController::class, 'store'])->name('pages.store');
        Route::put('/{id}', [PageController::class, 'store'])->name('pages.update');
    });

    Route::get('/return', [ReturnController::class, 'index'])->name('return.index');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('change-locale/{locale}', [Header::class, 'changeLocale'])->name('change-locale');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/advertisement/{id}', [AdvertisementController::class, 'showFromId'])->name('advertisement.read-from-id');
Route::get('/pages/{parent?}/{child?}/{grandchild?}', [PageController::class, 'show'])->name('pages.show');

Route::group(['prefix' => 'return'], function () {
    Route::get('/show', [ReturnController::class, 'show'])->name('return.show');
    Route::post('/store', [ReturnController::class, 'store'])->name('return.store');
});
