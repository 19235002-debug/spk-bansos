<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode_kriteria')->get();
        $totalBobot = $kriteria->sum('bobot');
        return view('kriteria.index', compact('kriteria', 'totalBobot'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:10|unique:kriteria,kode_kriteria',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01|max:1.0',
            'tipe' => 'required|in:benefit,cost',
        ], [
            'kode_kriteria.required' => 'Kode kriteria wajib diisi.',
            'kode_kriteria.unique' => 'Kode kriteria sudah ada.',
            'nama_kriteria.required' => 'Nama kriteria wajib diisi.',
            'bobot.required' => 'Bobot wajib diisi (contoh: 0.25).',
            'tipe.required' => 'Tipe kriteria wajib dipilih.',
        ]);

        Kriteria::create([
            'kode_kriteria' => strtoupper($request->kode_kriteria),
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:10|unique:kriteria,kode_kriteria,' . $kriteria->id,
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0.01|max:1.0',
            'tipe' => 'required|in:benefit,cost',
        ]);

        $kriteria->update([
            'kode_kriteria' => strtoupper($request->kode_kriteria),
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
