<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class CipherSweetSeeder extends Seeder
{
    /** Run the database seeds. */
    public function run(): void
    {
        if (config('ciphersweet.enabled')) {
            $command = 'ciphersweet:encrypt '
                . '\"' . get_fully_qualified_class_name(Admin::class) . '\" '
                . config('ciphersweet.providers.string.key');

            Artisan::call($command);
        }
    }
}
