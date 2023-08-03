<?php

declare(strict_types=1);

Route::namespace('User')
    ->middleware('auth:api_users')
    ->prefix('profile')
    ->name('profile.')
    ->group(function () {
        Route::get('/{id}', 'ProfileController@show')->name('show');
        Route::patch('/{id}', 'ProfileController@update')->name('update');
    });
