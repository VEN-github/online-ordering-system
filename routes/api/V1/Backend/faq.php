<?php

declare(strict_types=1);

Route::middleware(['auth:api_admins'])
    ->prefix('faqs')
    ->name('faq.')
    ->group(function () {
        Route::get('/', 'FaqController@index')->name('index');
        Route::post('/', 'FaqController@store')->name('store');
        Route::get('/{slug}', 'FaqController@show')->name('show');
        Route::patch('/{slug}', 'FaqController@update')->name('update');
        Route::delete('/{slug}', 'FaqController@destroy')->name('destroy');
    });
