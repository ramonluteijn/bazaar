<?php

namespace Database\Factories;

use App\Models\Advertisement;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'advertisement_id' => Advertisement::factory(),
            'amount' => $this->faker->numberBetween(1, 10),
        ];
    }
}
