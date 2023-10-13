<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orders = Order::pluck('id')->toArray();

        return [
            'order_id' => fake()->randomElement($orders),
            'product_id' => fake()->unique()->numberBetween(1, Product::count()),
            'quantity' => fake()->numberBetween(1, 10),
            'orig_price' => fake()->numberBetween(1, 1000),
            'selling_price' => fake()->numberBetween(1, 1000),
            'discounted_price' => fake()->numberBetween(1, 1000),
            'total_price' => fake()->numberBetween(1, 1000),
        ];
    }
}
