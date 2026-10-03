<?php

namespace App\Services;

use App\Models\Kriteria;
use App\Models\Warga;
use App\Models\Penilaian;

class SawService
{
    /**
     * Calculate SAW Method Step-by-Step for SPK Bansos
     * 
     * @return array
     */
    public function calculate(): array
    {
        $kriteriaList = Kriteria::orderBy('kode_kriteria')->get();
        $alternatifList = Warga::with('penilaian')->orderBy('nik')->get();

        if ($kriteriaList->isEmpty() || $alternatifList->isEmpty()) {
            return [
                'kriteria' => $kriteriaList,
                'alternatif' => $alternatifList,
                'matrixX' => [],
                'minMax' => [],
                'matrixR' => [],
                'ranking' => [],
                'totalBobot' => 0,
            ];
        }

        // 1. Build Decision Matrix X [alternatif_id][kriteria_id] = nilai
        $matrixX = [];
        foreach ($alternatifList as $alt) {
            foreach ($kriteriaList as $k) {
                $penilaian = $alt->penilaian->where('kriteria_id', $k->id)->first();
                $val = $penilaian ? (float)$penilaian->nilai : 0.0;
                $matrixX[$alt->id][$k->id] = $val;
            }
        }

        // 2. Find Min / Max for each criterion
        $minMax = [];
        foreach ($kriteriaList as $k) {
            $columnValues = [];
            foreach ($alternatifList as $alt) {
                $columnValues[] = $matrixX[$alt->id][$k->id] ?? 0;
            }

            if ($k->tipe === 'benefit') {
                $maxVal = count($columnValues) > 0 ? max($columnValues) : 1;
                $minMax[$k->id] = $maxVal > 0 ? $maxVal : 1; // avoid division by zero
            } else {
                // Cost criterion
                $nonZeroValues = array_filter($columnValues, fn($v) => $v > 0);
                $minVal = count($nonZeroValues) > 0 ? min($nonZeroValues) : (count($columnValues) > 0 ? min($columnValues) : 1);
                $minMax[$k->id] = $minVal > 0 ? $minVal : 1;
            }
        }

        // 3. Compute Normalized Matrix R [alternatif_id][kriteria_id] = r_ij
        $matrixR = [];
        foreach ($alternatifList as $alt) {
            foreach ($kriteriaList as $k) {
                $x_ij = $matrixX[$alt->id][$k->id] ?? 0;
                $divisor = $minMax[$k->id] ?? 1;

                if ($k->tipe === 'benefit') {
                    // r_ij = X_ij / max(X_ij)
                    $matrixR[$alt->id][$k->id] = $divisor > 0 ? ($x_ij / $divisor) : 0;
                } else {
                    // r_ij = min(X_ij) / X_ij
                    $matrixR[$alt->id][$k->id] = $x_ij > 0 ? ($divisor / $x_ij) : 0;
                }
            }
        }

        // 4. Compute Final Preference Score V_i = sum(w_j * r_ij)
        $rankingResults = [];
        $totalBobot = $kriteriaList->sum('bobot');

        foreach ($alternatifList as $alt) {
            $totalScore = 0;
            $breakdown = [];

            foreach ($kriteriaList as $k) {
                $r_ij = $matrixR[$alt->id][$k->id] ?? 0;
                $w_j = (float)$k->bobot;
                $partScore = $w_j * $r_ij;
                $totalScore += $partScore;

                $breakdown[$k->id] = [
                    'w_j' => $w_j,
                    'r_ij' => $r_ij,
                    'score' => $partScore,
                ];
            }

            $rankingResults[] = [
                'alternatif_id' => $alt->id,
                'no_kk' => $alt->no_kk,
                'nik' => $alt->nik,
                'nim' => $alt->nik,
                'nama' => $alt->nama_warga,
                'nama_warga' => $alt->nama_warga,
                'rt_rw' => $alt->rt_rw,
                'prodi' => $alt->rt_rw,
                'alamat' => $alt->alamat,
                'pekerjaan' => $alt->pekerjaan,
                'user_id' => $alt->user_id,
                'score' => $totalScore,
                'breakdown' => $breakdown,
            ];
        }

        // Sort descending by score
        usort($rankingResults, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Assign Rank (1-based)
        foreach ($rankingResults as $index => &$item) {
            $item['rank'] = $index + 1;
        }

        return [
            'kriteria' => $kriteriaList,
            'alternatif' => $alternatifList,
            'matrixX' => $matrixX,
            'minMax' => $minMax,
            'matrixR' => $matrixR,
            'ranking' => $rankingResults,
            'totalBobot' => $totalBobot,
        ];
    }
}
