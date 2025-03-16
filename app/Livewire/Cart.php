<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\On;
class Cart extends Component
{
    public $itemCount = 0;

    public function mount()
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        $this->itemCount = array_sum($basket);
    }

    #[On('cart-updated')]
    public function onCartUpdated()
    {
        $basket = json_decode(Cookie::get('basket'), true) ?? [];
        $this->itemCount = array_sum($basket);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
