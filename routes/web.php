<?php

use App\Http\Controllers\auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::group(['middleware' => 'RedirectIfAuthenticated'], function () {
    Route::get('/showLoginForm', [AuthController::class, 'showLoginForm'])->name('showloginform');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/showregisterform', [AuthController::class, 'showRegisterForm'])->name('showregisterform');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
