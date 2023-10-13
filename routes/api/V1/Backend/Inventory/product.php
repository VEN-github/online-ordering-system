<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->namespace('Inventory')
    ->prefix('inventory/products')
    ->name('inventory.products.')
    ->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
    });
