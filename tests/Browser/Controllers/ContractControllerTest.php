<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ContractControllerTest extends DuskTestCase
{
    public function testContractsIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('contracts.index')
                    ->assertSee('Contracts');
        });
    }

    public function testCreateContract()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('contracts.create')
                    ->assertSee('Create contract');
        });
    }

    public function testStoreContract()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('contracts.create')
                    ->type('title', 'Test Contract')
                    ->type('description', 'This is a test contract')
                    ->select('status', 'pending')
                    ->type('signed_at', '01-01-2026')
                    ->press('Add contract')
                    ->assertSee('Contracts');
        });
    }

    public function testUpdateContract()
    {

    }
}
