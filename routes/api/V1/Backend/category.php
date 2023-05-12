<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->prefix('categories')
    ->name('category.')
    ->group(function () {
        Route::get('/', 'CategoryController@index')->name('index');
        Route::post('/', 'CategoryController@store')->name('store');
        Route::get('/{slug}', 'CategoryController@show')->name('show');
        Route::patch('/{slug}', 'CategoryController@update')->name('update');
        Route::delete('/{slug}', 'CategoryController@destroy')->name('destroy');
    });
