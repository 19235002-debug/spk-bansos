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
                'user_email' => 'suparno@gmail.com',
                'no_kk' => '3173020101010001',
                'nik' => '3173022304750001',
                'nama_warga' => 'Pak Suparno',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 12, Kel. Jelambar',
                'pekerjaan' => 'Buruh Harian Lepas',
                'scores' => ['C1' => 750000, 'C2' => 5, 'C3' => 95, 'C4' => 450],
            ],
            [
                'user_email' => 'sumarni@gmail.com',
                'no_kk' => '3173020101010002',
                'nik' => '3173025608800002',
                'nama_warga' => 'Ibu Sumarni',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 25, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Jamu Gendong (Single Parent)',
                'scores' => ['C1' => 800000, 'C2' => 5, 'C3' => 90, 'C4' => 450],
            ],
            [
                'user_email' => 'maimunah@gmail.com',
                'no_kk' => '3173020101010003',
                'nik' => '3173026111780003',
                'nama_warga' => 'Ibu Maimunah',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Selatan No. 03, Kel. Jelambar',
                'pekerjaan' => 'Pemulung Sampah Plastik',
                'scores' => ['C1' => 700000, 'C2' => 4, 'C3' => 95, 'C4' => 450],
            ],
            [
                'user_email' => 'ratna@gmail.com',
                'no_kk' => '3173020101010004',
                'nik' => '3173026111780004',
                'nama_warga' => 'Ibu Ratna',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 17, Kel. Jelambar',
                'pekerjaan' => 'Buruh Cuci Harian',
                'scores' => ['C1' => 900000, 'C2' => 5, 'C3' => 85, 'C4' => 450],
            ],
            [
                'user_email' => 'wagiman@gmail.com',
                'no_kk' => '3173020101010005',
                'nik' => '3173021201700005',
                'nama_warga' => 'Pak Wagiman',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Barat No. 09, Kel. Jelambar',
                'pekerjaan' => 'Tukang Becak Motor',
                'scores' => ['C1' => 950000, 'C2' => 4, 'C3' => 88, 'C4' => 450],
            ],
            [
                'user_email' => 'marsini@gmail.com',
                'no_kk' => '3173020101010006',
                'nik' => '3173026111780006',
                'nama_warga' => 'Ibu Marsini',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 14, Kel. Jelambar',
                'pekerjaan' => 'Jual Gorengan Keliling',
                'scores' => ['C1' => 1000000, 'C2' => 5, 'C3' => 85, 'C4' => 450],
            ],
            [
                'user_email' => 'karsiyo@gmail.com',
                'no_kk' => '3173020101010007',
                'nik' => '3173021201700007',
                'nama_warga' => 'Pak Karsiyo',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 06, Kel. Jelambar',
                'pekerjaan' => 'Buruh Tani / Kebun Lepas',
                'scores' => ['C1' => 1050000, 'C2' => 4, 'C3' => 82, 'C4' => 450],
            ],
            [
                'user_email' => 'sutarni@gmail.com',
                'no_kk' => '3173020101010008',
                'nik' => '3173026111780008',
                'nama_warga' => 'Ibu Sutarni',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Barat No. 21, Kel. Jelambar',
                'pekerjaan' => 'Jasa Jahit Pakaian Bekas',
                'scores' => ['C1' => 1100000, 'C2' => 4, 'C3' => 80, 'C4' => 450],
            ],
            [
                'user_email' => 'parijo@gmail.com',
                'no_kk' => '3173020101010009',
                'nik' => '3173021201700009',
                'nama_warga' => 'Pak Parijo',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Selatan No. 11, Kel. Jelambar',
                'pekerjaan' => 'Tukang Sol Sepatu',
                'scores' => ['C1' => 1150000, 'C2' => 3, 'C3' => 85, 'C4' => 450],
            ],
            [
                'user_email' => 'ningsih@gmail.com',
                'no_kk' => '3173020101010010',
                'nik' => '3173026111780010',
                'nama_warga' => 'Ibu Ningsih',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 30, Kel. Jelambar',
                'pekerjaan' => 'Buruh Setrika Harian',
                'scores' => ['C1' => 1200000, 'C2' => 4, 'C3' => 78, 'C4' => 450],
            ],

            // --- 5 PERINGKAT CADANGAN BANSOS (RANK 11 - 15) ---
            [
                'user_email' => 'hartono@gmail.com',
                'no_kk' => '3173020101010011',
                'nik' => '3173021201700011',
                'nama_warga' => 'Pak Hartono',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 04, Kel. Jelambar',
                'pekerjaan' => 'Pengemudi Ojek Online',
                'scores' => ['C1' => 1500000, 'C2' => 3, 'C3' => 75, 'C4' => 450],
            ],
            [
                'user_email' => 'rohaye@gmail.com',
                'no_kk' => '3173020101010012',
                'nik' => '3173026111780012',
                'nama_warga' => 'Ibu Rohaye',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Selatan No. 18, Kel. Jelambar',
                'pekerjaan' => 'Pedagang Warung Kopi',
                'scores' => ['C1' => 1600000, 'C2' => 3, 'C3' => 72, 'C4' => 450],
            ],
            [
                'user_email' => 'sugeng@gmail.com',
                'no_kk' => '3173020101010013',
                'nik' => '3173021201700013',
                'nama_warga' => 'Pak Sugeng',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Barat No. 05, Kel. Jelambar',
                'pekerjaan' => 'Tukang Parkir Pasar',
                'scores' => ['C1' => 1550000, 'C2' => 3, 'C3' => 70, 'C4' => 450],
            ],
            [
                'user_email' => 'endang@gmail.com',
                'no_kk' => '3173020101010014',
                'nik' => '3173026111780014',
                'nama_warga' => 'Ibu Endang',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 02, Kel. Jelambar',
                'pekerjaan' => 'Pembuat Kerupuk Rumahan',
                'scores' => ['C1' => 1700000, 'C2' => 4, 'C3' => 68, 'C4' => 450],
            ],
            [
                'user_email' => 'slamet@gmail.com',
                'no_kk' => '3173020101010015',
                'nik' => '3173021201700015',
                'nama_warga' => 'Pak Slamet',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 09, Kel. Jelambar',
                'pekerjaan' => 'Tukang Servis Elektronik',
                'scores' => ['C1' => 1750000, 'C2' => 3, 'C3' => 65, 'C4' => 900],
            ],

            // --- 10 DATA BELUM LAYAK / TIDAK LULUS (RANK 16 - 25) ---
            [
                'user_email' => 'joko@gmail.com',
                'no_kk' => '3173020101010016',
                'nik' => '3173021201700016',
                'nama_warga' => 'Pak Joko Widodo',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 33, Kel. Jelambar',
                'pekerjaan' => 'Tukang Kayu Perabot',
                'scores' => ['C1' => 2000000, 'C2' => 2, 'C3' => 60, 'C4' => 900],
            ],
            [
                'user_email' => 'aminah@gmail.com',
                'no_kk' => '3173020101010017',
                'nik' => '3173026111780017',
                'nama_warga' => 'Ibu Aminah',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Selatan No. 12, Kel. Jelambar',
                'pekerjaan' => 'Penjual Nasi Uduk',
                'scores' => ['C1' => 2200000, 'C2' => 3, 'C3' => 58, 'C4' => 900],
            ],
            [
                'user_email' => 'budi@gmail.com',
                'no_kk' => '3173020101010018',
                'nik' => '3173021201700018',
                'nama_warga' => 'Pak Budi Santoso',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Barat No. 15, Kel. Jelambar',
                'pekerjaan' => 'Supir Angkot Harian',
                'scores' => ['C1' => 2500000, 'C2' => 2, 'C3' => 55, 'C4' => 900],
            ],
            [
                'user_email' => 'kartini@gmail.com',
                'no_kk' => '3173020101010019',
                'nik' => '3173026111780019',
                'nama_warga' => 'Ibu Kartini',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 22, Kel. Jelambar',
                'pekerjaan' => 'Penjual Baju Keliling',
                'scores' => ['C1' => 2800000, 'C2' => 2, 'C3' => 52, 'C4' => 900],
            ],
            [
                'user_email' => 'agus@gmail.com',
                'no_kk' => '3173020101010020',
                'nik' => '3173021201700020',
                'nama_warga' => 'Pak Agus Prasetyo',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 19, Kel. Jelambar',
                'pekerjaan' => 'Satpam Kompleks',
                'scores' => ['C1' => 3000000, 'C2' => 2, 'C3' => 50, 'C4' => 900],
            ],
            [
                'user_email' => 'bambang@gmail.com',
                'no_kk' => '3173020101010021',
                'nik' => '3173021905820021',
                'nama_warga' => 'Pak Bambang',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Selatan No. 08, Kel. Jelambar',
                'pekerjaan' => 'Karyawan Swasta Pabrik',
                'scores' => ['C1' => 3500000, 'C2' => 2, 'C3' => 45, 'C4' => 1300],
            ],
            [
                'user_email' => 'dedi@gmail.com',
                'no_kk' => '3173020101010022',
                'nik' => '3173021201700022',
                'nama_warga' => 'Pak Dedi Susanto',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Barat No. 60, Kel. Jelambar',
                'pekerjaan' => 'Supervisor Minimarket',
                'scores' => ['C1' => 4000000, 'C2' => 1, 'C3' => 35, 'C4' => 1300],
            ],
            [
                'user_email' => 'supatmi@gmail.com',
                'no_kk' => '3173020101010023',
                'nik' => '3173026111780023',
                'nama_warga' => 'Ibu Supatmi',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 65, Kel. Jelambar',
                'pekerjaan' => 'PNS Guru Sekolah',
                'scores' => ['C1' => 4800000, 'C2' => 1, 'C3' => 25, 'C4' => 1300],
            ],
            [
                'user_email' => 'sutarman@gmail.com',
                'no_kk' => '3173020101010024',
                'nik' => '3173021201700024',
                'nama_warga' => 'Pak Sutarman',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Jelambar Utama No. 60, Kel. Jelambar',
                'pekerjaan' => 'Manager Toko',
                'scores' => ['C1' => 5200000, 'C2' => 1, 'C3' => 20, 'C4' => 2200],
            ],
            [
                'user_email' => 'hendra@gmail.com',
                'no_kk' => '3173020101010025',
                'nik' => '3173021201700025',
                'nama_warga' => 'Pak Hendra Gunawan',
                'rt_rw' => 'RT 011 / RW 04',
                'alamat' => 'Jl. Hadiah No. 75, Kel. Jelambar',
                'pekerjaan' => 'Wiraswasta Agen Sembako',
                'scores' => ['C1' => 5800000, 'C2' => 1, 'C3' => 10, 'C4' => 2200],
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
                            'alternatif_id' => $alternatif->id,
                            'kriteria_id' => $kriteriaModels[$kodeKriteria]->id,
                        ],
                        ['nilai' => $nilai]
                    );
                }
            }
        }
    }
}
