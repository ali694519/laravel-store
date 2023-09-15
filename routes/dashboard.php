<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;

Route::group([
    // 'middleware'=>['auth:admin','auth.type:admin,super-admin,user'],
    'middleware'=>['auth:admin'],
    'as'=>'dashboard.',
    'prefix'=>'admin/dashboard'

],function() {

    Route::get('profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('profile',[ProfileController::class,'update'])->name('profile.update');

    Route::get('/', [DashboardController::class,'index'])
    ->name('dashboard');

    Route::get('/categories/trash',[CategoriesController::class,'trash'])
    ->name('categories.trash');

     Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore');

     Route::delete('/categories/{category}/force-delete',[CategoriesController::class,'forceDelete'])
    ->name('categories.force-delete');

    Route::resource('/categories', CategoriesController::class);
    Route::resource('/products', ProductController::class);

});




