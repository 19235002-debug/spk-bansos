<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                @if(request()->routeIs('hasil.*'))
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pengumuman Hasil Seleksi Bansos RT
                @else
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Halaman Perhitungan SAW & Hasil Perangkingan
                @endif
            </h2>
            @if(Auth::user()->isAdmin())
                <a href="{{ route('perhitungan.cetak') }}" target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak / Print Laporan
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-8">

            @if(!request()->routeIs('hasil.*'))
            <!-- Formula Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6">
                <h3 class="text-base font-extrabold text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                    Landasan Rumus & Penjelasan Metode Simple Additive Weighting (SAW)
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
                    <div class="p-4 bg-emerald-50/70 rounded-2xl border border-emerald-200 space-y-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 font-extrabold text-[10px] uppercase tracking-wider">Tipe
                            Benefit</span>
                        <h4 class="font-extrabold text-emerald-900 text-sm">1. Normalisasi Benefit</h4>
                        <div
                            class="p-2.5 bg-white rounded-xl border border-emerald-200 text-center font-bold text-emerald-800 text-xs shadow-xs">
                            Nilai Normalisasi = Nilai Asli / Nilai Maksimum
                        </div>
                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Digunakan pada kriteria bertipe <strong>Benefit</strong> di mana nilai lebih tinggi lebih
                            diinginkan (Contoh: IPK, Prestasi, Keaktifan Organisasi).
                        </p>
                    </div>

                    <div class="p-4 bg-amber-50/70 rounded-2xl border border-amber-200 space-y-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 font-extrabold text-[10px] uppercase tracking-wider">Tipe
                            Cost</span>
                        <h4 class="font-extrabold text-amber-900 text-sm">2. Normalisasi Cost</h4>
                        <div
                            class="p-2.5 bg-white rounded-xl border border-amber-200 text-center font-bold text-amber-800 text-xs shadow-xs">
                            Nilai Normalisasi = Nilai Minimum / Nilai Asli
                        </div>
                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Digunakan pada kriteria bertipe <strong>Cost</strong> di mana nilai lebih rendah lebih
                            diprioritaskan (Contoh: Pendapatan Orang Tua).
                        </p>
                    </div>

                    <div class="p-4 bg-violet-50/70 rounded-2xl border border-violet-200 space-y-2">
                        <span
                            class="px-2.5 py-0.5 rounded-full bg-violet-100 text-violet-800 font-extrabold text-[10px] uppercase tracking-wider">Hasil
                            Akhir</span>
                        <h4 class="font-extrabold text-violet-900 text-sm">3. Skor Akhir Bansos</h4>
                        <div
                            class="p-2.5 bg-white rounded-xl border border-violet-200 text-center font-bold text-violet-800 text-xs shadow-xs">
                            Skor Akhir = Total (Bobot x Nilai Normalisasi)
                        </div>
                        <p class="text-[11px] text-slate-600 leading-relaxed">
                            Penjumlahan hasil perkalian bobot kriteria dengan nilai ternormalisasi untuk menentukan
                            peringkat utama penerima bansos.
                        </p>
                    </div>
                </div>
            </div>

            <!-- STEP 1: MATRIKS KEPUTUSAN AWAL -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">1. Matriks Keputusan Awal & Nilai Pembagi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Nilai awal kriteria warga sebelum dinormalisasi.
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-lg text-xs font-bold">Langkah 1</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs sm:text-sm text-left text-slate-600">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-100/70 border-b border-slate-200 font-bold tracking-wider">
                            <tr>
                                <th class="px-2 py-3 text-center whitespace-nowrap w-8">No</th>
                                <th class="px-2 py-3 whitespace-nowrap">No. KK</th>
                                <th class="px-2 py-3 whitespace-nowrap">NIK</th>
                                <th class="px-2 py-3">Nama Kepala Keluarga</th>
                                @foreach($sawData['kriteria'] as $k)
                                    <th class="px-2 py-3 text-center font-bold text-indigo-700">
                                        <div class="whitespace-nowrap">{{ $k->kode_kriteria }}</div>
                                        <div class="text-[11px] leading-tight font-extrabold text-indigo-900 mt-0.5">{{ $k->nama_kriteria }}</div>
                                        <div class="text-[10px] text-slate-500 font-normal uppercase mt-0.5 whitespace-nowrap">
                                            {{ $k->tipe }} | Bobot: {{ $k->bobot * 100 }}%
                                        </div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($sawData['alternatif'] as $index => $alt)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-2 py-2.5 text-center font-semibold text-slate-500 text-xs whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-2 py-2.5 font-mono font-bold text-indigo-600 text-xs whitespace-nowrap">{{ $alt->no_kk ?? '-' }}</td>
                                    <td class="px-2 py-2.5 font-mono font-bold text-slate-800 text-xs whitespace-nowrap">{{ $alt->nik }}</td>
                                    <td class="px-2 py-2.5 font-bold text-slate-800 text-xs">{{ $alt->nama_warga }}</td>
                                    @foreach($sawData['kriteria'] as $k)
                                        <td class="px-2 py-2.5 text-center font-mono text-slate-800 text-xs whitespace-nowrap">
                                            @php $val = $sawData['matrixX'][$alt->id][$k->id] ?? 0; @endphp
                                            @if($k->kode_kriteria == 'C1')
                                                Rp {{ number_format($val, 0, ',', '.') }}
                                            @elseif($k->kode_kriteria == 'C2')
                                                {{ (int)$val }} Jiwa
                                            @elseif($k->kode_kriteria == 'C3')
                                                <span class="font-bold font-mono">{{ (int)$val }}</span>
                                                <span class="text-[10px] block text-slate-500 font-sans">
                                                    @if((int)$val == 1) (Sangat Baik)
                                                    @elseif((int)$val == 2) (Baik)
                                                    @elseif((int)$val == 3) (Cukup)
                                                    @elseif((int)$val == 4) (Memprihatinkan)
                                                    @elseif((int)$val == 5) (Sangat Memprihatinkan)
                                                    @else (Skor {{ (int)$val }})
                                                    @endif
                                                </span>
                                            @elseif($k->kode_kriteria == 'C4')
                                                {{ (int)$val }} VA
                                            @else
                                                {{ number_format($val, 2) }}
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-indigo-50/50 font-bold border-t-2 border-indigo-100">
                            <tr>
                                <td colspan="4" class="px-2 py-2.5 text-right text-indigo-900 text-xs uppercase whitespace-nowrap">
                                    Nilai Pembagi (Max / Min):
                                </td>
                                @foreach($sawData['kriteria'] as $k)
                                    <td class="px-2 py-2.5 text-center font-mono text-indigo-700 text-xs whitespace-nowrap">
                                        @php $mm = $sawData['minMax'][$k->id] ?? 1; @endphp
                                        @if($k->kode_kriteria == 'C1')
                                            Rp {{ number_format($mm, 0, ',', '.') }} (Min)
                                        @elseif($k->kode_kriteria == 'C2')
                                            {{ (int)$mm }} (Max)
                                        @elseif($k->kode_kriteria == 'C3')
                                            {{ (int)$mm }} (Max)
                                        @elseif($k->kode_kriteria == 'C4')
                                            {{ (int)$mm }} (Min)
                                        @else
                                            {{ number_format($mm, 2) }} ({{ $k->tipe == 'cost' ? 'Min' : 'Max' }})
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- STEP 2: MATRIKS TERNORMALISASI -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">2. Matriks Ternormalisasi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Hasil transformasi nilai asli ke skala relatif 0 hingga 1.</p>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-lg text-xs font-bold">Langkah 2</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs sm:text-sm text-left text-slate-600">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-100/70 border-b border-slate-200 font-bold tracking-wider">
                            <tr>
                                <th class="px-2 py-3 text-center whitespace-nowrap w-8">No</th>
                                <th class="px-2 py-3 whitespace-nowrap">No. KK</th>
                                <th class="px-2 py-3 whitespace-nowrap">NIK</th>
                                <th class="px-2 py-3">Nama Kepala Keluarga</th>
                                @foreach($sawData['kriteria'] as $k)
                                    <th class="px-2 py-3 text-center font-bold text-emerald-700">
                                        <div class="whitespace-nowrap">Normalisasi {{ $k->kode_kriteria }}</div>
                                        <div class="text-[10px] text-slate-500 font-normal normal-case mt-0.5">{{ $k->nama_kriteria }}</div>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-mono">
                            @foreach($sawData['alternatif'] as $index => $alt)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-2 py-2.5 text-center font-semibold text-slate-500 font-sans text-xs whitespace-nowrap">
                                        {{ $index + 1 }}</td>
                                    <td class="px-2 py-2.5 font-bold text-emerald-700 font-mono text-xs whitespace-nowrap">{{ $alt->no_kk ?? '-' }}</td>
                                    <td class="px-2 py-2.5 font-bold text-slate-800 text-xs whitespace-nowrap">{{ $alt->nik }}</td>
                                    <td class="px-2 py-2.5 font-bold text-slate-800 font-sans text-xs">{{ $alt->nama_warga }}</td>
                                    @foreach($sawData['kriteria'] as $k)
                                        <td class="px-2 py-2.5 text-center font-bold text-emerald-600 text-xs whitespace-nowrap">
                                            {{ number_format($sawData['matrixR'][$alt->id][$k->id] ?? 0, 4) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- STEP 3: HASIL PERANGKINGAN -->
            <div class="bg-white rounded-2xl border border-indigo-100 shadow-md overflow-hidden">
                <div
                    class="p-6 border-b border-indigo-100 bg-gradient-to-r from-indigo-50 to-violet-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Hasil Akhir & Perangkingan Bansos
                        </h3>
                        <p class="text-xs text-slate-600 mt-0.5">Urutan warga berdasarkan skor preferensi dari yang
                            tertinggi hingga terendah.</p>
                    </div>
                    <span class="px-3.5 py-1.5 bg-indigo-600 text-white rounded-xl text-xs font-bold shadow-xs">Hasil
                        Final</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs sm:text-sm text-left text-slate-600">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200 font-bold tracking-wider">
                            <tr>
                                <th class="ps-4 pe-1 py-3 text-center whitespace-nowrap">Peringkat</th>
                                <th class="px-2 py-3 whitespace-nowrap">No. KK</th>
                                <th class="px-2 py-3 whitespace-nowrap">NIK</th>
                                <th class="px-2 py-3">Nama Kepala Keluarga</th>
                                <th class="px-2 py-3 whitespace-nowrap">RT / RW</th>
                                <th class="px-2 py-3 text-center whitespace-nowrap">Skor Akhir</th>
                                <th class="ps-1 pe-4 py-3 text-center whitespace-nowrap">Status Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($sawData['ranking'] as $item)
                                @php
                                    $isSelf = Auth::check() && isset($item['user_id']) && $item['user_id'] == Auth::id();
                                @endphp
                                <tr
                                    class="transition duration-150 {{ $isSelf ? 'bg-rose-100/80 hover:bg-rose-100 border-b-2 border-rose-300 font-bold text-slate-900 shadow-xs' : ($item['rank'] <= 10 ? 'bg-emerald-50/30 hover:bg-slate-50/80' : ($item['rank'] <= 15 ? 'bg-amber-50/30 hover:bg-slate-50/80' : 'hover:bg-slate-50/80')) }}">
                                    <td class="ps-4 pe-1 py-2.5 text-center font-bold">
                                        @if($item['rank'] == 1)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-amber-100 text-amber-900 font-black text-xs border border-amber-300 shadow-xs whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 me-1 text-amber-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg> Rank #1
                                            </span>
                                        @elseif($item['rank'] == 2)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-slate-200 text-slate-800 font-black text-xs border border-slate-300 shadow-xs whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 me-1 text-slate-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg> Rank #2
                                            </span>
                                        @elseif($item['rank'] == 3)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-orange-100 text-orange-900 font-black text-xs border border-orange-300 shadow-xs whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 me-1 text-orange-600" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg> Rank #3
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-full {{ $item['rank'] <= 10 ? 'bg-emerald-600 text-white font-black' : ($item['rank'] <= 15 ? 'bg-amber-500 text-white font-bold' : 'bg-slate-100 text-slate-700 font-bold') }} text-xs">#{{ $item['rank'] }}</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-2.5 font-mono font-bold text-indigo-600 text-xs whitespace-nowrap">{{ $item['no_kk'] ?? '-' }}</td>
                                    <td class="px-2 py-2.5 font-mono font-bold text-slate-800 text-xs whitespace-nowrap">{{ $item['nik'] ?? $item['nim'] ?? '-' }}</td>
                                    <td class="px-2 py-2.5 font-bold text-slate-800 text-xs">
                                        <span class="font-extrabold {{ $isSelf ? 'text-rose-950' : 'text-slate-900' }}">{{ $item['nama'] ?? $item['nama_warga'] ?? '-' }}</span>
                                    </td>
                                    <td class="px-2 py-2.5 text-slate-600 text-xs whitespace-nowrap">{{ $item['rt_rw'] ?? $item['prodi'] ?? '-' }}</td>
                                    <td class="px-2 py-2.5 text-center font-mono font-black text-indigo-700 text-xs sm:text-sm whitespace-nowrap">
                                        {{ number_format($item['score'], 4) }}
                                    </td>
                                    <td class="ps-1 pe-4 py-2.5 text-center whitespace-nowrap">
                                        @if($item['rank'] <= 10)
                                            <span
                                                class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-xs font-extrabold rounded-lg border border-emerald-300 inline-flex items-center gap-1 shadow-xs whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                Penerima (Lulus)
                                            </span>
                                        @elseif($item['rank'] <= 15)
                                            <span
                                                class="px-2 py-0.5 bg-amber-100 text-amber-900 text-xs font-bold rounded-lg border border-amber-300 inline-flex items-center gap-1 whitespace-nowrap">
                                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0"/></svg>
                                                Cadangan
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 bg-slate-100 text-slate-500 text-xs font-medium rounded-lg border border-slate-200 inline-flex items-center gap-1 whitespace-nowrap">
                                                Belum Layak
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-slate-400">
                                        Belum ada data perhitungan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>