<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SawService;
use App\Models\Warga;

class PerhitunganController extends Controller
{
    public function index(SawService $sawService)
    {
        $sawData = $sawService->calculate();

        return view('perhitungan.index', compact('sawData'));
    }

    public function cetak(SawService $sawService)
    {
        $sawData = $sawService->calculate();

        return view('perhitungan.cetak', compact('sawData'));
    }

    public function cetakWarga(Request $request, SawService $sawService)
    {
        $user = $request->user();
        $alternatif = Warga::where('user_id', $user->id)->firstOrFail();
        $sawData = $sawService->calculate();

        $userRank = null;
        foreach ($sawData['ranking'] as $item) {
            $itemId = $item['warga_id'] ?? $item['alternatif_id'] ?? null;
            if ($itemId == $alternatif->id) {
                $userRank = $item;
                break;
            }
        }

        return view('perhitungan.cetak-warga', compact('alternatif', 'userRank', 'sawData'));
    }
}
