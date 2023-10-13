<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->namespace('Order')
    ->prefix('orders')
    ->name('order.')
    ->group(function () {
        Route::get('/', 'OrderController@index')->name('index');
        // Route::post('/', 'OrderController@store')->name('store');
        // Route::get('/{slug}', 'OrderController@show')->name('show');
        Route::patch('/{refId}', 'OrderController@update')->name('update');
        // Route::delete('/{slug}', 'OrderController@destroy')->name('destroy');
    });
