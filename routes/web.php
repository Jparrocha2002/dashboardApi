<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user', [HomeController::class, 'userIndex'])->name('user');
Route::get('/user/create', [HomeController::class, 'create']);
Route::get('/user/update/{id}',[HomeController::class,'edit']);

Route::get('/posting', [HomeController::class, 'post']);
Route::get('/profile/show', [HomeController::class, 'profile'])->name('profile');

Route::middleware('auth:api')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
});

Route::get('/posting',[HomeController::class,'post']);
Route::get('/comments/{id}',[PostCommentController::class,'comments']);
Route::post('/broadcast', [PostCommentController::class,'broadcast']);
Route::post('/receive',[PostCommentController::class,'receive']);