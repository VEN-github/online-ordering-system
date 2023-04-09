<?php

namespace Database\Factories;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Admin>
 */
class AdminFactory extends Factory
{
    protected $model = Admin::class;
    public const PASSWORD = 'admin';

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'password' => Hash::make(self::PASSWORD)
        ];
    }
}
