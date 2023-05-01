<?php

declare(strict_types=1);

Route::namespace('Admin')
    ->middleware('auth:api_admins')
    ->prefix('avatar')
    ->name('avatar.')
    ->group(function () {
        Route::post('/{id}', 'AvatarController@store')->name('store');
        Route::delete('/{id}', 'AvatarController@destroy')->name('destroy');
    });
