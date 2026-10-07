<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Penilaian Calon Penerima Bansos
            </h2>
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Info card for Criteria guide -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($kriteria as $k)
                    <div class="p-4 bg-white rounded-xl border border-slate-200 shadow-xs flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-0.5 bg-indigo-50 border border-indigo-100 rounded text-xs font-mono font-bold text-indigo-700">{{ $k->kode_kriteria }}</span>
                            <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded {{ $k->tipe == 'benefit' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ $k->tipe }}
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-800 text-sm mt-2">{{ $k->nama_kriteria }}</h4>
                        <div class="mt-2 text-xs text-slate-500 space-y-0.5">
                            <div>Bobot: <strong class="text-slate-800">{{ $k->bobot }} ({{ $k->bobot * 100 }}%)</strong></div>
                            <div class="text-[11px] font-semibold text-indigo-600">
                                @if($k->kode_kriteria == 'C1')
                                    Skala: Format Rupiah (Rp)
                                @elseif($k->kode_kriteria == 'C2')
                                    Skala: Tanggungan (0 Jiwa atau lebih)
                                @elseif($k->kode_kriteria == 'C3')
                                    Skala: 1 - 5 (1: Sangat Baik, 5: Sangat Memprihatinkan)
                                @elseif($k->kode_kriteria == 'C4')
                                    Skala: Daya Listrik (VA)
                                @else
                                    Skala: Angka
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Form Matrix input -->
            <form action="{{ route('penilaian.updateBatch') }}" method="POST" x-data="{ search: '' }">
                @csrf
                <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Formulir Input / Update Matriks Keputusan Awal</h3>
                            <p class="text-xs text-slate-500 mt-1">Isikan nilai kriteria masing-masing warga. Setelah selesai, klik Simpan Nilai Matriks.</p>
                        </div>
                        <div class="relative w-full sm:w-64">
                            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" 
                                   x-model="search" 
                                   placeholder="Cari NIK / Nama Warga..." 
                                   class="w-full ps-9 pe-3 py-2 text-xs rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 transition">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs text-left text-slate-600 border-collapse">
                            <thead class="text-xs text-slate-700 bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="px-2 py-3 text-center w-10">No</th>
                                    <th class="px-2.5 py-3 w-32">NIK</th>
                                    <th class="px-2.5 py-3 min-w-[110px]">Nama Warga</th>
                                    @foreach($kriteria as $k)
                                        <th class="px-2 py-3 text-center">
                                            <div class="inline-block px-1.5 py-0.5 bg-indigo-50 border border-indigo-100 rounded text-[11px] font-mono font-bold text-indigo-700">{{ $k->kode_kriteria }}</div>
                                            <div class="font-bold text-slate-800 text-xs mt-1 leading-tight max-w-[140px] mx-auto">{{ $k->nama_kriteria }}</div>
                                            <div class="text-[10px] text-slate-400 font-normal uppercase mt-0.5">
                                                {{ $k->tipe }} | {{ $k->bobot }}
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 align-middle">
                                @forelse($alternatif as $index => $alt)
                                    <tr class="hover:bg-slate-50/80 transition"
                                        x-show="!search || '{{ strtolower($alt->nik . ' ' . $alt->nama_warga) }}'.includes(search.toLowerCase())">
                                        <td class="px-2 py-2 text-center font-bold text-slate-500 text-xs">{{ ($alternatif->currentPage() - 1) * $alternatif->perPage() + $index + 1 }}</td>
                                        <td class="px-2.5 py-2 font-mono font-bold text-slate-800 text-xs whitespace-nowrap">{{ $alt->nik }}</td>
                                        <td class="px-2.5 py-2 font-bold text-slate-900 text-xs">{{ $alt->nama_warga }}</td>

                                        @foreach($kriteria as $k)
                                            @php
                                                $currentVal = $penilaianMatrix[$alt->id][$k->id] ?? 0;
                                            @endphp
                                            <td class="px-2 py-2 text-center align-middle">
                                                @if($k->kode_kriteria == 'C1')
                                                    @php
                                                        $formattedVal = old('nilai.'.$alt->id.'.'.$k->id, $currentVal > 0 ? number_format($currentVal, 0, ',', '.') : '');
                                                    @endphp
                                                    <div class="relative flex items-center justify-center max-w-[135px] mx-auto">
                                                        <span class="absolute left-2.5 text-[11px] font-bold text-slate-400 pointer-events-none">Rp</span>
                                                        <input type="text" 
                                                               name="nilai[{{ $alt->id }}][{{ $k->id }}]" 
                                                               value="{{ $formattedVal }}" 
                                                               placeholder="2.500.000" 
                                                               oninput="formatRupiahInput(this)"
                                                               class="w-full ps-8 pe-2.5 py-1.5 text-right rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-xs font-mono font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal placeholder:opacity-60" 
                                                               required>
                                                    </div>
                                                @elseif($k->kode_kriteria == 'C2')
                                                    <div class="max-w-[70px] mx-auto">
                                                        <input type="number" 
                                                               step="1"
                                                               min="0"
                                                               name="nilai[{{ $alt->id }}][{{ $k->id }}]" 
                                                               value="{{ old('nilai.'.$alt->id.'.'.$k->id, $currentVal >= 0 ? (int)$currentVal : '') }}" 
                                                               placeholder="0"
                                                               class="w-full text-center py-1.5 placeholder:text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-xs font-mono font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal placeholder:opacity-60" 
                                                               required>
                                                    </div>
                                                @elseif($k->kode_kriteria == 'C3')
                                                    <div class="mx-auto" style="min-width: 230px; width: 230px;">
                                                        <select name="nilai[{{ $alt->id }}][{{ $k->id }}]" 
                                                                style="min-width: 230px; width: 230px;"
                                                                class="w-full text-[11px] py-1.5 ps-2.5 pe-6 font-bold text-slate-800 rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 whitespace-nowrap" 
                                                                required>
                                                            <option value="1" {{ (int)$currentVal == 1 ? 'selected' : '' }}>1 - Sangat Baik</option>
                                                            <option value="2" {{ (int)$currentVal == 2 ? 'selected' : '' }}>2 - Baik</option>
                                                            <option value="3" {{ (int)$currentVal == 3 ? 'selected' : '' }}>3 - Cukup</option>
                                                            <option value="4" {{ (int)$currentVal == 4 ? 'selected' : '' }}>4 - Memprihatinkan</option>
                                                            <option value="5" {{ (int)$currentVal == 5 ? 'selected' : '' }}>5 - Sangat Memprihatinkan</option>
                                                        </select>
                                                    </div>
                                                @elseif($k->kode_kriteria == 'C4')
                                                    <div class="max-w-[85px] mx-auto">
                                                        <input type="number" 
                                                               step="1"
                                                               min="0"
                                                               name="nilai[{{ $alt->id }}][{{ $k->id }}]" 
                                                               value="{{ old('nilai.'.$alt->id.'.'.$k->id, $currentVal >= 0 ? (int)$currentVal : '') }}" 
                                                               placeholder="450"
                                                               class="w-full text-center py-1.5 placeholder:text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-xs font-mono font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal placeholder:opacity-60" 
                                                               required>
                                                    </div>
                                                @else
                                                    <div class="max-w-[85px] mx-auto">
                                                        <input type="number" 
                                                               step="any"
                                                               min="0"
                                                               name="nilai[{{ $alt->id }}][{{ $k->id }}]" 
                                                               value="{{ old('nilai.'.$alt->id.'.'.$k->id, $currentVal) }}" 
                                                               class="w-full text-center py-1.5 placeholder:text-center [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-xs font-mono font-bold text-slate-800 placeholder:text-slate-300 placeholder:font-normal placeholder:opacity-60" 
                                                               required>
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($kriteria) + 3 }}" class="px-6 py-8 text-center text-slate-400">
                                            Belum ada data warga. Silakan input data warga terlebih dahulu.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(count($alternatif) > 0)
                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md transition whitespace-nowrap">
                                Simpan Semua Nilai Matriks
                            </button>
                            <div>
                                {{ $alternatif->links('partials.pagination') }}
                            </div>
                        </div>
                    @endif
                </div>
            </form>

        </div>
    </div>

    <script>
        function formatRupiahInput(input) {
            let value = input.value.replace(/[^0-9]/g, '');
            if (value) {
                input.value = new Intl.NumberFormat('id-ID').format(parseInt(value, 10));
            } else {
                input.value = '';
            }
        }

        function formatIpkInput(input) {
            let val = input.value.replace(/,/g, '.');
            val = val.replace(/[^0-9.]/g, '');
            let parts = val.split('.');
            if (parts.length > 2) {
                val = parts[0] + '.' + parts.slice(1).join('');
            }
            if (parts.length === 2 && parts[1].length > 2) {
                val = parts[0] + '.' + parts[1].substring(0, 2);
            }
            let num = parseFloat(val);
            if (!isNaN(num) && num > 4.00) {
                val = '4.00';
            }
            input.value = val;
        }
    </script>
</x-app-layout>
