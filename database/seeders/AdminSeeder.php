<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use App\Models\Image\Image;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        Image::truncate();

        Admin::factory()
            ->state(function () {
                return [
                    'email' => 'admin@admin.com',
                    'first_name' => 'Admin'
                ];
            })
            ->has(
                Image::factory()
                    ->count(1)
                    ->state(function () {
                        return ['url' => 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1680946201~exp=1680946801~hmac=a73319d74122b147c353a26455a68076e80e6ee574b1aa8d20ba8bc0a7383542'];
                    })
            )
            ->create();
    }
}
