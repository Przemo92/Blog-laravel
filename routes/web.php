<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/posts/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::get('/posts', [App\Http\Controllers\PostsController::class, 'index']);
Route::middleware('auth')->group(function () {
    Route::post('/posts', [App\Http\Controllers\PostsController::class, 'store']);
    Route::patch('/posts/{post}', [App\Http\Controllers\PostsController::class, 'update']);
    Route::delete('/posts/{post}', [App\Http\Controllers\PostsController::class, 'destroy']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
