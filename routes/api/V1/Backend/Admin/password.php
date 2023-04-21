<?php

declare(strict_types=1);

Route::namespace('Admin')
    ->middleware('auth:api_admins')
    ->prefix('password')
    ->name('password.')
    ->group(function () {
        Route::patch('/{id}', 'PasswordController@patch')->name('patch');
    });
