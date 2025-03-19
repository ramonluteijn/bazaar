<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReturnController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testReturnIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/return')
                ->assertSee('Return');
        });
    }

    public function testReturnShow(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/return/show')
                ->assertSee('Return Form');
        });
    }

    public function testReturnStore(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/return/show')
                ->type('name', 'John Doe')
                ->type('email', 'johnDoe@example.com')
                ->type('title', 'Return Title')
                ->attach('image', storage_path('app/public/images/banner-2.jpg'))
                ->press('Submit')
                ->assertSee('Return Form');
        });
    }
}
