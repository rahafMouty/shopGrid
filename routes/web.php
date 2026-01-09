<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Middleware\CheckRole;
Route::redirect('/', '/index');
Route::get('/index', function () {
    return view('core.home');
})->name('index');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





