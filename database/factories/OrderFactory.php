<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Actions\Product\GenerateRefId;
use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use App\Enums\ShippingMethod;
use App\Models\Order\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model> */
class OrderFactory extends Factory
{
    /** @property string $model*/
    protected $model = Order::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'ref_id' => GenerateRefId::run(),
            'email' => fake()->email(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            // 'company' => fake()->company(),
            'address' => fake()->address(),
            // 'unit' => fake()->numerify('###'),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'state' => fake()->name(),
            'postal_code' => fake()->numerify('####'),
            'phone' => fake()->phoneNumber(),
            'is_saved' => false,
            'user_id' => fake()->numberBetween(1, User::count()),
            'payment_method' => fake()->randomElement(PaymentMethod::toArray()),
            'payment_status' => fake()->randomElement(PaymentStatus::toArray()),
            'status' => fake()->randomElement(OrderStatus::toArray()),
            'shipping_method' => fake()->randomElement(ShippingMethod::toArray()),
            'shipping_price' => fake()->numberBetween(1, 1000),
            'total_price' => fake()->numberBetween(1, 1000),
        ];
    }

    public function saveAddress(): self
    {
        return $this->state(['is_saved' => true]);
    }
}
