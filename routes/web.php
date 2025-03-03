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
    Route::prefix('/advertisements')->group(function () {
        Route::get('/', [AdvertisementController::class, 'index'])->name('advertisements.index');
        Route::post('/upload', [AdvertisementController::class, 'uploadAdvertisements'])->name('advertisements.upload');
    });

    Route::prefix( '/advertisement')->group(function () {
        Route::get('/create', [AdvertisementController::class, 'createAdvertisement'])->name('advertisement.create');
        Route::post('/store', [AdvertisementController::class, 'storeAdvertisement'])->name('advertisement.store');

        Route::get('/{id}', [AdvertisementController::class, 'advertisement'])->name('advertisement.show');
        Route::put('/update/{id}', [AdvertisementController::class, 'updateAdvertisement'])->name('advertisement.update');
        Route::delete('/delete/{id}', [AdvertisementController::class, 'deleteAdvertisement'])->name('advertisement.delete');
    });
    Route::prefix('/contracts')->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('contracts.index');
    });
    Route::prefix('/contract')->group(function () {
        Route::get('/create', [ContractController::class, 'createContract'])->name('contract.create');
        Route::post('/store', [ContractController::class, 'storeContract'])->name('contract.store');

        Route::get('/{id}', [ContractController::class, 'contract'])->name('contract.show');
        Route::put('/update/{id}', [ContractController::class, 'updateContract'])->name('contract.update');
        Route::delete('/delete/{id}', [ContractController::class, 'deleteContract'])->name('contract.delete');

        Route::get('/download/{id}', [ContractController::class, 'downloadContract'])->name('contract.download');
    });
    Route::get('/custom-page', [AccountController::class, 'customPage'])->name('custom-page');
    Route::post('/custom-page', [AccountController::class, 'saveCustomPage'])->name('custom-page.store');
    Route::put('/custom-page/{id}', [AccountController::class, 'saveCustomPage'])->name('custom-page.update');
    Route::get('/return', [ReturnController::class, 'index'])->name('return.index');

    Route::prefix('/settings')->group(function () {
        Route::get('/create', [SettingController::class, 'create'])->name('settings.create');
        Route::post('/store', [SettingController::class, 'store'])->name('settings.store');

        Route::get('/', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/{id}', [SettingController::class, 'show'])->name('settings.show');
        Route::put('/update/{id}', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('/delete/{id}', [SettingController::class, 'delete'])->name('settings.delete');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::get('change-locale/{locale}', [Header::class, 'changeLocale'])->name('change-locale');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/advertisement/{id}', [AdvertisementController::class, 'showFromId'])->name('advertisement.read-from-id');

Route::get('/pages/{parent?}/{child?}/{grandchild?}', [PageController::class, 'index'])->name('pages');

Route::group(['prefix' => 'return'], function () {
    Route::get('/show', [ReturnController::class, 'show'])->name('return.show');
    Route::post('/store', [ReturnController::class, 'store'])->name('return.store');
});
