<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SuppliersController;
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

    // Products — full resource CRUD
    Route::get('/products-main', [ProductsController::class, 'index'])->name('products');
    Route::resource('products', ProductsController::class)->names([
        'index'   => 'products.index',
        'create'  => 'products.create',
        'store'   => 'products.store',
        'edit'    => 'products.edit',
        'update'  => 'products.update',
        'destroy' => 'products.destroy',
    ])->except(['show']);
    Route::post('/products/{product}/toggle-status', [ProductsController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('/products/{product}/toggle-featured', [ProductsController::class, 'toggleFeatured'])->name('products.toggle-featured');
    // Categories & Subcategories — full resource CRUD
    Route::get('/categories-main', [CategoriesController::class, 'index'])->name('categories');
    Route::resource('categories', CategoriesController::class)->names([
        'index'   => 'categories.index',
        'create'  => 'categories.create',
        'store'   => 'categories.store',
        'edit'    => 'categories.edit',
        'update'  => 'categories.update',
        'destroy' => 'categories.destroy',
    ])->except(['show']);
    Route::post('/categories/{category}/toggle-status', [CategoriesController::class, 'toggleStatus'])->name('categories.toggle-status');
    // Brands — full resource CRUD
    Route::get('/brands-main', [BrandsController::class, 'index'])->name('brands');
    Route::resource('brands', BrandsController::class)->names([
        'index'   => 'brands.index',
        'create'  => 'brands.create',
        'store'   => 'brands.store',
        'edit'    => 'brands.edit',
        'update'  => 'brands.update',
        'destroy' => 'brands.destroy',
    ])->except(['show']);
    Route::post('/brands/{brand}/toggle-status', [BrandsController::class, 'toggleStatus'])->name('brands.toggle-status');
    Route::post('/brands/{brand}/toggle-featured', [BrandsController::class, 'toggleFeatured'])->name('brands.toggle-featured');
    // Suppliers — full resource CRUD & approval
    Route::get('/suppliers-main', [SuppliersController::class, 'index'])->name('suppliers');
    Route::resource('suppliers', SuppliersController::class)->names([
        'index'   => 'suppliers.index',
        'create'  => 'suppliers.create',
        'store'   => 'suppliers.store',
        'edit'    => 'suppliers.edit',
        'update'  => 'suppliers.update',
        'destroy' => 'suppliers.destroy',
    ])->except(['show']);
    Route::post('/suppliers/{supplier}/toggle-status', [SuppliersController::class, 'toggleStatus'])->name('suppliers.toggle-status');
    Route::get('/customers',       fn () => view('admin.placeholder', ['title' => 'Customers',        'icon' => 'bi-person-lines-fill']))->name('customers');
    Route::get('/purchase-orders', fn () => view('admin.placeholder', ['title' => 'Purchase Orders',  'icon' => 'bi-cart-check']))->name('purchase-orders');
    Route::get('/sales-orders',    fn () => view('admin.placeholder', ['title' => 'Sales Orders',     'icon' => 'bi-receipt']))->name('sales-orders');
    Route::get('/warehouse',       fn () => view('admin.placeholder', ['title' => 'Warehouse',        'icon' => 'bi-building']))->name('warehouse');
    Route::get('/inventory',       fn () => view('admin.placeholder', ['title' => 'Inventory',        'icon' => 'bi-archive']))->name('inventory');
    Route::get('/reports',         fn () => view('admin.placeholder', ['title' => 'Reports',          'icon' => 'bi-bar-chart-line']))->name('reports');
    Route::get('/settings',        fn () => view('admin.placeholder', ['title' => 'Settings',         'icon' => 'bi-gear']))->name('settings');

});
