<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContentPage>
 */
class ContentPageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $googleFonts = [
            'Roboto', 'Open Sans', 'Lato', 'Montserrat', 'Oswald',
            'Raleway', 'Blake Hollow', 'Ubuntu', 'PT Sans', 'Noto Sans'
        ];

        return [
            'url' => $this->faker->regexify('[a-zA-Z0-9]{3,10}/[a-zA-Z0-9]{3,10}/?[a-zA-Z0-9]{0,10}'),
            'title' => $this->faker->sentence,
            'header_font' => $this->faker->randomElement($googleFonts),
            'body_font' => $this->faker->randomElement($googleFonts),
            'primary_color' => $this->faker->hexColor,
            'secondary_color' => $this->faker->hexColor,
        ];
    }
}
