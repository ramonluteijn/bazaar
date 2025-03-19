<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['sale', 'hire', 'bid']);
        $data = [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'type' => $type,
            'expires_at' => $this->faker->dateTimeBetween('now', '+1 year'),
            'user_id' => User::whereHas('roles', function ($query) {
                $query->whereIn('name', ['private_advertiser', 'business_advertiser']);
            })->inRandomOrder()->first()->id,
        ];

        if ($type === 'hire') {
            $data['collection_date'] = $this->faker->dateTimeBetween('now', '+1 month');
            $data['return_date'] = $this->faker->dateTimeBetween('+1 month', '+2 months');
        }

        return $data;
    }
}
