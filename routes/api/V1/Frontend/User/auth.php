<?php

declare(strict_types=1);

Route::namespace('User')
    ->group(function () {
        Route::post('/login', 'AuthController@login')
            ->name('login');

        Route::middleware('auth:api_users')
            ->delete('/logout', 'AuthController@logout')
            ->name('logout');
    });