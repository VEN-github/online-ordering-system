<?php

declare(strict_types=1);

Route::prefix('category')
    ->namespace('Category')
    ->name('category.')
    ->group(function () {
        Route::get('{category}/products', 'ProductController@index')->name('index');
    });
