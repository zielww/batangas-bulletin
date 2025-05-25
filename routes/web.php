<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Blog routes
Route::get('/', BlogController::class);
Route::get('/article/{slug}', ArticleController::class);
Route::get('/category/{slug}', CategoryController::class);
Route::post('/article/{article}/comment', CommentController::class);
