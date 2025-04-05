<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WishlistController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testWishlistIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('wishlist.index')
                    ->assertSee('Wishlist');
        });
    }

   public function testAddToWishlist()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisement.read-from-id', 1)
                    ->press('@wishlist-button')
                    ->assertPathIs('/advertisement/1');
        });
    }
}
