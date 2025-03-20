<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AgendaController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testAgendaIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->assertSee('Agenda');
        });
    }

    public function testAgendaOrders(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->select('selectTable', 'orders')
                ->press('Select')
                ->assertSee('Orders');
        });
    }

    public function testAgendaAdvertisements(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->select('selectTable', 'advertisements')
                ->press('Select')
                ->assertSee('Advertisements');
        });
    }

    public function testAgendaAdvertisementsBySale(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->select('selectTable', 'advertisements')
                ->select('selectType', 'sale')
                ->press('Select')
                ->assertSee('Advertisements');
        });
    }

    public function testAgendaAdvertisementsByHire(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->select('selectTable', 'advertisements')
                ->select('selectType', 'hire')
                ->press('Select')
                ->assertSee('Advertisements');
        });
    }

    public function testAgendaAdvertisementsByBid(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('agenda.index')
                ->select('selectTable', 'advertisements')
                ->select('selectType', 'bid')
                ->press('Select')
                ->assertSee('Advertisements');
        });
    }
}
