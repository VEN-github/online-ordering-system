<?php

declare(strict_types=1);

Route::namespace('Admin')
    ->middleware('auth:api_admins')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {
        Route::get('/{id}', 'ProfileController@show')->name('show');
        Route::patch('/{id}', 'ProfileController@update')->name('update');
    });
