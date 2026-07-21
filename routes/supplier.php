<?php

use App\Http\Controllers\Supplier\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Supplier Routes — B2B Wholesale Portal
|--------------------------------------------------------------------------
|
| These routes are protected by auth middleware and are dedicated to
| Supplier-related functionalities (Supplier Dashboard, Product uploads,
| and Purchase Orders sent to them).
|
*/

use App\Http\Controllers\Supplier\ProductsController;

Route::prefix('supplier')->name('supplier.')->middleware(['auth:web', 'role:supplier'])->group(function () {

    // Supplier Dashboard
    Route::get('/dashboard', function () {
        return view('supplier.dashboard');
    })->name('dashboard');

    // Supplier Products (their own catalog items)
    Route::get('/products', [ProductsController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
    Route::post('/products/{product}/update-stock', [ProductsController::class, 'updateStock'])->name('products.update-stock');

    // Supplier Purchase Orders
    Route::get('/purchase-orders', function () {
        return view('supplier.placeholder', ['title' => 'Supplier Purchase Orders', 'icon' => 'bi-cart-check']);
    })->name('purchase-orders');

    // Supplier Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

});
