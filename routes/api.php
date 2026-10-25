<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    // Logout route (revokes token)
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/{id}', [StudentController::class, 'show']);

    Route::middleware([AdminMiddleware::class])->group(function () {
        Route::post('/students', [StudentController::class, 'store']);
        Route::put('/students/{id}', [StudentController::class, 'update']);
        Route::delete('/students/{id}', [StudentController::class, 'destroy']);
    });
});