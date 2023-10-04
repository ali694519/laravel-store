<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ImportProductsController;

Route::group([
    // 'middleware'=>['auth:admin','auth.type:admin,super-admin,user'],
    'middleware'=>['auth:admin,web'],
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


    Route::get('products/import', [ImportProductsController::class, 'create'])
        ->name('products.import');
    Route::post('products/import', [ImportProductsController::class, 'store']);


       Route::resources([
        'products' => ProductController::class,
        'categories' => CategoriesController::class,
        'roles' => RolesController::class,
        'users' => UsersController::class,
        'admins' => AdminsController::class,
    ]);

});




