<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ShopController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testShopIndex() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/shop')
                    ->assertSee('Shop');
        });
    }

    public function testShopIndexWithSorting() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/shop')
                    ->select('selectSorting', 'Old to new')
                    ->assertSee('Shop');
        });
    }
}
