<?php

use App\Product\Controllers\ProductController;

// Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('products', ProductController::class);
// });
