<?php

use App\Domains\Order\Http\Controllers\OrderController;
use App\Domains\Product\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->group(function () {
Route::post('products:search', [ProductController::class, 'search']);
Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);
Route::post('orders:create', [OrderController::class, 'create']);
Route::post('orders:cancel', [OrderController::class, 'cancel']);
// });

//Route::get('/debug-info', function () {
//    phpinfo();
//});
