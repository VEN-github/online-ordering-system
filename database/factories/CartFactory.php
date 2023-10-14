<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartFactory extends Factory
{
    protected $model = Cart::class;

    /** @return array<string, mixed> */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
        ];
    }
}
