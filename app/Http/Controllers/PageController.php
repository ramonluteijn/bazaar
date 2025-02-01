<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($parent = null, $child = null, $grandchild = null)
    {
        $url = request()->path();
        preg_match('/pages\/(.*)/', $url, $url);
        $pages = ContentPage::where('url', $url[1])->firstOrFail();
        if ($pages->url === 'home') {
            return to_route('home');
        }
        return view('pages.custom', ['pages' => $pages]);
    }
}
