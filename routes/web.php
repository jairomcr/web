<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

//Routes frontend
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [HomeController::class, 'show'])->name('posts.show');
Route::get('category/{category:slug}', [HomeController::class, 'category'])->name('posts.category');
Route::get('tag/{tag}', [HomeController::class, 'tag'])->name('posts.tag');
Route::get('products', [HomeController::class, 'product_list'])->name('products.show');
Route::get('products/{product:slug}/detail', [HomeController::class, 'product_detail'])->name('products.detail');

// Rutas de autenticación de AdminLTE
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password-request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password-email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password-reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password-update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('test', function () {
    return Product::find(1)->image;
});