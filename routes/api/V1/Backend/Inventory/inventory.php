<?php

Route::middleware(['auth:api_admins'])
    ->namespace('Inventory')
    ->prefix('inventories')
    ->name('inventory.')
    ->group(function() {
        Route::get('/', 'InventoryController@index')->name('index');
        Route::post('/', 'InventoryController@store')->name('store');
    });
