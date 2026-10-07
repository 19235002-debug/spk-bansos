<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Seed Default System Settings for SPK Bansos RT 011 / RW 04 Jelambar.
     */
    public function run(): void
    {
        $defaultSettings = [
            'app_name' => 'SPK BANSOS RT 011/04',
            'app_tagline' => 'SISTEM SELEKSI PENERIMA BANTUAN SOSIAL RT 011/04 JELAMBAR',
            'app_description' => 'Sistem Pendukung Keputusan Seleksi Calon Penerima Bantuan Sosial Warga RT 011/04 Kelurahan Jelambar, Kecamatan Grogol Petamburan Menggunakan Metode Simple Additive Weighting (SAW).',
            'institution_name' => 'PENGURUS RT 011/04 KELURAHAN JELAMBAR',
            'address' => 'Kantor Pengurus RT 011/04, Kelurahan Jelambar, Kecamatan Grogol Petamburan, Jakarta Barat',
            'footer_text' => '© 2026 SPK Bansos RT 011/04 Jelambar, Grogol Petamburan. Hak Cipta Dilindungi Undang-Undang.',
            'contact_email' => 'admin@jelambar-rt011.id',
            'contact_phone' => '0812-3456-7890',
            'app_logo' => 'logo-universitas-bina-sarana-informatika-ubsi.png',
            'stempel_rt' => 'uploads/settings/stempel_default.svg',
        ];

        foreach ($defaultSettings as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $val]
            );
        }
    }
}
