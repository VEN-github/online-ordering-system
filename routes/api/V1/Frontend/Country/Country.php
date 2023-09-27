<?php

declare(strict_types=1);

Route::prefix('countries')
    ->namespace('Country')
    ->name('country.')
    ->group(function () {
        Route::get('/', 'CountryController@index')->name('index');
    });
