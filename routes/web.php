<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes — B2B Wholesale Admin
|--------------------------------------------------------------------------
*/

// Guest Routes (Only accessible when NOT logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/login/admin', [LoginController::class, 'adminLogin']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/pending', [RegisterController::class, 'pending'])->name('pending');
});

// Authenticated Routes
Route::middleware('auth:web,admin')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Root Route — redirect dynamically based on auth status
Route::get('/', function () {
    if (auth('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }
    if (auth('web')->check()) {
        if (auth('web')->user()->hasRole('supplier')) {
            return redirect()->route('supplier.dashboard');
        }
        return redirect()->route('buyer.portal');
    }
    return redirect()->route('login');
});

// Load admin routes from routes/admin.php
require __DIR__.'/admin.php';

// Load supplier routes from routes/supplier.php
require __DIR__.'/supplier.php';

// B2B Wholesale Buyer Portal Route
Route::get('/buyer', function () {
    return view('buyer.index');
})->name('buyer.portal');

