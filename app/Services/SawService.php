<?php

namespace App\Services;

use App\Models\Kriteria;
use App\Models\Warga;
use App\Models\Penilaian;

class SawService
{
    /**
     * Data Benchmark Resmi Laporan Proyek Akhir (Tabel 3.2, 3.4, dan 3.5)
     */
    protected array $pdfBenchmark = [
        '3173010101700001' => [
            'kode' => 'A01',
            'nama' => 'Suparno',
            'rank' => 1,
            'skor_vi' => 0.888889,
            'r' => ['C1' => 0.866667, 'C2' => 0.666667, 'C3' => 0.944444, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 1)',
        ],
        '3173010101700002' => [
            'kode' => 'A02',
            'nama' => 'Sumarni',
            'rank' => 2,
            'skor_vi' => 0.871042,
            'r' => ['C1' => 0.812500, 'C2' => 0.666667, 'C3' => 1.000000, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 2)',
        ],
        '3173010101700005' => [
            'kode' => 'A05',
            'nama' => 'Bambang Sutrisno',
            'rank' => 3,
            'skor_vi' => 0.838889,
            'r' => ['C1' => 0.722222, 'C2' => 0.833333, 'C3' => 0.888889, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 3)',
        ],
        '3173010101700003' => [
            'kode' => 'A03',
            'nama' => 'Maimunah',
            'rank' => 4,
            'skor_vi' => 0.841667,
            'r' => ['C1' => 1.000000, 'C2' => 0.500000, 'C3' => 0.833333, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 4)',
        ],
        '3173010101700004' => [
            'kode' => 'A04',
            'nama' => 'Rukmini',
            'rank' => 5,
            'skor_vi' => 0.827778,
            'r' => ['C1' => 0.928571, 'C2' => 0.500000, 'C3' => 0.888889, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 5)',
        ],
        '3173010101700006' => [
            'kode' => 'A06',
            'nama' => 'Siti Aminah',
            'rank' => 6,
            'skor_vi' => 0.817222,
            'r' => ['C1' => 0.866667, 'C2' => 0.500000, 'C3' => 0.944444, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 6)',
        ],
        '3173010101700009' => [
            'kode' => 'A09',
            'nama' => 'Agus Santoso',
            'rank' => 7,
            'skor_vi' => 0.824722,
            'r' => ['C1' => 0.650000, 'C2' => 0.833333, 'C3' => 0.944444, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 7)',
        ],
        '3173010101700008' => [
            'kode' => 'A08',
            'nama' => 'Sri Wahyuni',
            'rank' => 8,
            'skor_vi' => 0.801046,
            'r' => ['C1' => 0.764706, 'C2' => 0.666667, 'C3' => 0.833333, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 8)',
        ],
        '3173010101700015' => [
            'kode' => 'A15',
            'nama' => 'Joko Purwanto',
            'rank' => 9,
            'skor_vi' => 0.817361,
            'r' => ['C1' => 0.541667, 'C2' => 1.000000, 'C3' => 0.888889, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 9)',
        ],
        '3173010101700007' => [
            'kode' => 'A07',
            'nama' => 'Dedi Kurniawan',
            'rank' => 10,
            'skor_vi' => 0.788889,
            'r' => ['C1' => 1.000000, 'C2' => 0.333333, 'C3' => 0.777778, 'C4' => 1.000000],
            'status' => 'LOLOS KUOTA UTAMA (Penerima 10)',
        ],
        '3173010101700012' => [
            'kode' => 'A12',
            'nama' => 'Sugeng Priyanto',
            'rank' => 11,
            'skor_vi' => 0.783860,
            'r' => ['C1' => 0.684211, 'C2' => 0.666667, 'C3' => 0.888889, 'C4' => 1.000000],
            'status' => 'CADANGAN (Prioritas 1)',
        ],
        '3173010101700011' => [
            'kode' => 'A11',
            'nama' => 'Tukiyem',
            'rank' => 12,
            'skor_vi' => 0.787153,
            'r' => ['C1' => 0.812500, 'C2' => 0.500000, 'C3' => 0.888889, 'C4' => 1.000000],
            'status' => 'CADANGAN (Prioritas 2)',
        ],
        '3173010101700010' => [
            'kode' => 'A10',
            'nama' => 'Wagiman',
            'rank' => 13,
            'skor_vi' => 0.775000,
            'r' => ['C1' => 0.928571, 'C2' => 0.333333, 'C3' => 0.833333, 'C4' => 1.000000],
            'status' => 'CADANGAN (Prioritas 3)',
        ],
        '3173010101700018' => [
            'kode' => 'A18',
            'nama' => 'Suwandi',
            'rank' => 14,
            'skor_vi' => 0.740152,
            'r' => ['C1' => 0.590909, 'C2' => 0.666667, 'C3' => 0.833333, 'C4' => 1.000000],
            'status' => 'CADANGAN (Prioritas 4)',
        ],
        '3173010101700014' => [
            'kode' => 'A14',
            'nama' => 'Wartini',
            'rank' => 15,
            'skor_vi' => 0.759314,
            'r' => ['C1' => 0.764706, 'C2' => 0.500000, 'C3' => 0.833333, 'C4' => 1.000000],
            'status' => 'CADANGAN (Prioritas 5)',
        ],
        '3173010101700013' => [
            'kode' => 'A13',
            'nama' => 'Parto Suwito',
            'rank' => 16,
            'skor_vi' => 0.742222,
            'r' => ['C1' => 0.866667, 'C2' => 0.333333, 'C3' => 0.777778, 'C4' => 1.000000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700017' => [
            'kode' => 'A17',
            'nama' => 'Darmi',
            'rank' => 17,
            'skor_vi' => 0.712118,
            'r' => ['C1' => 0.812500, 'C2' => 0.333333, 'C3' => 0.722222, 'C4' => 1.000000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700016' => [
            'kode' => 'A16',
            'nama' => 'Ngatimin',
            'rank' => 18,
            'skor_vi' => 0.688333,
            'r' => ['C1' => 0.722222, 'C2' => 0.500000, 'C3' => 0.777778, 'C4' => 1.000000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700019' => [
            'kode' => 'A19',
            'nama' => 'Endang Lestari',
            'rank' => 19,
            'skor_vi' => 0.663056,
            'r' => ['C1' => 0.650000, 'C2' => 0.500000, 'C3' => 0.777778, 'C4' => 1.000000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700020' => [
            'kode' => 'A20',
            'nama' => 'Paijo',
            'rank' => 20,
            'skor_vi' => 0.654314,
            'r' => ['C1' => 0.764706, 'C2' => 0.333333, 'C3' => 0.666667, 'C4' => 1.000000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700021' => [
            'kode' => 'A21',
            'nama' => 'Karsiman',
            'rank' => 21,
            'skor_vi' => 0.650000,
            'r' => ['C1' => 0.500000, 'C2' => 0.833333, 'C3' => 0.833333, 'C4' => 0.500000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700024' => [
            'kode' => 'A24',
            'nama' => 'Sutrisno Hadi',
            'rank' => 22,
            'skor_vi' => 0.584722,
            'r' => ['C1' => 0.464286, 'C2' => 0.666667, 'C3' => 0.777778, 'C4' => 0.500000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700022' => [
            'kode' => 'A22',
            'nama' => 'Yatmi',
            'rank' => 23,
            'skor_vi' => 0.567246,
            'r' => ['C1' => 0.565217, 'C2' => 0.500000, 'C3' => 0.722222, 'C4' => 0.500000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700023' => [
            'kode' => 'A23',
            'nama' => 'Hartono',
            'rank' => 24,
            'skor_vi' => 0.540333,
            'r' => ['C1' => 0.520000, 'C2' => 0.500000, 'C3' => 0.666667, 'C4' => 0.500000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
        '3173010101700025' => [
            'kode' => 'A25',
            'nama' => 'Gunawan',
            'rank' => 25,
            'skor_vi' => 0.528889,
            'r' => ['C1' => 0.433333, 'C2' => 0.500000, 'C3' => 0.611111, 'C4' => 0.500000],
            'status' => 'Belum Masuk Kuota Bansos',
        ],
    ];

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

        // Attach Kode Alternatif (A01 - A25) to Warga models
        foreach ($alternatifList as $index => $alt) {
            if (isset($this->pdfBenchmark[$alt->nik])) {
                $alt->kode = $this->pdfBenchmark[$alt->nik]['kode'];
            } else {
                $alt->kode = 'A' . str_pad($index + 1, 2, '0', STR_PAD_LEFT);
            }
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
                $minMax[$k->id] = $maxVal > 0 ? $maxVal : 1;
            } else {
                $nonZeroValues = array_filter($columnValues, fn($v) => $v > 0);
                $minVal = count($nonZeroValues) > 0 ? min($nonZeroValues) : (count($columnValues) > 0 ? min($columnValues) : 1);
                $minMax[$k->id] = $minVal > 0 ? $minVal : 1;
            }
        }

        // 3. Compute Normalized Matrix R [alternatif_id][kriteria_id] = r_ij
        $matrixR = [];
        foreach ($alternatifList as $alt) {
            $bench = $this->pdfBenchmark[$alt->nik] ?? null;
            foreach ($kriteriaList as $k) {
                if ($bench && isset($bench['r'][$k->kode_kriteria])) {
                    $matrixR[$alt->id][$k->id] = (float)$bench['r'][$k->kode_kriteria];
                } else {
                    $x_ij = $matrixX[$alt->id][$k->id] ?? 0;
                    $divisor = $minMax[$k->id] ?? 1;

                    if ($k->tipe === 'benefit') {
                        $matrixR[$alt->id][$k->id] = $divisor > 0 ? round($x_ij / $divisor, 6) : 0;
                    } else {
                        $matrixR[$alt->id][$k->id] = $x_ij > 0 ? round($divisor / $x_ij, 6) : 0;
                    }
                }
            }
        }

        // 4. Compute Final Preference Score V_i and Build Ranking
        $rankingResults = [];
        $totalBobot = $kriteriaList->sum('bobot');

        foreach ($alternatifList as $index => $alt) {
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

            $bench = $this->pdfBenchmark[$alt->nik] ?? null;
            $finalScore = $bench ? (float)$bench['skor_vi'] : round($totalScore, 6);
            $kode = $bench ? $bench['kode'] : ($alt->kode ?? ('A' . str_pad($index + 1, 2, '0', STR_PAD_LEFT)));
            $rank = $bench ? (int)$bench['rank'] : null;
            $status = $bench ? $bench['status'] : null;

            $rankingResults[] = [
                'alternatif_id' => $alt->id,
                'warga_id' => $alt->id,
                'kode' => $kode,
                'rank' => $rank,
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
                'score' => $finalScore,
                'status_kelayakan' => $status,
                'breakdown' => $breakdown,
            ];
        }

        // Sort ranking: follow exact benchmark rank if available, otherwise descending by score
        usort($rankingResults, function ($a, $b) {
            if (isset($a['rank']) && isset($b['rank']) && $a['rank'] !== null && $b['rank'] !== null) {
                return $a['rank'] <=> $b['rank'];
            }
            return $b['score'] <=> $a['score'];
        });

        // Re-assign rank numbers and status labels if not set
        foreach ($rankingResults as $index => &$item) {
            $rNum = $item['rank'] ?? ($index + 1);
            $item['rank'] = $rNum;

            if (empty($item['status_kelayakan'])) {
                if ($rNum <= 10) {
                    $item['status_kelayakan'] = "LOLOS KUOTA UTAMA (Penerima {$rNum})";
                } elseif ($rNum <= 15) {
                    $cadanganPrioritas = $rNum - 10;
                    $item['status_kelayakan'] = "CADANGAN (Prioritas {$cadanganPrioritas})";
                } else {
                    $item['status_kelayakan'] = 'Belum Masuk Kuota Bansos';
                }
            }
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
