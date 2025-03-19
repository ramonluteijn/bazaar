<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Component;
class AdvertisementInterface extends Component
{
    public Advertisement $advertisement;

    public function mount(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }
}
