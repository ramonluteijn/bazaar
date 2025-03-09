<?php

namespace App\Livewire;

use App\Services\WishlistService;
use Livewire\Component;
use App\Models\Advertisement;
class ItemInterface extends Component
{
    protected WishlistService $wishlistService;
    protected Advertisement $advertisement;

    public function boot(WishlistService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }
    public function mount(Advertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }
    public function addWishlist()
    {
        $this->wishlistService->addWishlist($this->advertisement->id);
    }
    public function removeWishlist()
    {
        $this->wishlistService->removeWishlist($this->advertisement->id);
    }
}
