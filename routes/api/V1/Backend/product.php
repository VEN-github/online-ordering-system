<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->prefix('products')
    ->name('product.')
    ->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::post('/', 'ProductController@store')->name('store');
        Route::get('/{slug}', 'ProductController@show')->name('show');
        Route::patch('/{slug}', 'ProductController@update')->name('update');
        Route::delete('/{slug}', 'ProductController@destroy')->name('destroy');
    });
