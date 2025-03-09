<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class HeartWishlist extends Component
{
    public $advertisement_id;
    public $isWishlisted = false;

    public function mount($advertisementId)
    {
        $this->advertisement_id = $advertisementId;
        $this->isWishlisted = Wishlist::where('user_id', auth()->id())
            ->where('advertisement_id', $this->advertisement_id)
            ->exists();
    }

    public function toggleWishlist()
    {
        if ($this->isWishlisted) {
            Wishlist::where('user_id', auth()->id())
                ->where('advertisement_id', $this->advertisement_id)
                ->delete();
            $this->isWishlisted = false;
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'advertisement_id' => $this->advertisement_id,
            ]);
            $this->isWishlisted = true;
        }
    }

    public function render()
    {
        return view('livewire.heart-wishlist');
    }
}
