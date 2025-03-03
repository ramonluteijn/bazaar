<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReturnRequest;
use App\Models\ReturnProduct;
use App\Models\Setting;
use App\Services\ReturnService;

class ReturnController extends Controller
{
    private ReturnService $returnService;

    public function __construct(ReturnService $returnService)
    {
        $this->returnService = $returnService;
    }

    public function index()
    {
        $return = ReturnProduct::all();
        return view('return.index', ['return' => $return]);
    }

    public function show()
    {
        $settings = Setting::all();
        $wear = session('wear', null);
        return view('return.show', ['settings' => $settings, 'wear' => $wear]);
    }

    public function store(ReturnRequest $request)
    {
        $data = $this->returnService->createReturn($request);
        $settings = Setting::all();
        $wear = $data->wear;

        return to_route('return.show', ['wear' => $wear])->withInput()->with(['settings' => $settings, 'wear' => $wear]);
    }
}
