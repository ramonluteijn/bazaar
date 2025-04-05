<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\View\Components\Header;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WishlistController;
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

Route::group(['middleware' => 'Authenticate', 'prefix' => 'profile'], function () {
    Route::get('/dashboard', [AccountController::class, 'index'])->name('dashboard.show');

    Route::prefix('/wishlist')->group(function () {
        Route::get('/',[WishlistController::class,'index'])->name('wishlist.index');
        Route::delete('/delete/{advertisement}', [WishlistController::class, 'delete'])->name('wishlist.delete');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
    });

    Route::prefix('/basket')->group(function () {
        Route::get('/show', [BasketController::class, 'show'])->name('basket.show');
        Route::put('/update/{id}', [BasketController::class, 'update'])->name('basket.update');
        Route::get('/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');
    });

    Route::prefix('/advertisements')->group(function () {
        Route::get('/', [AdvertisementController::class, 'index'])->name('advertisements.index');
        Route::get('/create', [AdvertisementController::class, 'create'])->name('advertisements.create');
        Route::post('/store', [AdvertisementController::class, 'store'])->name('advertisements.store');
        Route::get('/{id}', [AdvertisementController::class, 'show'])->name('advertisements.show');
        Route::put('/update/{id}', [AdvertisementController::class, 'update'])->name('advertisements.update');
        Route::delete('/delete/{id}', [AdvertisementController::class, 'delete'])->name('advertisements.delete');
        Route::post('/upload', [AdvertisementController::class, 'upload'])->name('advertisements.upload');
        Route::post('/bid', [AdvertisementController::class, 'bid'])->name('advertisements.bid');
    });

    Route::prefix('/contracts')->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('contracts.index');
        Route::get('/create', [ContractController::class, 'create'])->name('contracts.create');
        Route::post('/store', [ContractController::class, 'store'])->name('contracts.store');
        Route::get('/{id}', [ContractController::class, 'show'])->name('contracts.show');
        Route::put('/update/{id}', [ContractController::class, 'update'])->name('contracts.update');
        Route::delete('/delete/{id}', [ContractController::class, 'delete'])->name('contracts.delete');
        Route::get('/download/{id}', [ContractController::class, 'download'])->name('contracts.download');
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
        Route::get('/show', [PageController::class, 'show'])->name('pages.show');
        Route::post('/store', [PageController::class, 'store'])->name('pages.store');
        Route::put('/{id}', [PageController::class, 'store'])->name('pages.update');
    });

    Route::prefix('/agenda')->group(function () {
        Route::get('/', [AgendaController::class, 'index'])->name('agenda.index');
    });

    Route::get('/return', [ReturnController::class, 'index'])->name('return.index');
    Route::delete('/review/delete/{id}', [ReviewController::class, 'delete'])->name('reviews.delete');

});

Route::prefix('/reviews')->group(function () {
    Route::post('/store', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/{id}', [ReviewController::class, 'show'])->name('user.profile');
});

Route::group(['middleware' => 'web'], function () {
    Route::get('change-locale/{locale}', [Header::class, 'changeLocale'])->name('change-locale');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/advertisement/{id}', [AdvertisementController::class, 'showFromId'])->name('advertisement.read-from-id');

Route::group(['prefix' => 'pages'], function () {
    Route::get('/', [PageController::class, 'index'])->name('pages.index');
    Route::get('/{parent?}/{child?}/{grandchild?}', [PageController::class, 'showFromUrl'])->name('pages.read-from-url');
});

Route::group(['prefix' => 'return'], function () {
    Route::get('/show', [ReturnController::class, 'show'])->name('return.show');
    Route::post('/store', [ReturnController::class, 'store'])->name('return.store');
});
