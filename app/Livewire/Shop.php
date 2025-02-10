<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Component;

class Shop extends Component
{
    public $advertisements;
    public $advertisers;
    public $sortOrder = 'new_to_old';

    public function render()
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
                $query->orderBy('updated_at', 'asc');
                break;
            case 'old_to_new':
                $query->orderBy('updated_at', 'desc');
                break;
        }
        return $query->get();
    }
}
