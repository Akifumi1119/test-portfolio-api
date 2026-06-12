<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\PetRecordController;

// 認証不要
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 認証必須
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    Route::get('/pets', [PetController::class, 'index']);
    Route::post('/pets', [PetController::class, 'store']);
    Route::get('/pets/{pet}', [PetController::class, 'show']);
    Route::put('/pets/{pet}', [PetController::class, 'update']);
    Route::delete('/pets/{pet}', [PetController::class, 'destroy']);

    Route::post('/pets/{pet}/records', [PetRecordController::class, 'store']);
    Route::get('/pets/{pet}/records', [PetRecordController::class, 'index']);
    Route::delete('/records/{record}', [PetRecordController::class, 'destroy']);
});
