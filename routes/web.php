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

Route::get('/', function (\App\Services\SawService $sawService) {
    $totalKriteria = \App\Models\Kriteria::count();
    $totalWarga = \App\Models\Warga::count();
    $kriteriaList = \App\Models\Kriteria::all();
    $sawData = $sawService->calculate();
    $topRanking = array_slice($sawData['ranking'] ?? [], 0, 3);
    $totalPeserta = count($sawData['ranking'] ?? []);
    return view('welcome', compact('totalKriteria', 'totalWarga', 'kriteriaList', 'topRanking', 'totalPeserta'));
})->name('landing');

// Public Quick Check NIK Bansos (Tanpa Login)
Route::get('/cek-nik', function (\Illuminate\Http\Request $request, \App\Services\SawService $sawService) {
    $query = trim($request->input('nik', ''));
    if (empty($query)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Silakan masukkan NIK atau Nama warga yang ingin dicek.',
        ], 422);
    }

    $cleanNik = preg_replace('/[^0-9]/', '', $query);
    $sawData = $sawService->calculate();

    $found = null;
    foreach ($sawData['ranking'] as $item) {
        $itemNik = $item['nik'] ?? '';
        $itemNama = strtolower($item['nama_warga'] ?? $item['nama'] ?? '');

        if (!empty($cleanNik) && $itemNik === $cleanNik) {
            $found = $item;
            break;
        } elseif (strlen($cleanNik) >= 6 && str_contains($itemNik, $cleanNik)) {
            $found = $item;
            break;
        } elseif (str_contains($itemNama, strtolower($query))) {
            $found = $item;
            break;
        }
    }

    if (!$found) {
        $wargaRaw = \App\Models\Warga::where('nik', $cleanNik)
            ->orWhere('nama_warga', 'like', "%{$query}%")
            ->first();

        if ($wargaRaw) {
            return response()->json([
                'status' => 'pending',
                'message' => 'Data warga terdaftar tetapi proses penilaian belum selesai.',
                'data' => [
                    'nama' => $wargaRaw->nama_warga,
                    'nik_masked' => strlen($wargaRaw->nik) >= 10 ? substr($wargaRaw->nik, 0, 6) . '******' . substr($wargaRaw->nik, -4) : $wargaRaw->nik,
                    'rt_rw' => $wargaRaw->rt_rw ?? 'RT 011/04',
                    'status_title' => 'Menunggu Penilaian',
                    'status_type' => 'pending',
                    'status_desc' => 'Data Anda sedang dalam proses verifikasi berkas oleh pengurus RT.',
                ]
            ]);
        }

        return response()->json([
            'status' => 'not_found',
            'message' => 'NIK atau Nama tidak ditemukan dalam daftar calon penerima bansos.',
        ]);
    }

    $rank = $found['rank'];
    $total = count($sawData['ranking']);
    $score = round($found['score'], 4);

    if ($rank <= 10) {
        $statusType = 'lulus';
        $statusTitle = 'LULUS / PENERIMA UTAMA';
        $statusDesc = 'Selamat! Data Anda memenuhi kriteria dan masuk dalam kuota utama penerima bansos.';
    } elseif ($rank <= 15) {
        $statusType = 'cadangan';
        $statusTitle = 'DAFTAR CADANGAN';
        $statusDesc = 'Data Anda memenuhi syarat dan terdaftar sebagai kandidat cadangan penerima bansos.';
    } else {
        $statusType = 'tidak_lulus';
        $statusTitle = 'BELUM MEMENUHI KUOTA';
        $statusDesc = 'Peringkat seleksi Anda saat ini belum masuk batas kuota penerima periode ini.';
    }

    $nikStr = $found['nik'];
    $maskedNik = strlen($nikStr) >= 10 
        ? substr($nikStr, 0, 6) . '******' . substr($nikStr, -4)
        : $nikStr;

    return response()->json([
        'status' => 'success',
        'data' => [
            'nama' => $found['nama_warga'] ?? $found['nama'],
            'nik_masked' => $maskedNik,
            'rt_rw' => $found['rt_rw'] ?? 'RT 011/04',
            'pekerjaan' => $found['pekerjaan'] ?? '-',
            'rank' => $rank,
            'total_peserta' => $total,
            'score' => number_format($score, 4),
            'status_type' => $statusType,
            'status_title' => $statusTitle,
            'status_desc' => $statusDesc,
        ]
    ]);
})->name('cek.nik');

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
