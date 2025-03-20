<?php

namespace Database\Seeders;

use App\Models\Contract;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advertisers = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'business_advertiser');
        })->get();

        $owner = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'owner');
        })->first(); // Get the first owner

        foreach ($advertisers as $advertiser) {
            Contract::factory()->create([
                'business_advertiser_id' => $advertiser->id,
                'owner_id' => $owner->id,
            ]);
        }
    }
}
