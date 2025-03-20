<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ReviewController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testReviewStore(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('advertisement.read-from-id', ['id' => 1])
                ->type('title', 'Test review')
                ->type('content', 'Test review')
                ->type('rating', 5)
                ->type('email','johnDoe@example.nl')
                ->type('name','John Doe')
                ->scrollIntoView('button[type="submit"]')
                ->press('Submit')
                ->assertPathIs('/advertisement/1');
        });
    }

    public function testReviewStoreWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('advertisement.read-from-id', ['id' => 1])
                ->type('title', 'Test review')
                ->type('content', 'Test review')
                ->type('rating', '20')
                ->type('email', 'johnDoe@example.nl')
                ->type('name', 'John Doe')
                ->scrollIntoView('button[type="submit"]')
                ->press('Submit')
                ->assertSee('Rating must not be greater than 10');
        });
    }

    public function testReviewShow(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('user.profile', ['id' => 1])
                ->assertSee('Create Review');
        });
    }

    public function testReviewDelete(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisement.read-from-id', ['id' => 1])
                ->script([
                    "document.querySelector('button[dusk=\"delete-review\"]').click()"
                ]);
                $browser->assertPathIs('/advertisement/1');
        });
    }
}
