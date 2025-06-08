<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ResepApiController;

use App\Http\Controllers\Api\CartApiController;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ApiProfileController;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// route yang butuh login
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Tambahkan route API lain yang butuh token di sini
    Route::get('/profile', function (Request $request) {
        return $request->user();
    });
});


Route::get('/cek-api', function () {
    return response()->json(['message' => 'API route is working']);
});
// Produk routes
Route::middleware('auth:sanctum')->group(function () {
Route::get('/products', [ProductApiController::class, 'index']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::get('/products/{product}', [ProductApiController::class, 'show']);
Route::put('/products/{product}', [ProductApiController::class, 'update']);
Route::delete('/products/{product}', [ProductApiController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
// Resep routes
Route::get('/reseps', [ResepApiController::class, 'index']);
Route::post('/reseps', [ResepApiController::class, 'store']);
Route::get('/reseps/{resep}', [ResepApiController::class, 'show']);
Route::put('/reseps/{resep}', [ResepApiController::class, 'update']);
Route::delete('/reseps/{resep}', [ResepApiController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ApiProfileController::class, 'show']);
    Route::put('/profile', [ApiProfileController::class, 'update']);
    Route::delete('/profile', [ApiProfileController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartApiController::class, 'index']);
    Route::post('/cart', [CartApiController::class, 'store']);
    Route::put('/cart/{cart}', [CartApiController::class, 'update']);
    Route::delete('/cart/{cart}', [CartApiController::class, 'destroy']);
});
