<?php

namespace App\Livewire;

use App\Dto\AdvertisementFilterDto;
use App\Services\AdvertisementFilterService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Shop extends Component
{
    public $advertisers;
    public string $sorting = 'newest';

    public function render()
    {
        $advertisementQuery = $this->filterAdvertisements()->paginate(1);
        return view('livewire.shop', [
            'advertisements' => $advertisementQuery,
            'advertisers' => $this->advertisers
        ]);
    }


    private function filterAdvertisements(): Builder
    {
        $advertisementFilterDTO = new AdvertisementFilterDto([
            'sorting' => $this->sorting,
        ]);

        return (new AdvertisementFilterService($advertisementFilterDTO))->apply();
    }

}
