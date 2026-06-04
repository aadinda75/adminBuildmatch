<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\PaymentController;

// Redirect root to admin dashboard (which will prompt login if guest)
Route::redirect('/', '/admin/dashboard');

Route::prefix('admin')->group(function () {
    
    // Guest Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Auth Routes
    Route::middleware('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // Users Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::post('/users/{id}/verify', [UserController::class, 'toggleVerification'])->name('admin.users.verify');
        
        // Projects Management
        Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
        Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');
        
        // Payments Management
        Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
        Route::post('/payments/{id}/confirm', [PaymentController::class, 'confirmPayment'])->name('admin.payments.confirm');
        Route::post('/payments/{id}/review', [PaymentController::class, 'reviewProgress'])->name('admin.payments.review');
    });
});
