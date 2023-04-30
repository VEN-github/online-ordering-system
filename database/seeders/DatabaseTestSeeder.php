<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Supplier\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('migrate:fresh', ['--force' => true]);

        $this->call([
            AdminSeeder::class,
            CipherSweetSeeder::class
        ]);

        Supplier::factory()->count(100)->create();

        Category::factory()->count(1)->create();
    }
}
