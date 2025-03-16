<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ShopItem extends ItemInterface
{

    public function render(): View|Factory|Application
    {
        return view('livewire.shop-item');
    }

    public function mount($advertisement): void
    {
        $this->advertisement = $advertisement;
    }
}
