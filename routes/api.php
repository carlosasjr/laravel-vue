<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;

use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('categories/{id}/products', [CategoryController::class, 'products']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
});


