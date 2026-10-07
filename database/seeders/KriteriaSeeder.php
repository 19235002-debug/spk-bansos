<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Seed Kriteria SAW Penerimaan Bantuan Sosial (BANSOS).
     */
    public function run(): void
    {
        $kriterias = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Pendapatan Keluarga per Bulan (Rp)',
                'bobot' => 0.35,
                'tipe' => 'cost', // Semakin kecil pendapatan, semakin prioritas
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Jumlah Tanggungan Keluarga (Jiwa)',
                'bobot' => 0.25,
                'tipe' => 'benefit', // Semakin banyak tanggungan, semakin prioritas (0 diperbolehkan)
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Kondisi Rumah (Skor 1-5)',
                'bobot' => 0.20,
                'tipe' => 'benefit', // Semakin tinggi skor kondisi rumah (semakin memprihatinkan), semakin prioritas
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Daya Listrik Rumah (VA)',
                'bobot' => 0.20,
                'tipe' => 'cost', // Semakin kecil daya listrik (450 VA), semakin prioritas
            ],
        ];

        foreach ($kriterias as $k) {
            Kriteria::updateOrCreate(
                ['kode_kriteria' => $k['kode_kriteria']],
                $k
            );
        }
    }
}
