<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index()
    {
        $alternatif = Warga::with('user')->orderBy('nik')->paginate(5);
        $totalWarga = Warga::count();
        return view('warga.index', compact('alternatif', 'totalWarga'));
    }

    public function create()
    {
        $users = User::whereIn('role', ['warga', 'mahasiswa']) // Role user warga
            ->whereDoesntHave('alternatif')
            ->get();
            
        return view('warga.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'nullable|string|max:30',
            'nik' => 'required|string|max:30|unique:alternatif,nik',
            'nama_warga' => 'required|string|max:255',
            'rt_rw' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'create_user' => 'nullable|boolean',
            'email' => 'nullable|required_if:create_user,1|email|unique:users,email',
        ], [
            'nik.required' => 'NIK (Nomor Induk Kependudukan) wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_warga.required' => 'Nama Warga wajib diisi.',
        ]);

        $userId = $request->user_id;

        // Auto create user account
        if ($request->boolean('create_user') && $request->email) {
            $user = User::create([
                'name' => $request->nama_warga,
                'email' => $request->email,
                'password' => Hash::make('password123'),
                'role' => 'warga', // role user warga
            ]);
            $userId = $user->id;
        }

        $alt = Warga::create([
            'user_id' => $userId,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama_warga' => $request->nama_warga,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
        ]);

        // Auto-initialize default 0 scores for existing criteria
        $kriteriaList = Kriteria::all();
        foreach ($kriteriaList as $k) {
            Penilaian::firstOrCreate([
                'alternatif_id' => $alt->id,
                'kriteria_id' => $k->id,
            ], [
                'nilai' => 0,
            ]);
        }

        return redirect()->route('warga.index')->with('success', 'Data Calon Penerima Bansos (Warga) berhasil ditambahkan.');
    }

    public function edit(Warga $warga)
    {
        $users = User::whereIn('role', ['warga', 'mahasiswa'])
            ->where(function ($query) use ($warga) {
                $query->whereDoesntHave('alternatif')
                      ->orWhere('id', $warga->user_id);
            })
            ->get();

        return view('warga.edit', [
            'alternatif' => $warga,
            'users' => $users
        ]);
    }

    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'no_kk' => 'nullable|string|max:30',
            'nik' => 'required|string|max:30|unique:alternatif,nik,' . $warga->id,
            'nama_warga' => 'required|string|max:255',
            'rt_rw' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'pekerjaan' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'password' => 'nullable|string|min:6',
            'create_user' => 'nullable|boolean',
            'email' => 'nullable|required_if:create_user,1|email|unique:users,email',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nama_warga.required' => 'Nama Warga wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'email.unique' => 'Email sudah digunakan oleh user lain.',
        ]);

        $userId = $request->user_id;

        // If admin opted to create a new user account while editing
        if (!$userId && $request->boolean('create_user') && $request->email) {
            $userPassword = $request->filled('password') ? $request->password : 'password123';
            $user = User::create([
                'name' => $request->nama_warga,
                'email' => $request->email,
                'password' => Hash::make($userPassword),
                'role' => 'warga',
            ]);
            $userId = $user->id;
        }

        $warga->update([
            'user_id' => $userId,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama_warga' => $request->nama_warga,
            'rt_rw' => $request->rt_rw,
            'alamat' => $request->alamat,
            'pekerjaan' => $request->pekerjaan,
        ]);

        // If password provided and user is linked, update user password
        if ($request->filled('password') && $userId) {
            $user = User::find($userId);
            if ($user) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }
        }

        return redirect()->route('warga.index')->with('success', 'Data Warga dan akun login berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        $warga->delete();
        return redirect()->route('warga.index')->with('success', 'Data Warga berhasil dihapus.');
    }
}
