<?php

namespace Tests\Browser\Components;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SearchbarTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testSearchbar(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/shop')
                ->assertSee('Search')
                ->type('#search', 'bid')
                ->keys('#search', '{enter}')
                ->assertPathIs('/shop');
        });
    }
}
