<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class OrderController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testOrdersIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('orders.index')
                    ->assertSee('Orders');
        });
    }

    public function testOrdersOutgoing()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('orders.index', ['selectType' => 'outgoing'])
                    ->assertSee('Orders');
        });
    }

    public function testOrdersIncoming()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('orders.index', ['selectType' => 'incoming'])
                    ->assertSee('Orders');
        });
    }

    public function testOrdersShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('orders.show', 1)
                    ->assertSee('Order');
        });
    }
}
