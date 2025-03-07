<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class Advertisement extends Component
{
    public $advertisement;
    public $qrCode;
    public $relatedAdvertisements;
    public $reviews;
    public function render(): View
    {
        return view('livewire.advertisement');
    }
}
