<?php

use App\Product\Controllers\ProductController;

Route::controller(ProductController::class)->group(function () {
    Route::post('/products', 'search');
})->middleware('auth:sanctum');
