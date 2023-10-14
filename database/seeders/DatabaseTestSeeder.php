<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Supplier\Supplier;
use App\Models\User\User;
use Illuminate\Database\Seeder;

class DatabaseTestSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $this->command->info('Running Supplier Seeder...');
        Supplier::factory()->count(10)->create();
        $this->command->info('Supplier Seeded Successfully.' . "\n");

        $this->command->info('Running Category Seeder...');
        Category::factory()->count(10)->create();
        $this->command->info('Category Seeded Successfully.' . "\n");

        $this->command->info('Running Faq Seeder...');
        Faq::factory()->count(10)->create();
        $this->command->info('Faq Seeded Successfully.');

        $this->command->info('Running Product Seeder...');
        Product::factory()->count(10)->create();
        $this->command->info('Faq Seeded Successfully.');

        $this->command->info('Running User Seeder...');

        User::factory()->count(10)->create();

        $users = User::with('cart')->get();

        foreach ($users as $user) {
            $user->cart
                ->items()
                ->create(
                    [
                        'item_id' => Product::get()->first()->id,
                        'variation_id' => null,
                        'quantity' => fake()->numberBetween(1, 10),
                        'total' => fake()->numberBetween(600, 1000),
                    ]
                );
        }

        $this->command->info('User Seeded Successfully.');

        $this->command->info('Running Order Seeder...');
        Order::factory()->count(10)->create();
        $this->command->info('Order Seeded Successfully.');

        $this->command->info('Running Item Seeder...');
        Item::factory()->count(5)->create();
        $this->command->info('Item Seeded Successfully.');
    }
}
