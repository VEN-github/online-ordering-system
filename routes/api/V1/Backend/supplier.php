<?php

Route::middleware(['auth:sanctum'])
    ->prefix('suppliers')
    ->name('supplier.')
    ->group(function() {
        Route::get('/', 'SupplierController@index')->name('index');
        Route::post('/', 'SupplierController@store')->name('store');
        Route::get('/{id}', 'SupplierController@show')->name('show');
        Route::put('/{id}', 'SupplierController@update')->name('update');
        Route::delete('/{id}', 'SupplierController@destroy')->name('destroy');
    });
