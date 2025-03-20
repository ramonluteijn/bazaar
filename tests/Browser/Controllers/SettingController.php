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
                ->assertRouteIs('settings.index');
        });
    }

    public function testSettingShow(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.show', 1)
                ->assertSee('Setting');
        });
    }

    public function testSettingUpdate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.show', 1)
                ->type('name', 'Test Setting')
                ->type('percentage', 10)
                ->press('Update setting')
                ->assertRouteIs('settings.index');
        });
    }

    public function testSettingUpdateWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.show', 1)
                ->type('name', 'Test Setting')
                ->type('percentage', 101)
                ->press('Update setting')
                ->assertSee('Percentage must be between 0 and 100');
        });
    }

    public function testSettingDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('settings.show', 1)
                ->press('Delete setting')
                ->assertRouteIs('settings.index');
        });
    }
}
