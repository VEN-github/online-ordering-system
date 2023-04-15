<?php

Route::post('/login', 'AuthController@login')->name('login');
Route::middleware('auth:sanctum')->delete('/logout', 'AuthController@logout')
    ->name('logout');
