<?php

declare(strict_types=1);

Route::namespace("App\Http\Controllers\Api\\$version\\Backend")
    ->prefix('admin')
    ->name('admin.')
    ->group(function () use ($version) {

        include_files_in_directory(__DIR__ . "//$version//Backend");

    });

Route::namespace("App\Http\Controllers\Api\\$version\\Frontend")
    // ->prefix('user')
    // ->name('user.')
    ->group(function () use ($version) {

        include_files_in_directory(__DIR__ . "//$version//Frontend");

    });
