<?php

namespace Tests\Browser\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdvertisementControllerTest extends DuskTestCase
{


    protected function setUp(): void
    {
        parent::setUp();
        $this->runFakeDatabaseSeeder();

    }
    function runFakeDatabaseSeeder()
    {
        // Disable foreign key checks to avoid constraint violations
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate all tables
        foreach (DB::select('SHOW TABLES') as $table) {
            $tableName = array_values((array)$table)[0];
            DB::table($tableName)->truncate();
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Run the database seeder
        Artisan::call('db:seed', [
            '--class' => 'DatabaseSeeder',
            '--force' => true, // Force the operation to run when in production
        ]);
    }
    public function testAdvertisementsIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                    ->visitRoute('advertisements.index')
                    ->assertSee('Advertisements');
        });
    }

    public function testAdvertisementsUploadWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.index')
                ->attach('csv_file', storage_path('app/public/images/banner-2.jpg'));

            $browser->script('window.scrollTo(0, 1000);');

            $browser->press('Upload')
                ->assertSee('The CSV file must be a file of type: csv, txt.');
        });
    }

    public function testAdvertisementsUpload()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.index')
                ->attach('csv_file', storage_path('app/public/advertisements.csv'))
                ->press('Upload')
                ->assertRouteIs('advertisements.index');
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
                ->select('type', 'sale')
                ->type('expires_at', '01-01-2024')
                ->press('Add advertisement')
                ->screenshot('store-advertisement-invalid')
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

    public function testAdvertisementsUpdateWithInvalidData()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1)
                ->visitRoute('advertisements.show', 1)
                ->type('title', 'Test Advertisement Updated')
                ->type('description', 'This is a test advertisement updated')
                ->type('price', 123456789123456789)
                ->select('type', 'hire')
                ->type('expires_at', '01-01-2024');
            $browser->script('window.scrollTo(0, 500);');
            $browser->press('Update advertisement')
                ->assertSee('Price is too high')
                ->assertSee('Expires at must be after today');
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
                    ->type('collection_date', '02-01-2027')
                    ->type('return_date', '04-01-2027');
            $browser->script('window.scrollTo(0, 500);');
            $browser->press('Update advertisement')
                    ->assertRouteIs('advertisements.index');
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
                    ->visitRoute('advertisements.show', 1);
            $browser->script('window.scrollTo(0, 500);');
            $browser->press('Delete advertisement')
                    ->assertNotPresent('Test Advertisement Updated');
        });
    }
}
