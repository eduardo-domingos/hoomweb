<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::post('/me', [App\Http\Controllers\AuthController::class, 'me']);

    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show']);
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store']);
    Route::put('/user/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::patch('/user/{id}', [App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    Route::post('/newsletter', [App\Http\Controllers\NewsletterController::class, 'store']);
    Route::put('/newsletter/{id}', [App\Http\Controllers\NewsletterController::class, 'update']);
    Route::delete('/newsletter/{id}', [App\Http\Controllers\NewsletterController::class, 'destroy']);
});

Route::prefix('v1')->group(function(){
    Route::get('/newsletter', [App\Http\Controllers\NewsletterController::class, 'index']);
    Route::get('/newsletter/{id}', [App\Http\Controllers\NewsletterController::class, 'show']);
});

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/