<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\customer\AiController;

Route::middleware(['web', 'auth' ,'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
          Route::get('/dashboard', [AuthController::class, 'adminDashboard'])
         ->name('dashboard');

        Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('categories/data', [CategoryController::class, 'getData'])->name('categories.data');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('admin/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


        Route::get('products/data', [ProductController::class, 'getData'])->name('products.data');
        Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::resource('products', ProductController::class)->except(['show' ,'update']);
        Route::get('/generate-description/{id}', [AiController::class, 'generateDescription'])
        ->name('products.generateDescription');

        Route::get('users/data', [UserController::class, 'data'])
        ->name('users.data');

        Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');


     Route::get('orders/data', [OrderController::class, 'data'])->name('orders.data');
Route::get('orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

Route::post('orders/{order}/status', [OrderController::class, 'updateStatus']);


    });
