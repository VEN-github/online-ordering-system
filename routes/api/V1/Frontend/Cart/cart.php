<?php

declare(strict_types=1);

Route::prefix('carts')
    ->middleware(['auth:api_users'])
    ->namespace('Cart')
    ->name('cart.')
    ->group(function () {
        Route::post('/', 'CartController@store')->name('store');
        Route::get('/', 'CartController@show')->name('show');
    });
