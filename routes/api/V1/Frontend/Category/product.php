<?php

declare(strict_types=1);

Route::prefix('categories')
    ->namespace('Category')
    ->name('category.')
    ->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
    });
