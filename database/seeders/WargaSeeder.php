<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Warga;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    /**
     * Seed 25 Alternatif Data Warga (RT 011 / RW 04 Kelurahan Jelambar, Grogol Petamburan).
     */
    public function run(): void
    {
        $kriteriaModels = Kriteria::all()->keyBy('kode_kriteria');

        $wargaData = [
            // --- TOP 10 PENERIMA UTAMA BANSOS (RANK 1 - 10) ---
            [
                'user_email' => 'ridwan@gmail.com',
                'no_kk' => '3173020101010001',
                'nik' => '3173022304750001',
                'nama_warga' => 'Pak Ridwan',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 1, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Bangunan Harian',
                'scores' => ['C1' => 750000, 'C2' => 5, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'mutiara@gmail.com',
                'no_kk' => '3173020101010002',
                'nik' => '3173025608800002',
                'nama_warga' => 'Ibu Mutiara',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 2, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Jamu Gendong (Single Parent)',
                'scores' => ['C1' => 800000, 'C2' => 5, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'maimunah@gmail.com',
                'no_kk' => '3173020101010003',
                'nik' => '3173026111780003',
                'nama_warga' => 'Ibu Maimunah',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 3, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pemulung Sampah Plastik',
                'scores' => ['C1' => 700000, 'C2' => 4, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'ratna@gmail.com',
                'no_kk' => '3173020101010004',
                'nik' => '3173026111780004',
                'nama_warga' => 'Ibu Ratna',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 4, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Cuci Harian',
                'scores' => ['C1' => 900000, 'C2' => 5, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'fikri@gmail.com',
                'no_kk' => '3173020101010005',
                'nik' => '3173021201700005',
                'nama_warga' => 'Bang Fikri',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 5, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pengemudi Bajaj / Ojek Pengkolan',
                'scores' => ['C1' => 950000, 'C2' => 4, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'rina@gmail.com',
                'no_kk' => '3173020101010006',
                'nik' => '3173026111780006',
                'nama_warga' => 'Ibu Rina',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 6, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Gorengan Keliling',
                'scores' => ['C1' => 1000000, 'C2' => 5, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'syahrul@gmail.com',
                'no_kk' => '3173020101010007',
                'nik' => '3173021201700007',
                'nama_warga' => 'Bang Syahrul',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 7, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Kuli Angkut Pasar',
                'scores' => ['C1' => 1050000, 'C2' => 4, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'syifa@gmail.com',
                'no_kk' => '3173020101010008',
                'nik' => '3173026111780008',
                'nama_warga' => 'Ibu Syifa',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 8, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Jasa Jahit Pakaian Rumahan',
                'scores' => ['C1' => 1100000, 'C2' => 4, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'farhan@gmail.com',
                'no_kk' => '3173020101010009',
                'nik' => '3173021201700009',
                'nama_warga' => 'Pak Farhan',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 9, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Sol Sepatu',
                'scores' => ['C1' => 1150000, 'C2' => 3, 'C3' => 5, 'C4' => 450],
            ],
            [
                'user_email' => 'nadia@gmail.com',
                'no_kk' => '3173020101010010',
                'nik' => '3173026111780010',
                'nama_warga' => 'Ibu Nadia',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 10, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Buruh Setrika Harian',
                'scores' => ['C1' => 1200000, 'C2' => 4, 'C3' => 4, 'C4' => 450],
            ],

            // --- 5 PERINGKAT CADANGAN BANSOS (RANK 11 - 15) ---
            [
                'user_email' => 'andre@gmail.com',
                'no_kk' => '3173020101010011',
                'nik' => '3173021201700011',
                'nama_warga' => 'Bang Andre',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 11, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pengemudi Ojek Online (Driver Ojol)',
                'scores' => ['C1' => 1500000, 'C2' => 3, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'rohaye@gmail.com',
                'no_kk' => '3173020101010012',
                'nik' => '3173026111780012',
                'nama_warga' => 'Ibu Rohaye',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 12, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Warung Kopi / Starling',
                'scores' => ['C1' => 1600000, 'C2' => 3, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'reza@gmail.com',
                'no_kk' => '3173020101010013',
                'nik' => '3173021201700013',
                'nama_warga' => 'Bang Reza',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 13, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Parkir Pasar',
                'scores' => ['C1' => 1550000, 'C2' => 3, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'melati@gmail.com',
                'no_kk' => '3173020101010014',
                'nik' => '3173026111780014',
                'nama_warga' => 'Ibu Melati',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 14, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Pembuat Kerupuk Rumahan',
                'scores' => ['C1' => 1700000, 'C2' => 4, 'C3' => 4, 'C4' => 450],
            ],
            [
                'user_email' => 'tommy@gmail.com',
                'no_kk' => '3173020101010015',
                'nik' => '3173021201700015',
                'nama_warga' => 'Pak Tommy',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 15, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Servis Elektronik',
                'scores' => ['C1' => 1750000, 'C2' => 3, 'C3' => 3, 'C4' => 900],
            ],

            // --- 10 DATA BELUM LAYAK / TIDAK LULUS (RANK 16 - 25) ---
            [
                'user_email' => 'dimas@gmail.com',
                'no_kk' => '3173020101010016',
                'nik' => '3173021201700016',
                'nama_warga' => 'Pak Dimas',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 16, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Tukang Kayu Perabot',
                'scores' => ['C1' => 2000000, 'C2' => 2, 'C3' => 3, 'C4' => 900],
            ],
            [
                'user_email' => 'citra@gmail.com',
                'no_kk' => '3173020101010017',
                'nik' => '3173026111780017',
                'nama_warga' => 'Ibu Citra',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 17, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Penjual Nasi Uduk Betawi',
                'scores' => ['C1' => 2200000, 'C2' => 3, 'C3' => 3, 'C4' => 900],
            ],
            [
                'user_email' => 'kevin@gmail.com',
                'no_kk' => '3173020101010018',
                'nik' => '3173021201700018',
                'nama_warga' => 'Pak Kevin',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 18, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Supir Angkot Harian',
                'scores' => ['C1' => 2500000, 'C2' => 2, 'C3' => 3, 'C4' => 900],
            ],
            [
                'user_email' => 'amanda@gmail.com',
                'no_kk' => '3173020101010019',
                'nik' => '3173026111780019',
                'nama_warga' => 'Ibu Amanda',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 19, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Penjual Baju Online',
                'scores' => ['C1' => 2800000, 'C2' => 2, 'C3' => 3, 'C4' => 900],
            ],
            [
                'user_email' => 'faisal@gmail.com',
                'no_kk' => '3173020101010020',
                'nik' => '3173021201700020',
                'nama_warga' => 'Pak Faisal',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 20, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Satpam Kompleks',
                'scores' => ['C1' => 3000000, 'C2' => 2, 'C3' => 2, 'C4' => 900],
            ],
            [
                'user_email' => 'randy@gmail.com',
                'no_kk' => '3173020101010021',
                'nik' => '3173021905820021',
                'nama_warga' => 'Bang Randy',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 21, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Karyawan Swasta Garmen',
                'scores' => ['C1' => 3500000, 'C2' => 2, 'C3' => 2, 'C4' => 1300],
            ],
            [
                'user_email' => 'irfan@gmail.com',
                'no_kk' => '3173020101010022',
                'nik' => '3173021201700022',
                'nama_warga' => 'Pak Irfan',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 22, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Supervisor Minimarket',
                'scores' => ['C1' => 4000000, 'C2' => 1, 'C3' => 2, 'C4' => 1300],
            ],
            [
                'user_email' => 'maya@gmail.com',
                'no_kk' => '3173020101010023',
                'nik' => '3173026111780023',
                'nama_warga' => 'Ibu Maya',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 23, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Guru Sekolah Dasar',
                'scores' => ['C1' => 4800000, 'C2' => 1, 'C3' => 2, 'C4' => 1300],
            ],
            [
                'user_email' => 'david@gmail.com',
                'no_kk' => '3173020101010024',
                'nik' => '3173021201700024',
                'nama_warga' => 'Pak David',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 24, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Manager Toko',
                'scores' => ['C1' => 5200000, 'C2' => 1, 'C3' => 1, 'C4' => 2200],
            ],
            [
                'user_email' => 'hendra@gmail.com',
                'no_kk' => '3173020101010025',
                'nik' => '3173021201700025',
                'nama_warga' => 'Pak Hendra',
                'rt_rw' => 'RT 011/04',
                'alamat' => 'Jl. Satria X No. 25, RT 011/04, Kel. Jelambar',
                'pekerjaan' => 'Wiraswasta Toko Sembako',
                'scores' => ['C1' => 5800000, 'C2' => 1, 'C3' => 1, 'C4' => 2200],
            ],
        ];

        foreach ($wargaData as $altData) {
            $scores = $altData['scores'];
            $userEmail = $altData['user_email'];
            
            unset($altData['scores'], $altData['user_email']);
            
            $user = User::where('email', $userEmail)->first();
            $altData['user_id'] = $user ? $user->id : null;

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
