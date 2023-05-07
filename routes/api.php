<?php

use App\Http\Resources\Resource;
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
Route::get('/unauthorization', function () {
    return (new Resource(false, ['Lütfen giriş yapınız.']))->response();
})->name('unauthorization');

Route::post('/user/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::post('/user/register', [\App\Http\Controllers\UserController::class, 'register']);

// Private routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/user/change-password', [\App\Http\Controllers\UserController::class, 'changePassword']);

    Route::get('/service', [\App\Http\Controllers\ServiceController::class, 'index']);
    Route::get('/service/{id}', [\App\Http\Controllers\ServiceController::class, 'show']);

    Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store']);
});
