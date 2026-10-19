<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Warga;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class WargaSeeder extends Seeder
{
    /**
     * Seed 25 Alternatif Data Warga (RT 011 / RW 04 Kelurahan Jelambar, Grogol Petamburan)
     * Sesuai Laporan Proyek Akhir Rekayasa Perangkat Lunak (Tabel 3.2).
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Penilaian::truncate();
        Warga::truncate();
        Schema::enableForeignKeyConstraints();

        $kriteriaModels = Kriteria::all()->keyBy('kode_kriteria');

        $wargaData = [
            // A01 - Suparno
            [
                'user_email' => 'suparno@gmail.com',
                'no_kk' => '3173010101010001',
                'nik' => '3173010101700001',
                'nama_warga' => 'Suparno',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 1, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Harian Lepas',
                'scores' => ['C1' => 750000, 'C2' => 4, 'C3' => 85, 'C4' => 450],
            ],
            // A02 - Sumarni
            [
                'user_email' => 'sumarni@gmail.com',
                'no_kk' => '3173010101010002',
                'nik' => '3173010101700002',
                'nama_warga' => 'Sumarni',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 2, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Jamu Gendong',
                'scores' => ['C1' => 800000, 'C2' => 4, 'C3' => 90, 'C4' => 450],
            ],
            // A03 - Maimunah
            [
                'user_email' => 'maimunah@gmail.com',
                'no_kk' => '3173010101010003',
                'nik' => '3173010101700003',
                'nama_warga' => 'Maimunah',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 3, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Cuci Setrika',
                'scores' => ['C1' => 650000, 'C2' => 3, 'C3' => 75, 'C4' => 450],
            ],
            // A04 - Rukmini
            [
                'user_email' => 'rukmini@gmail.com',
                'no_kk' => '3173010101010004',
                'nik' => '3173010101700004',
                'nama_warga' => 'Rukmini',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 4, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Sayur Keliling',
                'scores' => ['C1' => 700000, 'C2' => 3, 'C3' => 80, 'C4' => 450],
            ],
            // A05 - Bambang Sutrisno
            [
                'user_email' => 'bambang@gmail.com',
                'no_kk' => '3173010101010005',
                'nik' => '3173010101700005',
                'nama_warga' => 'Bambang Sutrisno',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 5, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pekerja Serabutan',
                'scores' => ['C1' => 900000, 'C2' => 5, 'C3' => 80, 'C4' => 450],
            ],
            // A06 - Siti Aminah
            [
                'user_email' => 'sitiaminah@gmail.com',
                'no_kk' => '3173010101010006',
                'nik' => '3173010101700006',
                'nama_warga' => 'Siti Aminah',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 6, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Cuci Harian',
                'scores' => ['C1' => 750000, 'C2' => 3, 'C3' => 85, 'C4' => 450],
            ],
            // A07 - Dedi Kurniawan
            [
                'user_email' => 'dedi@gmail.com',
                'no_kk' => '3173010101010007',
                'nik' => '3173010101700007',
                'nama_warga' => 'Dedi Kurniawan',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 7, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pengemudi Ojek Online',
                'scores' => ['C1' => 650000, 'C2' => 2, 'C3' => 70, 'C4' => 450],
            ],
            // A08 - Sri Wahyuni
            [
                'user_email' => 'sriwahyuni@gmail.com',
                'no_kk' => '3173010101010008',
                'nik' => '3173010101700008',
                'nama_warga' => 'Sri Wahyuni',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 8, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Gorengan',
                'scores' => ['C1' => 850000, 'C2' => 4, 'C3' => 75, 'C4' => 450],
            ],
            // A09 - Agus Santoso
            [
                'user_email' => 'agussantoso@gmail.com',
                'no_kk' => '3173010101010009',
                'nik' => '3173010101700009',
                'nama_warga' => 'Agus Santoso',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 9, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Kuli Bangunan',
                'scores' => ['C1' => 1000000, 'C2' => 5, 'C3' => 85, 'C4' => 450],
            ],
            // A10 - Wagiman
            [
                'user_email' => 'wagiman@gmail.com',
                'no_kk' => '3173010101010010',
                'nik' => '3173010101700010',
                'nama_warga' => 'Wagiman',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 10, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Lansia / Buruh Tani Kota',
                'scores' => ['C1' => 700000, 'C2' => 2, 'C3' => 75, 'C4' => 450],
            ],
            // A11 - Tukiyem
            [
                'user_email' => 'tukiyem@gmail.com',
                'no_kk' => '3173010101010011',
                'nik' => '3173010101700011',
                'nama_warga' => 'Tukiyem',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 11, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pembuat Kerupuk Rumahan',
                'scores' => ['C1' => 800000, 'C2' => 3, 'C3' => 80, 'C4' => 450],
            ],
            // A12 - Sugeng Priyanto
            [
                'user_email' => 'sugeng@gmail.com',
                'no_kk' => '3173010101010012',
                'nik' => '3173010101700012',
                'nama_warga' => 'Sugeng Priyanto',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 12, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Supir Angkot',
                'scores' => ['C1' => 950000, 'C2' => 4, 'C3' => 80, 'C4' => 450],
            ],
            // A13 - Parto Suwito
            [
                'user_email' => 'partosuwito@gmail.com',
                'no_kk' => '3173010101010013',
                'nik' => '3173010101700013',
                'nama_warga' => 'Parto Suwito',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 13, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Becak / Ojek',
                'scores' => ['C1' => 750000, 'C2' => 2, 'C3' => 70, 'C4' => 450],
            ],
            // A14 - Wartini
            [
                'user_email' => 'wartini@gmail.com',
                'no_kk' => '3173010101010014',
                'nik' => '3173010101700014',
                'nama_warga' => 'Wartini',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 14, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Penjual Kue Keliling',
                'scores' => ['C1' => 850000, 'C2' => 3, 'C3' => 75, 'C4' => 450],
            ],
            // A15 - Joko Purwanto
            [
                'user_email' => 'jokopurwanto@gmail.com',
                'no_kk' => '3173010101010015',
                'nik' => '3173010101700015',
                'nama_warga' => 'Joko Purwanto',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 15, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Kuli Angkut Pasar',
                'scores' => ['C1' => 1200000, 'C2' => 6, 'C3' => 80, 'C4' => 450],
            ],
            // A16 - Ngatimin
            [
                'user_email' => 'ngatimin@gmail.com',
                'no_kk' => '3173010101010016',
                'nik' => '3173010101700016',
                'nama_warga' => 'Ngatimin',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 16, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pemulung Barang Bekas',
                'scores' => ['C1' => 900000, 'C2' => 3, 'C3' => 70, 'C4' => 450],
            ],
            // A17 - Darmi
            [
                'user_email' => 'darmi@gmail.com',
                'no_kk' => '3173010101010017',
                'nik' => '3173010101700017',
                'nama_warga' => 'Darmi',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 17, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Jahit Rumahan',
                'scores' => ['C1' => 800000, 'C2' => 2, 'C3' => 65, 'C4' => 450],
            ],
            // A18 - Suwandi
            [
                'user_email' => 'suwandi@gmail.com',
                'no_kk' => '3173010101010018',
                'nik' => '3173010101700018',
                'nama_warga' => 'Suwandi',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 18, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Sol Sepatu',
                'scores' => ['C1' => 1100000, 'C2' => 4, 'C3' => 75, 'C4' => 450],
            ],
            // A19 - Endang Lestari
            [
                'user_email' => 'endanglestari@gmail.com',
                'no_kk' => '3173010101010019',
                'nik' => '3173010101700019',
                'nama_warga' => 'Endang Lestari',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 19, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Kaki Lima',
                'scores' => ['C1' => 1000000, 'C2' => 3, 'C3' => 70, 'C4' => 450],
            ],
            // A20 - Paijo
            [
                'user_email' => 'paijo@gmail.com',
                'no_kk' => '3173010101010020',
                'nik' => '3173010101700020',
                'nama_warga' => 'Paijo',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 20, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Parkir',
                'scores' => ['C1' => 850000, 'C2' => 2, 'C3' => 60, 'C4' => 450],
            ],
            // A21 - Karsiman
            [
                'user_email' => 'karsiman@gmail.com',
                'no_kk' => '3173010101010021',
                'nik' => '3173010101700021',
                'nama_warga' => 'Karsiman',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 21, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Montir Bengkel Kecil',
                'scores' => ['C1' => 1300000, 'C2' => 5, 'C3' => 75, 'C4' => 900],
            ],
            // A22 - Yatmi
            [
                'user_email' => 'yatmi@gmail.com',
                'no_kk' => '3173010101010022',
                'nik' => '3173010101700022',
                'nama_warga' => 'Yatmi',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 22, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Penjual Nasi Uduk',
                'scores' => ['C1' => 1150000, 'C2' => 3, 'C3' => 65, 'C4' => 900],
            ],
            // A23 - Hartono
            [
                'user_email' => 'hartono@gmail.com',
                'no_kk' => '3173010101010023',
                'nik' => '3173010101700023',
                'nama_warga' => 'Hartono',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 23, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Kayu / Mebel',
                'scores' => ['C1' => 1250000, 'C2' => 3, 'C3' => 60, 'C4' => 900],
            ],
            // A24 - Sutrisno Hadi
            [
                'user_email' => 'sutrisnohadi@gmail.com',
                'no_kk' => '3173010101010024',
                'nik' => '3173010101700024',
                'nama_warga' => 'Sutrisno Hadi',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 24, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Karyawan Toko',
                'scores' => ['C1' => 1400000, 'C2' => 4, 'C3' => 70, 'C4' => 900],
            ],
            // A25 - Gunawan
            [
                'user_email' => 'gunawan@gmail.com',
                'no_kk' => '3173010101010025',
                'nik' => '3173010101700025',
                'nama_warga' => 'Gunawan',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 25, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Satpam Kompleks',
                'scores' => ['C1' => 1500000, 'C2' => 3, 'C3' => 55, 'C4' => 900],
            ],
        ];

        foreach ($wargaData as $altData) {
            $scores = $altData['scores'];
            $userEmail = $altData['user_email'] ?? null;
            
            unset($altData['scores']);
            if (isset($altData['user_email'])) {
                unset($altData['user_email']);
            }
            
            if ($userEmail) {
                $user = User::firstOrCreate(
                    ['email' => $userEmail],
                    [
                        'name' => $altData['nama_warga'],
                        'password' => Hash::make('password'),
                        'role' => 'warga',
                    ]
                );
                $altData['user_id'] = $user->id;
            }

            $alternatif = Warga::updateOrCreate(
                ['nik' => $altData['nik']],
                $altData
            );

            // Seed Penilaian Matrix
            foreach ($scores as $kodeKriteria => $nilai) {
                if (isset($kriteriaModels[$kodeKriteria])) {
                    Penilaian::updateOrCreate(
                        [
                            'warga_id' => $alternatif->id,
                            'kriteria_id' => $kriteriaModels[$kodeKriteria]->id,
                        ],
                        ['nilai' => $nilai]
                    );
                }
            }
        }
    }
}
