<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\Warga;
use App\Models\Penilaian;
use App\Models\User;
use App\Services\SawService;

class DashboardController extends Controller
{
    public function index(Request $request, SawService $sawService)
    {
        $user = $request->user();
        $sawData = $sawService->calculate();

        if ($user->isAdmin()) {
            $totalAlternatif = Warga::count();
            $totalKriteria = Kriteria::count();
            $totalUser = User::count();
            $totalPenilaian = Penilaian::count();
            $topRanking = array_slice($sawData['ranking'], 0, 5);

            // Calculate Stepper Workflow Status for Admin
            $kriteriaStatus = [
                'count' => $totalKriteria,
                'totalBobot' => $sawData['totalBobot'],
                'isComplete' => $totalKriteria > 0 && abs($sawData['totalBobot'] - 1.0) < 0.001,
            ];

            $alternatifStatus = [
                'count' => $totalAlternatif,
                'isComplete' => $totalAlternatif > 0,
            ];

            $expectedPenilaian = $totalKriteria * $totalAlternatif;
            $penilaianStatus = [
                'count' => $totalPenilaian,
                'expected' => $expectedPenilaian,
                'isComplete' => $expectedPenilaian > 0 && $totalPenilaian >= $expectedPenilaian,
            ];

            $sawStatus = [
                'isComplete' => $kriteriaStatus['isComplete'] && $alternatifStatus['isComplete'] && $penilaianStatus['isComplete'],
            ];

            return view('dashboard.admin', compact(
                'totalAlternatif',
                'totalKriteria',
                'totalUser',
                'topRanking',
                'sawData',
                'kriteriaStatus',
                'alternatifStatus',
                'penilaianStatus',
                'sawStatus'
            ));
        } else {
            // Warga Dashboard
            $alternatif = Warga::with('penilaian')->where('user_id', $user->id)->first();
            $userRank = null;

            if ($alternatif) {
                foreach ($sawData['ranking'] as $item) {
                    if (($item['warga_id'] ?? $item['alternatif_id']) == $alternatif->id) {
                        $userRank = $item;
                        break;
                    }
                }
            }

            // Cek apakah kriteria C1-C4 sudah pernah diisi oleh warga
            $kriteriaList = Kriteria::orderBy('kode_kriteria')->get();
            $isCriteriaFilled = false;
            if ($alternatif && $alternatif->penilaian->count() > 0) {
                $nonZeroCount = $alternatif->penilaian->where('nilai', '>', 0)->count();
                $isCriteriaFilled = $nonZeroCount >= $kriteriaList->count();
            }

            $unlinkedAlternatifList = Warga::whereNull('user_id')->orderBy('nama_warga')->get();

            return view('dashboard.warga', compact('alternatif', 'userRank', 'sawData', 'unlinkedAlternatifList', 'isCriteriaFilled', 'kriteriaList'));
        }
    }

    /**
     * Warga Self-Service Update Biodata & Pengajuan Nilai Kriteria C1 - C4
     */
    public function updatePengajuan(Request $request)
    {
        $user = $request->user();
        $alternatif = Warga::where('user_id', $user->id)->firstOrFail();

        // Kunci data jika sudah lengkap & bukan admin untuk menjaga validasi seleksi RT
        if ($user->role !== 'admin') {
            $totalKriteria = Kriteria::count();
            $nonZeroCount = $alternatif->penilaian()->where('nilai', '>', 0)->count();
            if ($totalKriteria > 0 && $nonZeroCount >= $totalKriteria) {
                return redirect()->route('dashboard')->with('error', 'Data keluarga Anda sudah lengkap dan terkunci. Perubahan data selanjutnya hanya dapat divalidasi oleh Pengurus RT.');
            }
        }

        $request->validate([
            'no_kk' => 'nullable|string|max:30',
            'rt_rw' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ], [
            'rt_rw.required' => 'Wilayah RT/RW wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan utama wajib diisi.',
            'nilai.*.required' => 'Seluruh nilai kriteria C1 - C4 wajib diisi.',
            'nilai.*.numeric' => 'Nilai kriteria harus berupa angka valid.',
        ]);

        // Update biodata warga
        $alternatif->update([
            'no_kk' => $request->no_kk,
            'rt_rw' => $request->rt_rw,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
        ]);

        // Update nilai kriteria C1 s/d C4 (menggunakan kolom warga_id)
        foreach ($request->nilai as $kriteriaId => $nilaiValue) {
            Penilaian::updateOrCreate(
                [
                    'warga_id' => $alternatif->id,
                    'kriteria_id' => $kriteriaId,
                ],
                [
                    'nilai' => (float) $nilaiValue,
                ]
            );
        }

        return redirect()->route('dashboard')->with('success', 'Data kriteria keluarga (C1 s/d C4) berhasil disimpan dan diperbarui dalam sistem seleksi!');
    }

