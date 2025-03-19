<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advertisers = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['business_advertiser', 'private_advertiser']);
        })->take(15)->get();

        foreach ($advertisers as $advertiser) {
            Review::factory()->create([
                'user_id' => $advertiser->id,
                'advertisement_id' => null,
            ]);
        }

        $advertisements = Advertisement::take(15)->get();
        foreach ($advertisements as $advertisement) {
            Review::factory()->create([
                'user_id' => null,
                'advertisement_id' => $advertisement->id,
            ]);
        }
    }
}
