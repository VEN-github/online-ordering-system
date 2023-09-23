<?php

declare(strict_types=1);

Route::namespace('Order')
    ->middleware('auth:api_users')
    ->prefix('orders')
    ->name('order.')
    ->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        Route::get('/{id}', 'OrderController@show')->name('show');
        Route::post('/', 'OrderController@store')->name('store');
    });
