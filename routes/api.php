<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes
Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/user/register', [\App\Http\Controllers\UserController::class, 'register']);

// Private routes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::post('/user/change-password', [\App\Http\Controllers\UserController::class, 'changePassword']);
});
