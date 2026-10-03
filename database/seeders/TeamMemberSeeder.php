<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Seed IT Development Team Members.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'nama' => 'Budi Pratama',
                'nim' => '220101001',
                'peran' => 'Project Manager',
                'email' => 'budi.pm@dev.id',
                'tugas' => 'Bertanggung jawab mengelola perencanaan, jadwal, dan koordinasi tim pengembang SPK Bansos.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 1,
            ],
            [
                'nama' => 'Siti Rahmawati',
                'nim' => '220101002',
                'peran' => 'System Analyst',
                'email' => 'siti.analyst@dev.id',
                'tugas' => 'Menganalisis kebutuhan pengguna tingkat RT dan merancang spesifikasi sistem SPK Bansos.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 2,
            ],
            [
                'nama' => 'Ahmad Fauzi',
                'nim' => '220101003',
                'peran' => 'Programmer / Developer',
                'email' => 'ahmad.dev@dev.id',
                'tugas' => 'Mengimplementasikan sistem SPK Bansos berbasis Laravel dan kalkulasi metode SAW sesuai desain.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 3,
            ],
            [
                'nama' => 'Dimas Permana',
                'nim' => '220101004',
                'peran' => 'Database Designer',
                'email' => 'dimas.db@dev.id',
                'tugas' => 'Merancang dan mengelola basis data warga, kriteria, penilaian, serta relasi sistem.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 4,
            ],
            [
                'nama' => 'Eka Putri',
                'nim' => '220101005',
                'peran' => 'Tester / Quality Assurance',
                'email' => 'eka.qa@dev.id',
                'tugas' => 'Menguji sistem secara menyeluruh untuk memastikan kualitas, keandalan fungsionalitas, dan presisi angka SAW.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 5,
            ],
            [
                'nama' => 'Rian Hidayat',
                'nim' => '220101006',
                'peran' => 'Documentation & Support',
                'email' => 'rian.docs@dev.id',
                'tugas' => 'Menyusun dokumentasi teknis, petunjuk penggunaan pengguna, dan mendukung implementasi sistem.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 6,
            ],
        ];

        foreach ($teamMembers as $tm) {
            TeamMember::updateOrCreate(
                ['nim' => $tm['nim']],
                $tm
            );
        }
    }
}
