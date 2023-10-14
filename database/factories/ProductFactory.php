<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'slug' => fake()->slug,
            'sku' => fake()->slug,
            'is_featured' => fake()->boolean,
            'is_active' => fake()->boolean,
            'description' => fake()->paragraph,
            'category_id' => fake()->numberBetween(1, 10),
            'orig_price' => fake()->numberBetween(1000, 10000),
            'selling_price' => fake()->numberBetween(1000, 10000),
            'discounted_price' => fake()->numberBetween(100, 9000),
            'standard_shipping_price' => fake()->numberBetween(100, 500),
            'express_shipping_price' => fake()->numberBetween(600, 1000),
            'supplier_id' => fake()->numberBetween(1, 10),
            'stocks' => fake()->numberBetween(1, 100),
        ];
    }
}
