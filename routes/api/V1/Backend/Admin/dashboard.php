<?php

declare(strict_types=1);

Route::namespace('Admin')
    ->middleware('auth:api_admins')
    ->prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('index');
    });
