<?php

namespace Tests\Browser\Controllers;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdvertisementControllerTest extends DuskTestCase
{

    public function testAdvertisementsIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.index')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsCreate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.create')
                    ->assertSee('Advertisement');
        });
    }

    public function testAdvertisementsStore()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.create')
                    ->type('title', 'Test Advertisement')
                    ->type('description', 'This is a test advertisement')
                    ->type('price', 100)
                    ->type('expires_at', '01-01-2026')
                    ->select('type', 'sale')
                    ->press('Add advertisement')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsStoreWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.create')
                ->type('title', 'test title')
                ->type('description', 'This is a test advertisement')
                ->type('price', '123456789123456789')
                ->type('expires_at', '01-01-2024')
                ->select('type', 'sale')
                ->press('Add advertisement')
                ->assertSee('Price is too high')
                ->assertSee('Expires at must be after today');
        });
    }

    public function testAdvertisementsShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.show', 1)
                    ->assertSee('Advertisement');
        });
    }

    public function testAdvertisementsUpdate()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.show', 1)
                    ->type('title', 'Test Advertisement Updated')
                    ->type('description', 'This is a test advertisement updated')
                    ->type('price', 200)
                ->select('type', 'hire')
                ->type('expires_at', '01-01-2027')
                    ->press('Update advertisement')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsUpdateWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.show', 1)
                ->type('title', 'Test Advertisement Updated')
                ->type('description', 'This is a test advertisement updated')
                ->type('price', 123456789123456789)
                ->select('type', 'hire')
                ->type('expires_at', '01-01-2024')
                ->press('Update advertisement')
                ->assertSee('Price is too high')
                ->assertSee('Expires at must be after today');
        });
    }

    public function testAdvertisementShowFromId()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisement.read-from-id', 1)
                    ->assertSee('Advertisement');
        });
    }

    public function testAdvertisementsDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.show', 1)
                    ->press('Delete advertisement')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsUpload()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.index')
                    ->attach('csv_file', storage_path('app/public/advertisements.csv'))
                    ->press('Upload')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsUploadWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.index')
                ->attach('csv_file', storage_path('app/public/images/banner-2.jpg'));

            $browser->script('window.scrollTo(0, 500);');

            $browser->press('Upload')
                ->assertSee('The CSV file must be a file of type: csv, txt.');
        });
    }
}
