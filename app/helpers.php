<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Helper to retrieve or interact with system settings.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed|Setting
     */
    function setting(?string $key = null, $default = null)
    {
        if (is_null($key)) {
            return new Setting();
        }
        return Setting::get($key, $default);
    }
}
