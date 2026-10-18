<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Endpoint publik login
Route::post('/login', [AuthController::class, 'login']);

// Endpoint privat (dilindungi Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

// Endpoint CRUD books dari acara sebelumnya
Route::apiResource('books', BookController::class);
