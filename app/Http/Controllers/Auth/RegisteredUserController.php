<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warga;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     * Smart NIK linking: If Admin already created the NIK, link it to the new user automatically!
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'nik' => ['nullable', 'string', 'max:30'],
            'nim' => ['nullable', 'string', 'max:30'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $nikInput = $request->input('nik') ?? $request->input('nim');

        if ($nikInput) {
            $existingAlt = Warga::where('nik', $nikInput)->first();
            if ($existingAlt && $existingAlt->user_id) {
                throw ValidationException::withMessages([
                    'nik' => 'NIK ini sudah terhubung dengan akun pengguna lain.',
                ]);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'warga',
        ]);

        if ($nikInput) {
            $existingAlt = Warga::where('nik', $nikInput)->first();

            if ($existingAlt) {
                // Link user to pre-seeded/admin-created Warga
                $existingAlt->update([
                    'user_id' => $user->id,
                    'nama_warga' => $request->name,
                ]);
                $alt = $existingAlt;
            } else {
                // Create new Warga record
                $alt = Warga::create([
                    'user_id' => $user->id,
                    'nik' => $nikInput,
                    'nama_warga' => $request->name,
                    'rt_rw' => 'RT 011/04',
                ]);
            }

            // Auto-initialize default 0 scores for missing criteria
            $kriteriaList = Kriteria::all();
            foreach ($kriteriaList as $k) {
                Penilaian::firstOrCreate([
                    'warga_id' => $alt->id,
                    'kriteria_id' => $k->id,
                ], [
                    'nilai' => 0,
                ]);
            }
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false))->with('success', 'Selamat datang! Akun Warga dan NIK Anda berhasil terdaftar.');
    }
}
