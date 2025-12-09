<?php

use App\Product\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('products', ProductController::class);
// });
