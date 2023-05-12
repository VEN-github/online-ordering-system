<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Faq\Faq;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FaqFactory extends Factory
{
    protected $model = Faq::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'answer' => $this->faker->paragraph,
            'active' => $this->faker->boolean,
        ];
    }
}
