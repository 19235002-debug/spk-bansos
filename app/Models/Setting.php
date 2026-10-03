<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get setting value by key with optional fallback.
     */
    public static function get(string $key, $default = null)
    {
        try {
            return Cache::remember('setting_' . $key, 3600, function () use ($key, $default) {
                if (!Schema::hasTable('settings')) {
                    return $default;
                }
                $setting = static::where('key', $key)->first();
                return $setting ? $setting->value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Set or update setting value by key.
     */
    public static function set(string $key, $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('setting_' . $key);
    }
}
