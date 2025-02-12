<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('admin.home');

Route::resource(
    'categories',
    CategoryController::class
)->names('admin.categories');

Route::resource('posts',PostController::class)->names('admin.posts');

Route::resource('products', ProductController::class)->names('admin.products');

