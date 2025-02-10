<?php

namespace App\Livewire;

use Livewire\Component;

class ShopItem extends Component
{
    public $advertisement;

    public function render()
    {
        return view('livewire.shop-item');
    }

    public function mount($advertisement)
    {
        $this->advertisement = $advertisement;
    }
}
