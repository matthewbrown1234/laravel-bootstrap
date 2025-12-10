<?php

use App\Domains\Order\Http\Controllers\OrderController;
use App\Domains\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);
// });
