<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\BasketController;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\ContractService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    private ContractService $contractService;
    private array $roles = ['user' => 'User', 'private_advertiser' => 'Private advertiser', 'business_advertiser' => 'Business advertiser'];
    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    public function showRegisterForm(): View
    {
        return view('auth.register', ['roles' => $this->roles]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return to_route('login.show');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $basketController = new BasketController();
            $basketController->addExpiredBidsToCart();
            return to_route('dashboard.show');
        }

        return back()->withErrors([
            'email' => __('The provided credentials do not match our records.'),
        ])->withInput();
    }

    public function register(UserRequest $request): RedirectResponse
    {
        $request->validated();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        Auth::login($user);

        if ($request->role === 'business_advertiser') {
            $this->contractService->createContract($request);
        }

        return to_route('dashboard.show');
    }
}
