<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccessoriesController;

// Rotas para produtos
Route::get('/api/products', [ProductController::class, 'index']);
Route::get('/api/products/{product}', [ProductController::class, 'show']);
Route::post('/api/products', [ProductController::class, 'store']);
Route::put('/api/products/{product}', [ProductController::class, 'update']);
Route::delete('/api/products/{product}', [ProductController::class, 'destroy']);

// Rotas para acessórios
Route::get('/api/accessories', [AccessoriesController::class, 'index']);
Route::get('/api/accessories/{accessory}', [AccessoriesController::class, 'show']);
Route::post('/api/accessories', [AccessoriesController::class, 'store']);
Route::put('/api/accessories/{accessory}', [AccessoriesController::class, 'update']);
Route::delete('/api/accessories/{accessory}', [AccessoriesController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
