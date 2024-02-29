<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\BlogController::class, 'home']);

Route::get('/post/{slug}', [App\Http\Controllers\BlogController::class, 'showPost'])->name('post');  

Route::post('/new-post', [App\Http\Controllers\BlogController::class, 'sendNotification']);