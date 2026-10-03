<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Kelola Kriteria & Bobot Penilaian
            </h2>
            <a href="{{ route('kriteria.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Kriteria Baru
            </a>
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Weight Total Status Banner -->
            <div class="p-4 rounded-xl border {{ abs($totalBobot - 1.0) < 0.001 ? 'bg-indigo-50 border-indigo-200 text-indigo-900' : 'bg-amber-50 border-amber-200 text-amber-900' }} flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full {{ abs($totalBobot - 1.0) < 0.001 ? 'bg-indigo-600 text-white' : 'bg-amber-500 text-white' }} flex items-center justify-center font-bold shrink-0">
                        ∑
                    </div>
                    <div>
                        <h4 class="font-bold text-sm">Akumulasi Total Bobot Kriteria: <strong>{{ $totalBobot }}</strong> ({{ $totalBobot * 100 }}%)</h4>
                        <p class="text-xs opacity-90 mt-0.5">
                            @if(abs($totalBobot - 1.0) < 0.001)
                                Total bobot sudah bernilai 1.0 (100%). Syarat perhitungan SAW terpenuhi sempurna.
                            @else
                                Perhatian: Total bobot disarankan berjumlah 1.0 (100%) agar hasil ranking terstandarisasi.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kriteria Table Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="text-base font-bold text-slate-800">Daftar Kriteria Pemilihan Bantuan Sosial (Bansos)</h3>
                    <p class="text-xs text-slate-500 mt-1">Daftar parameter kriteria yang digunakan dalam penilaian bansos warga RT.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50/80 border-b border-slate-200 font-bold tracking-wider">
                            <tr>
                                <th class="ps-6 pe-2 py-3.5 text-center whitespace-nowrap w-10">No</th>
                                <th class="px-3 py-3.5 text-center whitespace-nowrap">Kode Kriteria</th>
                                <th class="px-3 py-3.5 whitespace-nowrap">Nama Kriteria</th>
                                <th class="px-3 py-3.5 text-center whitespace-nowrap">Nilai Bobot</th>
                                <th class="px-3 py-3.5 text-center whitespace-nowrap">Persentase</th>
                                <th class="px-3 py-3.5 text-center whitespace-nowrap">Tipe Kriteria</th>
                                <th class="ps-2 pe-6 py-3.5 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($kriteria as $index => $item)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="ps-6 pe-2 py-3.5 text-center font-bold text-slate-400 text-xs whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-3 py-3.5 text-center font-mono font-bold text-indigo-700 text-xs whitespace-nowrap">
                                        <span class="px-2 py-0.5 bg-indigo-50 border border-indigo-100 rounded-md">{{ $item->kode_kriteria }}</span>
                                    </td>
                                    <td class="px-3 py-3.5 font-bold text-slate-900 text-sm">{{ $item->nama_kriteria }}</td>
                                    <td class="px-3 py-3.5 text-center font-mono font-bold text-slate-800 text-xs whitespace-nowrap">{{ $item->bobot }}</td>
                                    <td class="px-3 py-3.5 text-center font-semibold text-slate-600 text-xs whitespace-nowrap">{{ $item->bobot * 100 }}%</td>
                                    <td class="px-3 py-3.5 text-center whitespace-nowrap">
                                        @if($item->tipe === 'benefit')
                                            <span class="px-2.5 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-md border border-emerald-200/80 inline-flex items-center gap-1.5 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Benefit (Keuntungan)
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 bg-amber-50 text-amber-800 text-xs font-bold rounded-md border border-amber-200/80 inline-flex items-center gap-1.5 whitespace-nowrap">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                Cost (Biaya)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="ps-2 pe-6 py-3.5 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <a href="{{ route('kriteria.edit', $item->id) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-slate-100 hover:bg-indigo-50 text-slate-700 hover:text-indigo-600 rounded-lg text-xs font-semibold transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" onsubmit="confirmDelete(event, this, 'Hapus Kriteria?', 'Kriteria ini akan dihapus dari parameter perhitungan SAW.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-semibold transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-slate-400">
                                        Belum ada data kriteria. Klik tombol "Tambah Kriteria Baru" di atas.
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
