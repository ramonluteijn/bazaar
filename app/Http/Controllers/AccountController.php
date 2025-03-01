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

    public function customPage()
    {
        $user = Auth::user();
        $page = $this->pageService->getCustomPageWithBlocks($user->id);

        return view('account.custom-page', ['page' => $page]);
    }

    public function saveCustomPage(Request $request)
    {
        $this->pageService->saveCustomPage($request);
        return redirect()->route('custom-page');
    }
}
