<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria')->get();
        $alternatif = Warga::with('penilaian')->orderBy('nik')->paginate(5);
        $totalWarga = Warga::count();

        // Map existing scores [alternatif_id][kriteria_id] => nilai
        $penilaianMatrix = [];
        foreach ($alternatif as $alt) {
            foreach ($kriteria as $k) {
                $p = $alt->penilaian->where('kriteria_id', $k->id)->first();
                $penilaianMatrix[$alt->id][$k->id] = $p ? $p->nilai : 0;
            }
        }

        return view('penilaian.index', compact('kriteria', 'alternatif', 'penilaianMatrix', 'totalWarga'));
    }

    public function updateBatch(Request $request)
    {
        $kriteriaMap = Kriteria::all()->keyBy('id');
        $inputNilai = $request->input('nilai', []);

        foreach ($inputNilai as $altId => $scores) {
            if (is_array($scores)) {
                foreach ($scores as $kId => $val) {
                    $k = $kriteriaMap->get($kId);
                    if (is_string($val)) {
                        if ($k && in_array($k->kode_kriteria, ['C1'])) {
                            // Strip dot for Rupiah (e.g. 1.200.000 -> 1200000)
                            $inputNilai[$altId][$kId] = str_replace('.', '', $val);
                        } else {
                            // Replace comma with dot
                            $inputNilai[$altId][$kId] = str_replace(',', '.', $val);
                        }
                    }
                }
            }
        }
        $request->merge(['nilai' => $inputNilai]);

        $rules = ['nilai' => 'required|array'];

        foreach ($request->input('nilai', []) as $altId => $scores) {
            if (is_array($scores)) {
                foreach ($scores as $kId => $val) {
                    $rules["nilai.{$altId}.{$kId}"] = ['required', 'numeric', 'min:0'];
                }
            }
        }

        $request->validate($rules, [
            'nilai.*.*.required' => 'Nilai kriteria wajib diisi.',
            'nilai.*.*.numeric' => 'Nilai kriteria harus berupa angka.',
        ]);

        foreach ($request->nilai as $alternatifId => $kriteriaScores) {
            foreach ($kriteriaScores as $kriteriaId => $val) {
                Penilaian::updateOrCreate(
                    [
                        'warga_id' => $alternatifId,
                        'kriteria_id' => $kriteriaId,
                    ],
                    [
                        'nilai' => (float)$val,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Nilai kriteria warga calon penerima bansos berhasil diperbarui!');
    }
}
