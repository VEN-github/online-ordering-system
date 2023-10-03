<?php

declare(strict_types=1);

Route::prefix('category')
    ->namespace('Category')
    ->name('category.product')
    ->group(function () {
        Route::get('{category}/products', 'ProductController@index')->name('index');
    });