    /**
     * Self-service Warga NIK Connection (Input Mandiri atau Klaim Data Terdaftar)
     */
    public function claimNim(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|min:6|max:30',
            'no_kk' => 'nullable|string|max:30',
            'rt_rw' => 'nullable|string|max:100',
            'pekerjaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:500',
            'nilai' => 'nullable|array',
        ], [
            'nik.required' => 'Nomor Induk Kependudukan (NIK) wajib diisi.',
            'nik.min' => 'NIK harus memiliki minimal 6 digit atau 16 digit sesuai KTP.',
        ]);

        $user = $request->user();
        $cleanNik = preg_replace('/[^0-9]/', '', $request->nik);
        if (empty($cleanNik)) {
            $cleanNik = trim($request->nik);
        }

        // Cek apakah NIK sudah ada di database warga
        $alternatif = Warga::where('nik', $cleanNik)->first();

        if ($alternatif) {
            // Cek apakah sudah terhubung dengan user lain
            if ($alternatif->user_id && $alternatif->user_id !== $user->id) {
                return redirect()->back()->with('error', 'NIK ini sudah terhubung dengan akun warga lain. Silakan hubungi pengurus RT jika Anda adalah pemilik sah NIK ini.');
            }

            $alternatif->update([
                'user_id' => $user->id,
                'nama_warga' => $user->name,
                'no_kk' => $request->no_kk ?? $alternatif->no_kk,
                'rt_rw' => $request->rt_rw ?? $alternatif->rt_rw ?? 'RT 011/04',
                'pekerjaan' => $request->pekerjaan ?? $alternatif->pekerjaan ?? 'Warga RT',
                'alamat' => $request->alamat ?? $alternatif->alamat,
            ]);
        } else {
            // Buat record data Warga baru untuk pengguna ini
            $alternatif = Warga::create([
                'user_id' => $user->id,
                'nik' => $cleanNik,
                'nama_warga' => $user->name,
                'no_kk' => $request->no_kk,
                'rt_rw' => $request->rt_rw ?? 'RT 011/04',
                'pekerjaan' => $request->pekerjaan ?? 'Warga RT',
                'alamat' => $request->alamat,
            ]);
        }

        // Simpan atau inisialisasi baris penilaian kriteria
        $kriteriaList = Kriteria::all();
        $hasCustomScores = false;

        foreach ($kriteriaList as $k) {
            $submittedVal = $request->input("nilai.{$k->id}", null);
            $val = $submittedVal !== null && $submittedVal !== '' ? (float) $submittedVal : 0;
            if ($val > 0) {
                $hasCustomScores = true;
            }

            Penilaian::updateOrCreate(
                [
                    'warga_id' => $alternatif->id,
                    'kriteria_id' => $k->id,
                ],
                [
                    'nilai' => $val,
                ]
            );
        }

        $msg = 'Akun berhasil terhubung dengan NIK: ' . $alternatif->nik . '!';
        if ($hasCustomScores) {
            $msg .= ' Data kriteria pengajuan (C1 s/d C4) juga berhasil disimpan.';
        } else {
            $msg .= ' Silakan lanjutkan mengisi formulir kriteria C1 s/d C4 agar pengajuan Anda dapat dinilai.';
        }

        return redirect()->route('dashboard')->with('success', $msg);
    }

    /**
     * 1-Click Reset & Seed Sample Data for Admin Demo
     */
    public function resetSampleData(Request $request)
    {
        if (!$request->user()->isAdmin()) {
            abort(403);
        }

        // Run Seeder
        \Artisan::call('db:seed', ['--force' => true]);

        return redirect()->route('dashboard')->with('success', 'Data Sampel SPK Bansos RT berhasil diregenerasi secara instan!');
    }
}
