<?php

namespace App\Livewire;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;

class Advertisement extends ItemInterface
{
    public $qrCode;
    public $relatedAdvertisements;
    public $reviews;
    public function render(): View
    {
        return view('livewire.advertisement');
    }

    public function addToCart($advertisementId)
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        if (isset($basket[$advertisementId])) {
            $basket[$advertisementId]++;
        } else {
            $basket[$advertisementId] = 1;
        }
        Cookie::queue('basket', json_encode($basket), 10080); // Store for 7 days
        $this->dispatch("cart-updated");
    }
}
