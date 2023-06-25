<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->unique()->numberBetween(1, User::count()),
            'payment_method' => fake()->randomElement(PaymentMethod::toArray()),
            'payment_status' => fake()->randomElement(PaymentStatus::toArray()),
            'status' => fake()->randomElement(OrderStatus::toArray()),
            'shipping_method' => fake()->randomElement(ShippingMethod::toArray()),
            'total_price' => fake()->numberBetween(1, 1000),
        ];
    }
}
