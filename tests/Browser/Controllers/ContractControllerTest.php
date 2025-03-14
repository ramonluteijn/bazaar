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
}
