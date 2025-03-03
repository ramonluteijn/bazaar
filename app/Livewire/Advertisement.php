<?php

namespace App\Livewire;

use Livewire\Component;

class Advertisement extends Component
{
    public $advertisement;
    public $qrCode;
    public $relatedAdvertisements;

    public function render()
    {
        return view('livewire.advertisement');
    }
}
