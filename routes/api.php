<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('products', ProductController::class);
Route::get('/test', function () {
    return response()->json([
        'message' => 'API working fine By Khem Sopheanan'
    ]);
});

Route::get('/products', [ProductController::class, 'index']);
