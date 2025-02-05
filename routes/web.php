<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

//Routes frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('posts/{post}', [HomeController::class, 'show'])->name('posts.show');
Route::get('category/{category}', [HomeController::class, 'category'])->name('posts.category');
Route::get('tag/{tag}', [HomeController::class, 'tag'])->name('posts.tag');
Route::get('products', [HomeController::class, 'product_list'])->name('products.show');
Route::get('products/{id}/detail', [HomeController::class, 'product_detail'])->name('products.detail');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('test', function () {
    return Product::find(1)->image;
});