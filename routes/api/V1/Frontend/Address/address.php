<?php

declare(strict_types=1);

Route::namespace('Address')
    ->middleware(['auth:api_users'])
    ->prefix('addresses')
    ->name('address.')
    ->group(function () {
        Route::get('/', 'AddressController@index')->name('index');
        Route::post('/', 'AddressController@store')->name('store');
        Route::get('/{id}', 'AddressController@show')->name('show');
        Route::patch('/{id}', 'AddressController@update')->name('update');
        Route::delete('/{id}', 'AddressController@destroy')->name('destroy');
    });
