<?php

namespace Tests\Browser\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class BasketController extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testBasketIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visit(route('basket.show'))
                ->assertSee('Basket');
        });
    }

    public function testBasketUpdate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->cookie('basket', json_encode([1 => 1]));
            $browser->loginAs(1)
                ->visit(route('basket.show'))
                ->assertSee('Basket')
                ->press('+')
                ->assertSee('2')
                ->press('-')
                ->assertSee('1')
                ->press('Delete')
                ->assertDontSee('Advertisement');
        });
    }

    public function testCheckout(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->cookie('basket', json_encode([1 => 1]));
            $browser->loginAs(1)
                ->visit(route('basket.checkout'))
                ->assertSee('Checkout');
        });
    }

    public function testCheckoutData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->cookie('basket', json_encode([1 => 1]));
            $browser->loginAs(1)
                ->visit(route('basket.checkout'))
                ->assertSee('Checkout')
                ->type('name', 'John Doe')
                ->type('address', '123 Main St')
                ->type('delivery_address', '456 Elm St')
                ->type('phone', '1234567890')
                ->type('email', 'john.doe@example.com')
                ->type('zip', '10001')
                ->type('city', 'New York')
                ->type('state', 'NY')
                ->type('country', 'USA')
                ->type('comment', 'Please deliver between 9 AM and 5 PM')
                ->scrollIntoView('button[type="submit"]')
                ->press('Submit Order')
                ->assertSee('Orders');
        });
    }

    public function testCheckoutWithInvalidData(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->cookie('basket', json_encode([1 => 1]));
            $browser->loginAs(1)
                ->visit(route('basket.checkout'))
                ->assertSee('Checkout')
                ->type('name', 'John Doe')
                ->type('address', '123 Main St')
                ->type('delivery_address', '456 Elm St')
                ->type('phone', '123456789064721064714')
                ->type('email', 'john.doe@example.com')
                ->type('zip', '100012312321312')
                ->type('city', 'New York')
                ->type('state', 'NY')
                ->type('country', 'USA')
                ->type('comment', 'Please deliver between 9 AM and 5 PM')
                ->scrollIntoView('button[type="submit"]')
                ->press('Submit Order')
                ->assertSee('The phone field must not be greater than 20 characters.')
                ->assertSee('The zip field must not be greater than 10 characters.');
        });
    }
}
