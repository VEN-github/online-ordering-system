<?php

declare(strict_types=1);

Route::namespace('User')
    ->middleware('auth:api_users')
    ->prefix('password')
    ->name('password.')
    ->group(function () {
        Route::patch('/{id}', 'PasswordController@update')->name('update');
    });
