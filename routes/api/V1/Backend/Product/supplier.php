<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->namespace('Product')
    ->prefix('product/suppliers')
    ->name('product.suppliers.')
    ->group(function() {
        Route::get('/', 'SupplierController@index')->name('index');
    });
