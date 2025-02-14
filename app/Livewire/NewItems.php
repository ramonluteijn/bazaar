<?php

namespace App\Livewire;

use App\Models\Advertisement;
use Livewire\Component;

class NewItems extends Component
{
    public int $amount;
    public ?string $title;
    public ?string $link;
    public ?string $linkText;

    public function mount(?string $title, int $amount, ?string $link = null, ?string $linkText = null)
    {
        $this->title = $title;
        if ($amount >5) {
            $amount = 5;
        }
        $this->amount = $amount;
        $this->link = $link;
        $this->linkText = $linkText;
    }


    public function render()
    {
        return view('livewire.new-items',[
            'advertisements' => Advertisement::orderBy('id', 'desc')->take($this->amount)->get(['id', 'title', 'description', 'price', 'image', 'type', 'user_id', 'expires_at']),
        ]);
    }
}
