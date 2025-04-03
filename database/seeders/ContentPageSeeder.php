<?php

namespace Database\Seeders;

use App\Models\ContentBlock;
use App\Models\ContentPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::whereHas('roles', function ($query) {
            $query->where('name', 'business_advertiser');
        })->get();

        foreach ($users as $user) {
            $contentPage = ContentPage::factory()->create([
                'user_id' => $user->id,
            ]);

            $types = ['text', 'cta', 'hero', 'quote'];
            foreach ($types as $type) {
                ContentBlock::factory()->create([
                    'content_page_id' => $contentPage->id,
                    'type' => $type,
                ]);
            }
        }
    }
}
