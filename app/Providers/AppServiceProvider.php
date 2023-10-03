<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /** Register any application services. */
    public function register(): void
    {

    }

    /** Bootstrap any application services. */
    public function boot(): void
    {
        Model::shouldBeStrict();

        if (!$this->app->environment('local')) {
            URL::forceScheme('https');
        }

        if($this->app->environment('production')) {
            Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
                $class = get_class($model);

                info("Attempted to lazy load [{$relation}] on model [{$class}]");
            });
        }
    }
}
