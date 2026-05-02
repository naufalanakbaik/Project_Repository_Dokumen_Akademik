<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Mahasiswa\DocumentController as MahasiswaDocumentController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use App\Http\Controllers\Dosen\DocumentController as DosenDocumentController;
use App\Http\Controllers\Kaprodi\DocumentController as KaprodiDocumentController;


// -- Routing halaman pertama (Publik)
Route::get('/', function () {
    return view('auth.login');
});

// -- Autentikasi User
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -- Route middleware autentikasi -> Default login akses
Route::middleware(['auth'])->group(function () {
    /*|------------------------------------------------------------------------|
    |                                 MAHASISWA                                |
    |--------------------------------------------------------------------------*/
    Route::middleware(['role:mahasiswa'])
        ->prefix('mahasiswa')
        ->name('mahasiswa.')
        ->group(function () {
            // -- Dashboard statistik -> mahasiswa 
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // -- Akses global dokumen (seluruh dokumen yang diunggah setiap role) -> mahasiswa
            Route::get('/documents/global', [MahasiswaDocumentController::class, 'global'])
                ->name('katalog.global');

            // -- Akses detail global dokumen (detail dokumen yang diunggah setiap role) -> mahasiswa
            Route::get('/documents/global/{id}', [MahasiswaDocumentController::class, 'showGlobal'])
                ->name('katalog.showGlobal');

            // -- Dokumen akses saya (dokumen pribadi) -> mahasiswa
            Route::get('/documents', [MahasiswaDocumentController::class, 'index'])
                ->name('documents.index');

            // -- Menampilkan form tambah dokumen -> mahasiswa
            Route::get('/documents/create', [MahasiswaDocumentController::class, 'create'])
                ->name('documents.create');

            // -- Proses tambah dokumen ke table documents -> mahasiswa
            Route::post('/documents', [MahasiswaDocumentController::class, 'store'])
                ->name('documents.store');

            // -- Route untuk edit dan update data dokumen -> mahasiswa
            Route::get('/documents/{id}/edit', [MahasiswaDocumentController::class, 'edit'])->name('documents.edit');
            Route::put('/documents/{id}', [MahasiswaDocumentController::class, 'update'])->name('documents.update');

            // -- Menampilkan detail dokumen -> mahasiswa
            Route::get('/documents/{id}', [MahasiswaDocumentController::class, 'show'])
                ->name('documents.show');

            // -- Menampilkan detail data mahasiswa
            Route::get('/profile', [MahasiswaProfileController::class, 'show'])
                ->name('profile.show');

            // -- Menampilkan form edit dan proses update data
            Route::get('/profile/edit', [MahasiswaProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/profile', [MahasiswaProfileController::class, 'update'])->name('profile.update');


            // -- Preview (lihat) pdf dokumen -> mahasiswa
            Route::get('/documents/{id}/preview', [MahasiswaDocumentController::class, 'preview'])
                ->name('documents.preview');

            // -- Download dokumen -> mahasiswa
            Route::get('/documents/{id}/download', [MahasiswaDocumentController::class, 'download'])
                ->name('documents.download');
        });


    /*|------------------------------------------------------------------------|
    |                                 DOSEN                                    |
    |--------------------------------------------------------------------------*/
    Route::middleware(['role:dosen'])
        ->prefix('dosen')
        ->name('dosen.')
        ->group(function () {
            // -- Dashboard statistik -> dosen
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('dashboard');

            // -- Dashboard monitoring mahasiswa -> dosen
            Route::get('/monitoring', [DashboardController::class, 'index'])
                ->name('monitoring');

            // -- Global dokumen akses (seluruh dokumen -> user)
            Route::get('/documents/global', [DosenDocumentController::class, 'global'])
                ->name('katalog.global');

            Route::get('/documents/global/{id}', [DosenDocumentController::class, 'showGlobal'])
                ->name('katalog.showGlobal');

            // -- Dokumen akses saya (dokumen pribadi) -> dosen
            Route::get('/documents', [DosenDocumentController::class, 'index'])
                ->name('documents.index');

            Route::get('/documents/create', [DosenDocumentController::class, 'create'])
                ->name('documents.create');

            Route::post('/documents', [DosenDocumentController::class, 'store'])
                ->name('documents.store');

            Route::get('/documents/{id}', [DosenDocumentController::class, 'show'])
                ->name('documents.show');

            Route::get('/documents/{id}/preview', [DosenDocumentController::class, 'preview'])
                ->name('documents.preview');

            Route::get('/documents/{id}/download', [DosenDocumentController::class, 'download'])
                ->name('documents.download');
        });


    /*|------------------------------------------------------------------------|
    |                                 KAPRODI                                  |
    |--------------------------------------------------------------------------*/
    Route::middleware(['role:kaprodi'])
        ->prefix('kaprodi')
        ->name('kaprodi.')
        ->group(function () {
            // -- Dashboard statistik -> kaprodi
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // -- Dashboard monitoring mahasiswa -> kaprodi
            Route::get('/monitoring', [DashboardController::class, 'index'])->name('monitoring');

            // -- Documents akses -> kaprodi
            Route::get('/documents', [KaprodiDocumentController::class, 'index'])->name('documents.index');

            Route::get('/documents/{id}/preview', [KaprodiDocumentController::class, 'preview'])->name('documents.preview');
            Route::get('/documents/{id}/download', [KaprodiDocumentController::class, 'download'])->name('documents.download');
        });


    /*|------------------------------------------------------------------------|
    |                                 ADMIN                                    |
    |--------------------------------------------------------------------------*/
    Route::middleware(['role:admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // -- Dashboard statistik utama -> admin
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

            // -- Dashboard monitoting data pengguna -> admin
            Route::get('/monitoring-pengguna', [DashboardController::class, 'monitoringPengguna'])->name('dashboard.monitoring-pengguna');

            // -- Dokumen akses -> admin
            Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');

            // -- Form tambah dan proses tambah dokumen -> admin
            Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
            Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');

            // -- Validation dan update status (Approved/Rejected) -> admin
            Route::get('/documents/validation', [DocumentController::class, 'validation'])->name('validation-documents.validation');
            Route::get('/validation/{id}', [DocumentController::class, 'showValidation'])->name('validation-documents.show');
            Route::patch('/documents/{id}/status', [DocumentController::class, 'updateStatus'])->name('documents.updateStatus');

            // -- Form edit dan proses update data dokumen -> admin
            Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('documents.edit');
            Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('documents.update');

            // -- Menampilkan detail dokumen (halaman detail dokumen) -> admin
            Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');

            // -- Proses hapus dokumen -> admin
            Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('documents.destroy');

            // -- Proses downlaod dokumen dan preview (lihat) pdf dokumen -> admin
            Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
            Route::get('/documents/{id}/preview', [DocumentController::class, 'preview'])->name('documents.preview');

            // -- Kategori akses -> admin (crud)
            Route::resource('categories', CategoryController::class);

            // -- Pengguna akses -> admin (crud)
            Route::resource('users', UserController::class);
        });
});
