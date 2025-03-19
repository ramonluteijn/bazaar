<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnProduct>
 */
class ReturnProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wear = 0;
        foreach (Setting::all() as $setting) {
            if (rand(0, 1)) {
                $wear += $setting->percentage;
            }
        }

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'title' => $this->faker->sentence(),
            'image' => 'images/banner-2.jpg',
            'wear' => $wear
        ];
    }
}
