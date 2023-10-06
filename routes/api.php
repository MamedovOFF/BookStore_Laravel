<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/sign-up', [AuthController::class, 'registration']);
Route::post('/logout', [AuthController::class, 'logout']); 



Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('/users', UserController::class);
    Route::resource('/books', BookController::class);
});
