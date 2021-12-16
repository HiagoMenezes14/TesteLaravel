<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->group( function() {
    Route::get('/test',GetController::class.'@itWorks');
    Route::get('/not-work', GetController::class. '@doesntWorks');
    Route::post('/enviar',GetController::class.'@testBody');
    Route::post('/create-user',UserController::class.'@createUser');
});