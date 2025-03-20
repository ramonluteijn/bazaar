<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PageController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testPageIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('pages.index')
                ->assertSee('Pages');
        });
    }

    public function testPageShow(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('pages.show')
                ->assertSee('Page');
        });
    }

    public function testPageStore(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('pages.show')
                ->type('title', 'Test')
                ->type('url', 'test')
                ->press('Create')
                ->assertSee('Page');
        });
    }

    public function testPageReadFromUrl(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('pages.read-from-url', 'test')
                ->assertSee('Page');
        });
    }
}
