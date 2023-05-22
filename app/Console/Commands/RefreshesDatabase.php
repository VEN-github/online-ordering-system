<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RefreshesDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refreshes-database {--test}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset and re-run all migrations and seeders.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Refreshing database...');

        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        if ($this->option('test')) {
            Artisan::call('db:seed --class=DatabaseTestSeeder');
        }

        $this->info('Done! [OK]');
    }
}
