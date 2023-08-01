<?php

declare(strict_types=1);

Route::prefix('faqs')
    ->namespace('Faq')
    ->name('faq.')
    ->group(function () {
        Route::get('/', 'FaqController@index')->name('index');
    });
