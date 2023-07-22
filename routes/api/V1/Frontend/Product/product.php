<?php

Route::prefix('products')
    ->namespace('Product')
    ->name('product.')
    ->group(function() {
        Route::get('/featured', 'ProductController@getFeatured')->name('featured');
    });
