<?php

declare(strict_types=1);

Route::prefix('category/products')
    ->namespace('Category')
    ->name('category.')
    ->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
    });
