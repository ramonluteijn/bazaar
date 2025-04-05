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
                    ->assertSee('Contract');
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

    public function testContractShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('contracts.show', 1)
                ->assertSee('Contract');
        });
    }

    public function testUpdateContract()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('contracts.show', 1)
                ->type('title', 'Test Contract')
                ->type('description', 'This is a test contract')
                ->select('status', 'signed')
                ->type('signed_at', '01-01-2026')
                ->press('Update contract')
                ->assertSee('Contracts');
        });
    }

    public function testDeleteContract()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('contracts.show', 1)
                ->press('Delete contract')
                ->waitForText('Contracts')
                ->assertSee('Contracts');
        });
    }
}
