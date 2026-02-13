<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\DashboardController;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protected routes - All authenticated users
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customer routes
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/task/create/{projectId}', [TaskController::class, 'create'])->name('task.create');
        Route::post('/task', [TaskController::class, 'store'])->name('task.store');
        Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');
        Route::delete('/task/{id}', [TaskController::class, 'delete'])->name('task.delete');
    });

    // Developer routes
    Route::middleware(['role:frontend_developer,backend_developer,server_admin'])->group(function () {
        Route::get('/task/{id}', [TaskController::class, 'show'])->name('task.show');
        Route::put('/task/{id}/status', [TaskController::class, 'updateStatus'])->name('task.update-status');
    });
});