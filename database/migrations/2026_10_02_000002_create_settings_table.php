<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert Default Settings
        $defaults = [
            ['key' => 'app_name', 'value' => 'SPK Bansos RT'],
            ['key' => 'app_tagline', 'value' => 'PORTAL SELEKSI BANSOS RT 011 / RW 04'],
            ['key' => 'institution_name', 'value' => 'Pengurus RT 011 / RW 04 Jelambar'],
            ['key' => 'footer_text', 'value' => 'SPK Bansos RT 011 / RW 04 Jelambar • Developed with Laravel & Tailwind'],
            ['key' => 'favicon', 'value' => null],
            ['key' => 'app_logo', 'value' => null],
            ['key' => 'contact_email', 'value' => 'admin@jelambar-rt011.id'],
            ['key' => 'contact_phone', 'value' => '0812-3456-7890'],
        ];

        foreach ($defaults as $item) {
            DB::table('settings')->insert([
                'key' => $item['key'],
                'value' => $item['value'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
