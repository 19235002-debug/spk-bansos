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
            ['name' => 'Pak Ridwan', 'email' => 'ridwan@gmail.com'],
            ['name' => 'Ibu Mutiara', 'email' => 'mutiara@gmail.com'],
            ['name' => 'Ibu Maimunah', 'email' => 'maimunah@gmail.com'],
            ['name' => 'Ibu Ratna', 'email' => 'ratna@gmail.com'],
            ['name' => 'Bang Fikri', 'email' => 'fikri@gmail.com'],
            ['name' => 'Ibu Rina', 'email' => 'rina@gmail.com'],
            ['name' => 'Bang Syahrul', 'email' => 'syahrul@gmail.com'],
            ['name' => 'Ibu Syifa', 'email' => 'syifa@gmail.com'],
            ['name' => 'Pak Farhan', 'email' => 'farhan@gmail.com'],
            ['name' => 'Ibu Nadia', 'email' => 'nadia@gmail.com'],
            ['name' => 'Bang Andre', 'email' => 'andre@gmail.com'],
            ['name' => 'Ibu Rohaye', 'email' => 'rohaye@gmail.com'],
            ['name' => 'Bang Reza', 'email' => 'reza@gmail.com'],
            ['name' => 'Ibu Melati', 'email' => 'melati@gmail.com'],
            ['name' => 'Pak Tommy', 'email' => 'tommy@gmail.com'],
            ['name' => 'Pak Dimas', 'email' => 'dimas@gmail.com'],
            ['name' => 'Ibu Citra', 'email' => 'citra@gmail.com'],
            ['name' => 'Pak Kevin', 'email' => 'kevin@gmail.com'],
            ['name' => 'Ibu Amanda', 'email' => 'amanda@gmail.com'],
            ['name' => 'Pak Faisal', 'email' => 'faisal@gmail.com'],
            ['name' => 'Bang Randy', 'email' => 'randy@gmail.com'],
            ['name' => 'Pak Irfan', 'email' => 'irfan@gmail.com'],
            ['name' => 'Ibu Maya', 'email' => 'maya@gmail.com'],
            ['name' => 'Pak David', 'email' => 'david@gmail.com'],
            ['name' => 'Pak Hendra', 'email' => 'hendra@gmail.com'],
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
