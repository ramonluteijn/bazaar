<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentBlock>
 */
class ContentBlockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['text', 'cta', 'hero', 'quote']),
            'active' => $this->faker->boolean,
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'image' => $this->faker->randomElement(['images/banner-1.jpg', 'images/banner-2.jpg']),
            'button_text' => $this->faker->word,
            'button_link' => $this->faker->url,
        ];
    }
}
