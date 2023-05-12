<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Seeder;

class DatabaseTestSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        Supplier::factory()->count(100)->create();
        Category::factory()->count(100)->create();
    }
}
