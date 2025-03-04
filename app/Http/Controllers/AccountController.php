<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class AccountController
{
    public function index(): View
    {
        $user = Auth::user();
        return view('account.index', ['user' => $user]);
    }
}
