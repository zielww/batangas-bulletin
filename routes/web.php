<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Blog routes
Route::get('/', BlogController::class);
Route::get('/article/{slug}', ArticleController::class);
Route::get('/category/{slug}', CategoryController::class);
Route::post('/article/{article}/comment', CommentController::class);
Route::get('/author/{id}', [UserController::class, 'authors']);
Route::post('/search', SearchController::class);

Route::middleware('auth')->group(function () {
    Route::delete('/logout', [SessionController::class, 'destroy']);
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'index'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
