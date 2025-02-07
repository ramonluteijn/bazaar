<?php

namespace App\Livewire;

use Livewire\Component;

class AdvertisementForm extends Component
{
    public $advertisementObject;
    public $types = ['sale', 'hire'];

    public function render()
    {
        return view('livewire.advertisement-form');
    }

    public function mount($advertisementObject)
    {
        if(isset($advertisementObject)) {
            $this->advertisementObject = $advertisementObject;
        }
    }
}
