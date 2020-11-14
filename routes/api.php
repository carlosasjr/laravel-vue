<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\ProductController;

use App\Http\Controllers\Api\v1\ReportController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::get('me', [AuthController::class, 'me']);


Route::put('update-profile', [ProfileController::class, 'update']);
Route::post('register', [ProfileController::class, 'register']);

Route::group([
    'prefix' => 'v1',
   // 'middleware' => 'jwt.auth'
], function () {
    Route::get('categories/{id}/products', [CategoryController::class, 'products']);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('products', ProductController::class);
    Route::get('reports-products/{year}', [ReportController::class, 'products']);
});


