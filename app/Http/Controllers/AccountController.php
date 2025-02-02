<?php

namespace App\Http\Controllers;

use App\Services\PageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    private PageService $pageService;
    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function Dashboard()
    {
        $user = Auth::user();
        return view('account.dashboard', ['user' => $user]);
    }

    public function CustomPage()
    {
        return view('account.custom-page');
    }

    public function SaveCustomPage(Request $request)
    {
        $this->pageService->saveCustomPage($request);
        return redirect()->route('custom-page');
    }
}
