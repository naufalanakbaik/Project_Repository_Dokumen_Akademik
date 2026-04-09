<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

// Halaman utama (Publik)
Route::get('/', function () {
    return view('auth.login');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang membutuhkan Login
Route::middleware(['auth'])->group(function () {

    // MAHASISWA ROUTES
    Route::middleware(['role:mahasiswa'])
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
            Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
            Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
        });

    // DOSEN ROUTES
    Route::middleware(['role:dosen'])
        ->prefix('dosen')
        ->name('dosen.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
            Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
            Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
            Route::get('/monitoring', [DashboardController::class, 'index'])->name('monitoring');
        });

    // KAPRODI ROUTES
    Route::middleware(['role:kaprodi'])
        ->prefix('kaprodi')
        ->name('kaprodi.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
            Route::get('/monitoring', [DashboardController::class, 'index'])->name('monitoring');
        });

    // ADMIN ROUTES
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            Route::resource('categories', CategoryController::class);
            Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
            Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
            Route::get('/monitoring', [DashboardController::class, 'index'])->name('monitoring');
            Route::patch('/documents/{id}/status', [DocumentController::class, 'updateStatus'])->name('documents.updateStatus');

            // Users Management (Assuming it exists based on previous work)
            Route::get('/users', [DashboardController::class, 'index'])->name('users.index');
            // Placeholder if UserController not found
        });
});
