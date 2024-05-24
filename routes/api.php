<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::get('/users', [UserController::class, 'users']);
Route::post('/store', [UserController::class, 'store']);            
Route::post('/verify', [UserController::class, 'verifyOtp']);
Route::post('users/update/{id}', [UserController::class, 'editUser']);
Route::delete('users/delete/{id}', [UserController::class, 'destroy']);
Route::get('users/{id}', [UserController::class, 'getUser']);
Route::get('/users/count', [UserController::class, 'countUsers']);
Route::get('/getUser', [UserController::class, 'profile'])->middleware('auth:sanctum');





