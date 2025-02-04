<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function index()
    {
        $advertisements = Advertisement::where("user_id", auth()->id())->get();
        return view('account.advertisements', ['advertisements' => $advertisements]);
    }

    public function advertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('account.advertisement', ['advertisement' => $advertisement]);
    }

    public function updateAdvertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->update(request()->all());
        return redirect()->route('advertisements.index');
    }

    public function deleteAdvertisement($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();
        return redirect()->route('advertisements.index');
    }
}
