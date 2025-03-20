<?php

namespace Database\Seeders;

use App\Models\ReturnProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReturnProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReturnProduct::factory(5)->create();
    }
}
