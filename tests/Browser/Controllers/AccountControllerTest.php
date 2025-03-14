<?php

namespace Tests\Browser\Controllers;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AccountControllerTest extends DuskTestCase
{
    public function testDashboardWithoutBeingLoggedIn(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('dashboard.show')
                    ->assertSee('Login');
        });
    }

    public function testDashboardAfterBeingLoggedIn(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('dashboard.show')
                    ->assertSee('Dashboard');
        });
    }
}
