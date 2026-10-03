<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Warga;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        $kriteriaList = Kriteria::all();
        $totalAlternatif = Warga::count();

        return view('dokumentasi.index', compact('kriteriaList', 'totalAlternatif'));
    }
}
