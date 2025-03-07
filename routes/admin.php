<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SettingsController;






// Aplicar middleware a una ruta específica
Route::get('/', [HomeController::class, 'index'])
    ->name('admin.home')
    ->middleware('preventBackHistory');



// Aplicar middleware a un grupo de rutas
Route::middleware('preventBackHistory')->group(function () {
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::resource('posts', PostController::class)->names('admin.posts');
    Route::view('products', 'admin.products.index')->name('admin.products.index');
    Route::view('tags', 'admin.tags.index')->name('admin.tags.index');
    Route::resource('settings', SettingsController::class)->names('admin.settings');
    
});

