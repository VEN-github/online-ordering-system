<?php

Route::post('/login', 'AuthController@login')->name('login');

Route::get('/test', function () {
    return response()->json([
        'status' => true,
        'message' => 'hey'
    ]);
})->middleware('auth:web_admins')->name('name');
