<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->namespace('Product')
    ->prefix('product/categories')
    ->name('product.categories.')
    ->group(function() {
        Route::get('/', 'CategoryController@index')->name('index');
    });
