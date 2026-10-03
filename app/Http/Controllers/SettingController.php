<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display the general settings form.
     */
    public function index()
    {
        $settings = [
            'app_name' => Setting::get('app_name', 'SPK Bansos RT'),
            'app_tagline' => Setting::get('app_tagline', 'PORTAL SELEKSI BANSOS RT 011 / RW 04'),
            'institution_name' => Setting::get('institution_name', 'Pengurus RT 011 / RW 04 Jelambar'),
            'address' => Setting::get('address', 'Jl. Jelambar Utama RT 011 / RW 04, Grogol Petamburan, Jakarta Barat'),
            'footer_text' => Setting::get('footer_text', 'SPK Bansos RT 011 / RW 04 Jelambar • Developed with Laravel & Tailwind'),
            'favicon' => Setting::get('favicon'),
            'app_logo' => Setting::get('app_logo'),
            'stempel_rt' => Setting::get('stempel_rt'),
            'contact_email' => Setting::get('contact_email', 'admin@jelambar-rt011.id'),
            'contact_phone' => Setting::get('contact_phone', '0812-3456-7890'),
        ];

        return view('settings.index', compact('settings'));
    }

    /**
     * Update general settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_tagline' => 'nullable|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'footer_text' => 'nullable|string|max:500',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,svg|max:2048',
            'app_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'stempel_rt' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ]);

        // Text settings update
        $textFields = ['app_name', 'app_tagline', 'institution_name', 'address', 'footer_text', 'contact_email', 'contact_phone'];
        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        // Upload directory
        $uploadPath = public_path('uploads/settings');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        // Handle Favicon upload
        if ($request->hasFile('favicon')) {
            $file = $request->file('favicon');
            $filename = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            // Delete old file if exists
            $oldFavicon = Setting::get('favicon');
            if ($oldFavicon && File::exists(public_path($oldFavicon))) {
                File::delete(public_path($oldFavicon));
            }

            Setting::set('favicon', 'uploads/settings/' . $filename);
        }

        // Handle App Logo upload
        if ($request->hasFile('app_logo')) {
            $file = $request->file('app_logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            // Delete old file if exists
            $oldLogo = Setting::get('app_logo');
            if ($oldLogo && File::exists(public_path($oldLogo))) {
                File::delete(public_path($oldLogo));
            }

            Setting::set('app_logo', 'uploads/settings/' . $filename);
        }

        // Handle Stempel RT upload
        if ($request->hasFile('stempel_rt')) {
            $file = $request->file('stempel_rt');
            $filename = 'stempel_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            // Delete old file if exists
            $oldStempel = Setting::get('stempel_rt');
            if ($oldStempel && File::exists(public_path($oldStempel))) {
                File::delete(public_path($oldStempel));
            }

            Setting::set('stempel_rt', 'uploads/settings/' . $filename);
        }

        return redirect()->route('settings.index')->with('success', 'Pengaturan umum sistem berhasil diperbarui!');
    }

    /**
     * Reset settings to default.
     */
    public function reset()
    {
        Setting::set('app_name', 'SPK Bansos RT');
        Setting::set('app_tagline', 'PORTAL SELEKSI BANSOS RT 011 / RW 04');
        Setting::set('institution_name', 'Pengurus RT 011 / RW 04 Jelambar');
        Setting::set('address', 'Jl. Jelambar Utama RT 011 / RW 04, Grogol Petamburan, Jakarta Barat');
        Setting::set('footer_text', 'SPK Bansos RT 011 / RW 04 Jelambar • Developed with Laravel & Tailwind');
        Setting::set('contact_email', 'admin@jelambar-rt011.id');
        Setting::set('contact_phone', '0812-3456-7890');

        return redirect()->route('settings.index')->with('success', 'Pengaturan sistem berhasil dikembalikan ke standar awal.');
    }
}
