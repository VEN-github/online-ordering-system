<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $user = User::factory()
            ->state(function () {
                return [
                    'email' => 'user@user.com',
                    'first_name' => 'User',
                ];
            })
            ->create();

        $user
            ->addMediaFromUrl('https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?w=740&t=st=1680946201~exp=1680946801~hmac=a73319d74122b147c353a26455a68076e80e6ee574b1aa8d20ba8bc0a7383542')
            ->toMediaCollection('avatar');
    }
}
