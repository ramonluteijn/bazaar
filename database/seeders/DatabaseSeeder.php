<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdvertisementSeeder::class,
            ContractSeeder::class,
            SettingSeeder::class,
            ReviewSeeder::class,
            OrderSeeder::class,
            ReturnProductSeeder::class,
            ContentPageSeeder::class,
        ]);
    }
}
