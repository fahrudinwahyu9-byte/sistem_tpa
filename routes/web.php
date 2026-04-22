<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SantriController;

Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [SantriController::class, 'index'])->name('dashboard');
    Route::get('/progress', [SantriController::class, 'progress'])->name('santri.progress');
    // Move specific routes BEFORE parameter routes to prevent collision
    Route::middleware(['admin'])->group(function () {
        Route::get('/santri/create', [SantriController::class, 'create'])->name('santri.create');
        Route::post('/santri', [SantriController::class, 'store'])->name('santri.store');
    });

    Route::get('/santri/{id}', [SantriController::class, 'show'])->name('santri.show');

    // Admin only routes
    Route::middleware(['admin'])->group(function () {
        Route::get('/santri/{id}/edit', [SantriController::class, 'edit'])->name('santri.edit');
        Route::put('/santri/{id}', [SantriController::class, 'update'])->name('santri.update');
        Route::delete('/santri/{id}', [SantriController::class, 'destroy'])->name('santri.destroy');
    });
});
