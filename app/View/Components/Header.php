<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }

    public function changeLocale(string $locale): RedirectResponse
    {
        if (!array_key_exists($locale, config('app.available_locales'))) {
            abort(400);
        }

        session()->put('locale', $locale);
        return redirect()->back();
    }
}
