<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Blog routes
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/article/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/category/{slug}', [BlogController::class, 'category'])->name('blog.category');
Route::post('/article/{article}/comment', [BlogController::class, 'storeComment'])->name('blog.comment.store');
