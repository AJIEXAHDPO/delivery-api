<?php

use App\Http\Controllers\CourierController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/couriers', [CourierController::class, 'store'])->middleware('auth:sanctum');
Route::get('/couriers/{id}', [CourierController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/couriers/{id}', [CourierController::class, 'update'])->middleware('auth:sanctum');
Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::post('/orders/assign', [OrderController::class, 'update'])->middleware('auth:sanctum');
Route::post('/orders/complete', [OrderController::class, 'delete'])->middleware('auth:sanctum');

Route::get('/couriers', [CourierController::class, 'index']);
Route::get('/orders', [OrderController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']);