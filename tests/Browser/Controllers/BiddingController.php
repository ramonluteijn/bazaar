<?php

namespace Tests\Browser\Controllers;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BiddingController extends DuskTestCase
{
    public function testPlaceBid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('shop.index')
                ->select('type', 'bid')
                ->waitFor('.grid .bg-white.shadow-md.rounded.overflow-hidden.mb-4.relative', 1) // Wait for the grid items to load
                ->click('.grid .bg-white.shadow-md.rounded.overflow-hidden.mb-4.relative:first-child a')
                ->type('bid_amount', 1500)
                ->press('Place a bid')
                ->assertSeeIn('.list-disc', '$1500');
        });
    }

    public function testAdvertisementsStore()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.create')
                ->select('type', 'bid')
                ->type('title', 'Test Advertisement')
                ->type('description', 'This is a test advertisement')
                ->type('price', 100)
                ->type('buyout_price', 150)
                ->select('auction_ends_at_select', '3 Hours')
                ->press('Add advertisement')
                ->assertSee('Advertisements');
        });
    }
    public function testAdvertisementsStoreError()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.create')
                ->select('type', 'bid')
                ->type('title', 'Test Advertisement')
                ->type('description', 'This is a test advertisement')
                ->type('price', 100)
                ->type('buyout_price', 50)
                ->select('auction_ends_at_select', '3 Hours')
                ->press('Add advertisement')
                ->waitForText('Buyout price must be greater than the price')
                ->assertSee('Buyout price must be greater than the price');
        });
    }
}
