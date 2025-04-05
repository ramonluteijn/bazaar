<?php

namespace Tests\Browser\Components;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FilterTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testFilter(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit('/shop')
                ->assertSee('Type')
                ->select('type', 'bid')
                ->assertPathIs('/shop');
        });
    }
}
