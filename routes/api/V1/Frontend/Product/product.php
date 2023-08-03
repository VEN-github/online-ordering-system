<?php

Route::prefix('products')
    ->namespace('Product')
    ->name('product.')
    ->group(function() {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/featured', 'ProductController@getFeatured')->name('featured');
        Route::get('/{slug}', 'ProductController@show')->name('show');
    });
