<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Shop extends Component
{
    public $advertisements;
    public $advertisers;
    public $sortOrder = 'new_to_old';

    public function render(): View|Factory|Application
    {
        $this->advertisements = $this->advertisementOrder();
        return view('livewire.shop', [
            'advertisements' => $this->advertisements,
            'advertisers' => $this->advertisers
        ]);
    }

    public function mount()
    {

    }

    public function advertisementOrder()
    {
        $query = Advertisement::where('expires_at', '>', now());

        switch ($this->sortOrder) {
            case 'high_to_low':
                $query->orderBy('price', 'desc');
                break;
            case 'low_to_high':
                $query->orderBy('price', 'asc');
                break;
            case 'new_to_old':
                $query->orderBy('id', 'asc');
                break;
            case 'old_to_new':
                $query->orderBy('id', 'desc');
                break;
        }
        return $query->get();
    }
}
