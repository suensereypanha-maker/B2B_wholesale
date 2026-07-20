<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\UsersController;

/*
|--------------------------------------------------------------------------
| Admin Routes — B2B Wholesale
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth:admin', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management & Approvals
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::post('/users/{user}/toggle-status', [UsersController::class, 'toggleStatus'])->name('users.toggle-status');

    // Roles — full resource CRUD
    Route::resource('roles', RolesController::class)->names([
        'index'   => 'roles.index',
        'create'  => 'roles.create',
        'store'   => 'roles.store',
        'show'    => 'roles.show',
        'edit'    => 'roles.edit',
        'update'  => 'roles.update',
        'destroy' => 'roles.destroy',
    ]);

    // Permissions — full resource CRUD
    Route::resource('permissions', PermissionsController::class)->names([
        'index'   => 'permissions.index',
        'create'  => 'permissions.create',
        'store'   => 'permissions.store',
        'edit'    => 'permissions.edit',
        'update'  => 'permissions.update',
        'destroy' => 'permissions.destroy',
    ])->except(['show']);

    // Placeholder routes (UI only)
    Route::get('/products',        fn () => view('admin.placeholder', ['title' => 'Products',         'icon' => 'bi-box-seam']))->name('products');
    Route::get('/categories',      fn () => view('admin.placeholder', ['title' => 'Categories',       'icon' => 'bi-grid']))->name('categories');
    Route::get('/brands',          fn () => view('admin.placeholder', ['title' => 'Brands',           'icon' => 'bi-award']))->name('brands');
    Route::get('/suppliers',       fn () => view('admin.placeholder', ['title' => 'Suppliers',        'icon' => 'bi-truck']))->name('suppliers');
    Route::get('/customers',       fn () => view('admin.placeholder', ['title' => 'Customers',        'icon' => 'bi-person-lines-fill']))->name('customers');
    Route::get('/purchase-orders', fn () => view('admin.placeholder', ['title' => 'Purchase Orders',  'icon' => 'bi-cart-check']))->name('purchase-orders');
    Route::get('/sales-orders',    fn () => view('admin.placeholder', ['title' => 'Sales Orders',     'icon' => 'bi-receipt']))->name('sales-orders');
    Route::get('/warehouse',       fn () => view('admin.placeholder', ['title' => 'Warehouse',        'icon' => 'bi-building']))->name('warehouse');
    Route::get('/inventory',       fn () => view('admin.placeholder', ['title' => 'Inventory',        'icon' => 'bi-archive']))->name('inventory');
    Route::get('/reports',         fn () => view('admin.placeholder', ['title' => 'Reports',          'icon' => 'bi-bar-chart-line']))->name('reports');
    Route::get('/settings',        fn () => view('admin.placeholder', ['title' => 'Settings',         'icon' => 'bi-gear']))->name('settings');

});
