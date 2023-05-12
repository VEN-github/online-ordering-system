<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Faq\Faq;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Seeder;

class DatabaseTestSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        $this->command->info('Running Supplier Seeder...');
        Supplier::factory()->count(100)->create();
        $this->command->info('Supplier Seeded Successfully.' . "\n");

        $this->command->info('Running Category Seeder...');
        Category::factory()->count(100)->create();
        $this->command->info('Category Seeded Successfully.' . "\n");

        $this->command->info('Running Faq Seeder...');
        Faq::factory()->count(100)->create();
        $this->command->info('Faq Seeded Successfully.');
    }
}
