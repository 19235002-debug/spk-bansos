<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DokumentasiController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $totalKriteria = \App\Models\Kriteria::count();
    $totalWarga = \App\Models\Warga::count();
    $kriteriaList = \App\Models\Kriteria::all();
    return view('welcome', compact('totalKriteria', 'totalWarga', 'kriteriaList'));
})->name('landing');

Route::middleware(['auth'])->group(function () {
    // Dashboard accessible by both Admin & Warga
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Supporting Information System Features (Accessible by both Admin & Warga)
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');
    Route::get('/dokumentasi', [DokumentasiController::class, 'index'])->name('dokumentasi.index');

    // Warga Flow Enhancements
    Route::post('/warga/claim-nik', [DashboardController::class, 'claimNim'])->name('warga.claimNik');
    Route::post('/warga/pengajuan', [DashboardController::class, 'updatePengajuan'])->name('warga.updatePengajuan');
    Route::get('/warga/cetak-bukti', [PerhitunganController::class, 'cetakWarga'])->name('warga.cetakWarga');
    Route::get('/warga/cetak-transkrip', [PerhitunganController::class, 'cetakWarga'])->name('warga.cetakTranskrip');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        // CRUD Kriteria
        Route::resource('kriteria', KriteriaController::class)->parameters(['kriteria' => 'kriteria']);

        // CRUD Data Warga (Calon Penerima Bansos)
        Route::resource('data-warga', WargaController::class)->names('warga')->parameters(['data-warga' => 'warga']);

        // CRUD Penilaian / Matriks Nilai
        Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::post('penilaian/batch', [PenilaianController::class, 'updateBatch'])->name('penilaian.updateBatch');

        // Perhitungan SAW Engine
        Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
        Route::get('perhitungan/cetak', [PerhitunganController::class, 'cetak'])->name('perhitungan.cetak');

        // Admin Reset & Seed Sample Data
        Route::post('reset-sample-data', [DashboardController::class, 'resetSampleData'])->name('admin.resetSampleData');

        // Admin CRUD Team Members
        Route::post('team', [TeamController::class, 'store'])->name('team.store');
        Route::put('team/{team}', [TeamController::class, 'update'])->name('team.update');
        Route::delete('team/{team}', [TeamController::class, 'destroy'])->name('team.destroy');

        // General System Settings (Favicon, Logo, Footer, App Info)
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::post('settings/reset', [SettingController::class, 'reset'])->name('settings.reset');
    });

    // Public / Warga Result Route
    Route::get('/hasil-bansos', [PerhitunganController::class, 'index'])->name('hasil.index');
});

require __DIR__.'/auth.php';
