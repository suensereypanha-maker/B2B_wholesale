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

Route::prefix('supplier')->name('supplier.')->middleware(['auth:web', 'role:supplier'])->group(function () {

    // Supplier Dashboard
    Route::get('/dashboard', function () {
        return view('supplier.dashboard');
    })->name('dashboard');

    // Supplier Products (their own catalog items)
    Route::get('/products', function () {
        return view('supplier.placeholder', ['title' => 'Supplier Products', 'icon' => 'bi-box-seam']);
    })->name('products');

    // Supplier Purchase Orders
    Route::get('/purchase-orders', function () {
        return view('supplier.placeholder', ['title' => 'Supplier Purchase Orders', 'icon' => 'bi-cart-check']);
    })->name('purchase-orders');

    // Supplier Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

});
