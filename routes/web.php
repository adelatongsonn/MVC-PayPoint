<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::post('/logout', [AuthController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('staff', StaffController::class);

    Route::get('/sales', [SaleController::class, 'index'])
        ->name('sales.index');

    Route::get('/sales/create', [SaleController::class, 'create'])
        ->name('sales.create');

    Route::post('/sales', [SaleController::class, 'store'])
        ->name('sales.store');
});