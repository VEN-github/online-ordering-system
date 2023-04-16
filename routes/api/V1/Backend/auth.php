<?php

Route::post('/login', 'AuthController@login')->name('login');
Route::middleware('auth:api_admins')->delete('/logout', 'AuthController@logout')
    ->name('logout');
