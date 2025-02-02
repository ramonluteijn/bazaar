<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::group(['middleware' => 'RedirectIfAuthenticated'], function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth', 'prefix' => 'profile'], function () {
    Route::get('/dashboard', [AccountController::class, 'dashboard'])->name('dashboard');
    Route::get('/custom-page', [AccountController::class, 'customPage'])->name('custom-page');
    Route::post('/custom-page', [AccountController::class, 'saveCustomPage'])->name('custom-page.store');
});

Route::get('/pages/{parent?}/{child?}/{grandchild?}', [PageController::class, 'index'])->name('pages');
