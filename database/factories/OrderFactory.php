<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'delivery_address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'country' => $this->faker->country,
            'comment' => $this->faker->sentence,
            'total' => 0,
        ];
    }

    /**
     * Configure the factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Order $order) {
            $orderDetails = OrderDetail::factory(3)->create(['order_id' => $order->id]);

            $total = $orderDetails->sum(function ($orderDetail) {
                return $orderDetail->advertisement->price * $orderDetail->amount;
            });

            $order->update(['total' => $total]);
        });
    }
}
