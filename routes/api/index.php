<?php

$version = get_latest_api_version_with_prefix();

Route::namespace("App\Http\Controllers\Api\\$version\\Backend")
    ->prefix('admin')
    ->name('admin.')
    ->group(function () use ($version) {

    include_files_in_directory(__DIR__ . "//$version//Backend");

});
