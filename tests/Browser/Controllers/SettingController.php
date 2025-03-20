<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SettingController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testSettingIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.index')
                ->assertSee('Settings');
        });
    }

    public function testSettingCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.create')
                ->assertSee('Setting');
        });
    }

    public function testSettingStore(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.create')
                ->type('name', 'Test Setting')
                ->type('percentage', 10)
                ->press('Add setting')
                ->assertSee('Settings');
        });
    }
}
