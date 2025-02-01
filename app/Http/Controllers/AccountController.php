<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function Dashboard()
    {
        $user = Auth::user();
        return view('account.dashboard', ['user' => $user]);
    }

    public function CustomPage()
    {
        return view('account.custom-page');
    }
}
