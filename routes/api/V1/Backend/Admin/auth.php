<?php

declare(strict_types=1);

Route::namespace('Admin')
    ->group(function () {
        Route::post('/login', 'AuthController@login')
            ->name('login');

        Route::middleware('auth:api_admins')
            ->delete('/logout', 'AuthController@logout')
            ->name('logout');
    });
