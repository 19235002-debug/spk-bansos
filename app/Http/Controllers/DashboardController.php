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
            $alternatif = Warga::where('user_id', $user->id)->first();
            $userRank = null;

            if ($alternatif) {
                foreach ($sawData['ranking'] as $item) {
                    if ($item['alternatif_id'] == $alternatif->id) {
                        $userRank = $item;
                        break;
                    }
                }
            }

            $unlinkedAlternatifList = Warga::whereNull('user_id')->get();

            return view('dashboard.warga', compact('alternatif', 'userRank', 'sawData', 'unlinkedAlternatifList'));
        }
    }

    /**
     * Warga Self-Service Update Biodata & Pengajuan Nilai Kriteria
     */
    public function updatePengajuan(Request $request)
    {
        $user = $request->user();
        $alternatif = Warga::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'no_kk' => 'nullable|string|max:30',
            'rt_rw' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:0',
        ], [
            'rt_rw.required' => 'Wilayah RT wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'nilai.*.required' => 'Nilai kriteria wajib diisi.',
        ]);

        // Update Warga info
        $alternatif->update([
            'no_kk' => $request->no_kk,
            'rt_rw' => $request->rt_rw,
            'pekerjaan' => $request->pekerjaan,
        ]);

        // Update criteria scores
        foreach ($request->nilai as $kriteriaId => $nilaiValue) {
            Penilaian::updateOrCreate(
                [
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $kriteriaId,
                ],
                [
                    'nilai' => (float) $nilaiValue,
                ]
            );
        }

        return redirect()->route('dashboard')->with('success', 'Data pengajuan penerima bansos dan kriteria Anda berhasil diperbarui!');
    }

    /**
     * Self-service Warga NIK Claiming
     */
    public function claimNim(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|exists:warga,nik',
        ]);

        $user = $request->user();

        // Check if NIK is already claimed by another user
        $alternatif = Warga::where('nik', $request->nik)->first();

        if ($alternatif->user_id && $alternatif->user_id !== $user->id) {
            return redirect()->back()->with('error', 'NIK ini sudah terhubung dengan akun pengguna lain.');
        }

        $alternatif->update([
            'user_id' => $user->id,
            'nama_warga' => $user->name,
        ]);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil terhubung dengan Data Warga NIK: ' . $alternatif->nik);
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
