<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\Products\ProductController;
use App\Http\Controllers\customer\StripePaymentController;
use App\Http\Controllers\customer\TapPaymentController;

Route::middleware(['web', 'auth', 'customerRole'])
    ->prefix('customer')
    ->as('customer.')
    ->group(function () {

        Route::get('/dashboard', [AuthController::class, 'customerDashboard'])
            ->name('dashboard');

        Route::get('/shop', [ProductController::class, 'shop'])
            ->name('shop');

        Route::get('/product/{id}', [ProductController::class, 'show'])
            ->name('product.show');

        /*
        |--------------------------------------------------------------------------
        | Cart Routes
        |--------------------------------------------------------------------------
        */

        Route::prefix('cart')->as('cart.')->group(function () {

            // عرض السلة
            Route::get('/', [CartController::class, 'index'])
                ->name('index');

            // إضافة منتج للسلة
            Route::post('/add/{product}', [CartController::class, 'add'])
                ->name('add');

            // تحديث الكمية
            Route::post('/update/{item}', [CartController::class, 'update'])
                ->name('update');

            // حذف عنصر من السلة
            Route::delete('/remove/{item}', [CartController::class, 'remove'])
                ->name('remove');
        });

        
        Route::prefix('orders')->as('orders.')->group(function () {

            Route::get('/data', [OrderController::class, 'getOrdersData'])->name('data');

            // Actions
            Route::get('/{order}', [OrderController::class, 'view'])->name('view');
            Route::post('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        });

        Route::post('/payments/stripe/checkout', [StripePaymentController::class, 'checkout'])->name('checkout')
        ;
           

        Route::get('/payments/stripe/success', [StripePaymentController::class, 'success'])
            ->name('stripe.success');

        Route::get('/payments/stripe/cancel', [StripePaymentController::class, 'cancel'])
            ->name('stripe.cancel');

  


});

