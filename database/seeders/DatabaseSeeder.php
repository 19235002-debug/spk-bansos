<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database for SPK BANSOS RT.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KriteriaSeeder::class,
            WargaSeeder::class,
            TeamMemberSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
