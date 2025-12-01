<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Profile
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

    // Categories (Manager & Admin only)
    Route::middleware('permission:manage categories')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::patch('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
            ->name('categories.toggle-status');
    });

    // Suppliers (Manager & Admin only)
    Route::middleware('permission:manage suppliers')->group(function () {
        Route::resource('suppliers', SupplierController::class);
        Route::patch('suppliers/{supplier}/toggle-status', [SupplierController::class, 'toggleStatus'])
            ->name('suppliers.toggle-status');
    });

    // Products (no permissions required)
    Route::resource('products', ProductController::class);
    Route::get('products/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
        ->name('products.toggle-status');

    // Stock Transactions
    Route::middleware('permission:view stock')->group(function () {
        Route::get('stock', [StockController::class, 'index'])->name('stock.index');
        Route::get('stock/{stockTransaction}', [StockController::class, 'show'])->name('stock.show');
        Route::get('stock/history/{product}', [StockController::class, 'history'])->name('stock.history');
    });

    Route::middleware('permission:manage stock')->group(function () {
        Route::get('stock-in', [StockController::class, 'stockIn'])->name('stock.in');
        Route::post('stock-in', [StockController::class, 'processStockIn'])->name('stock.in.process');
        Route::get('stock-out', [StockController::class, 'stockOut'])->name('stock.out');
        Route::post('stock-out', [StockController::class, 'processStockOut'])->name('stock.out.process');
        Route::get('stock-adjustment', [StockController::class, 'adjustment'])->name('stock.adjustment');
        Route::post('stock-adjustment', [StockController::class, 'processAdjustment'])->name('stock.adjustment.process');
    });

    // Users (Admin only)
    Route::middleware('permission:manage users')->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');
    });

    // POS (Point of Sale)
    Route::middleware('permission:access pos')->group(function () {
        Route::get('pos', [App\Http\Controllers\POSController::class, 'index'])->name('pos.index');
        Route::post('pos/search-product', [App\Http\Controllers\POSController::class, 'searchProduct'])->name('pos.search-product');
        Route::post('pos/checkout', [App\Http\Controllers\POSController::class, 'store'])->name('pos.checkout');
        Route::get('pos/sales', [App\Http\Controllers\POSController::class, 'sales'])->name('pos.sales');
        Route::get('pos/sales/{sale}', [App\Http\Controllers\POSController::class, 'show'])->name('pos.show');
        Route::get('pos/sales/{sale}/receipt', [App\Http\Controllers\POSController::class, 'receipt'])->name('pos.receipt');
        Route::post('pos/sales/{sale}/cancel', [App\Http\Controllers\POSController::class, 'cancel'])->name('pos.cancel');
        Route::get('pos/report', [App\Http\Controllers\POSController::class, 'report'])->name('pos.report');
    });
});
