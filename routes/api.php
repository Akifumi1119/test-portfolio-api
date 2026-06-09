<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PetController;

Route::get('/pets', [PetController::class, 'index']);
Route::post('/pets', [PetController::class, 'store']);
Route::put('/pets/{pet}', [PetController::class, 'update']);
Route::get('/pets/{pet}', [PetController::class, 'show']);
Route::delete('/pets/{pet}', [PetController::class, 'destroy']);