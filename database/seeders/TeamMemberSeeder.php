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
        TeamMember::truncate();

        $teamMembers = [
            [
                'nama' => 'Guntur Arya Suta',
                'nim' => '19235002',
                'peran' => 'Project Manager & Lead Developer',
                'email' => '19235002@bsi.ac.id',
                'tugas' => 'Bertanggung jawab mengelola perancangan sistem, alur kerja tim, dan mengimplementasikan aplikasi SPK Bansos berbasis Laravel & metode SAW.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 1,
            ],
            [
                'nama' => 'Hafiz Rahmad Putra',
                'nim' => '19235159',
                'peran' => 'System Analyst & Database Designer',
                'email' => '19235159@bsi.ac.id',
                'tugas' => 'Menganalisis kebutuhan kriteria bansos, alur bisnis kependudukan, serta merancang skema basis data dan ERD/LRS.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 2,
            ],
            [
                'nama' => 'Windy Naila Azahra',
                'nim' => '19235139',
                'peran' => 'Tester / Quality Assurance',
                'email' => '19235139@gmail.com',
                'tugas' => 'Menguji seluruh fungsionalitas sistem, validasi skoring kriteria, dan presisi hasil perangkingan metode SAW.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 3,
            ],
            [
                'nama' => 'Danii Izzuddin',
                'nim' => '19235131',
                'peran' => 'Documentation & Support',
                'email' => '19235131@bsi.ac.id',
                'tugas' => 'Menyusun dokumentasi sistem, panduan penggunaan untuk admin dan warga, serta mendukung operasional implementasi.',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'urutan' => 4,
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
