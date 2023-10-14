<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Variation\Variation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VariationFactory extends Factory
{
    protected $model = Variation::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'stock' => $this->faker->numberBetween(1, 100),
            'sku' => $this->faker->slug,
            'order' => $this->faker->numberBetween(1, 100),
            'product_id' => 1,
        ];
    }
}
