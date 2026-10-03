<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed User accounts (Admin RT & 25 Akun Warga).
     */
    public function run(): void
    {
        // 1. Admin RT User
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Pengurus RT (Admin SPK)',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. 25 Warga User Accounts
        $wargaUsers = [
            ['name' => 'Pak Suparno', 'email' => 'suparno@gmail.com'],
            ['name' => 'Ibu Sumarni', 'email' => 'sumarni@gmail.com'],
            ['name' => 'Ibu Maimunah', 'email' => 'maimunah@gmail.com'],
            ['name' => 'Ibu Ratna', 'email' => 'ratna@gmail.com'],
            ['name' => 'Pak Wagiman', 'email' => 'wagiman@gmail.com'],
            ['name' => 'Ibu Marsini', 'email' => 'marsini@gmail.com'],
            ['name' => 'Pak Karsiyo', 'email' => 'karsiyo@gmail.com'],
            ['name' => 'Ibu Sutarni', 'email' => 'sutarni@gmail.com'],
            ['name' => 'Pak Parijo', 'email' => 'parijo@gmail.com'],
            ['name' => 'Ibu Ningsih', 'email' => 'ningsih@gmail.com'],
            ['name' => 'Pak Hartono', 'email' => 'hartono@gmail.com'],
            ['name' => 'Ibu Rohaye', 'email' => 'rohaye@gmail.com'],
            ['name' => 'Pak Sugeng', 'email' => 'sugeng@gmail.com'],
            ['name' => 'Ibu Endang', 'email' => 'endang@gmail.com'],
            ['name' => 'Pak Slamet', 'email' => 'slamet@gmail.com'],
            ['name' => 'Pak Joko Widodo', 'email' => 'joko@gmail.com'],
            ['name' => 'Ibu Aminah', 'email' => 'aminah@gmail.com'],
            ['name' => 'Pak Budi Santoso', 'email' => 'budi@gmail.com'],
            ['name' => 'Ibu Kartini', 'email' => 'kartini@gmail.com'],
            ['name' => 'Pak Agus Prasetyo', 'email' => 'agus@gmail.com'],
            ['name' => 'Pak Bambang', 'email' => 'bambang@gmail.com'],
            ['name' => 'Pak Dedi Susanto', 'email' => 'dedi@gmail.com'],
            ['name' => 'Ibu Supatmi', 'email' => 'supatmi@gmail.com'],
            ['name' => 'Pak Sutarman', 'email' => 'sutarman@gmail.com'],
            ['name' => 'Pak Hendra Gunawan', 'email' => 'hendra@gmail.com'],
        ];

        foreach ($wargaUsers as $u) {
            User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password'),
                    'role' => 'warga', // Role user warga
                ]
            );
        }
    }
}
