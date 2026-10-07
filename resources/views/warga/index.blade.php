<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                Data Calon Penerima
            </h2>
            <a href="{{ route('warga.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl shadow-sm transition">
                <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Calon Penerima
            </a>
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Table Card -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden" x-data="{ search: '' }">
                <div
                    class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Daftar Calon Penerima Bansos</h3>
                        <p class="text-xs text-slate-500 mt-1">Data warga yang menjadi kandidat dalam proses seleksi menggunakan metode SAW.</p>
                    </div>
                    <div class="relative w-full sm:w-72">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" x-model="search" placeholder="Cari NIK, Nama, RT..."
                            class="w-full ps-9 pe-3 py-2 text-xs rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 transition">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs sm:text-sm text-left text-slate-600">
                        <thead
                            class="text-xs text-slate-700 uppercase bg-slate-50/80 border-b border-slate-200 font-bold tracking-wider">
                            <tr>
                                <th class="ps-4 pe-1 py-3 text-center whitespace-nowrap w-8">No</th>
                                <th class="px-2 py-3 whitespace-nowrap">No. KK</th>
                                <th class="px-2 py-3 whitespace-nowrap">NIK</th>
                                <th class="px-2 py-3">Nama Kepala Keluarga</th>
                                <th class="px-2 py-3 whitespace-nowrap">RT / RW</th>
                                <th class="px-2 py-3">Pekerjaan</th>
                                <th class="px-2 py-3 text-center whitespace-nowrap">Akun</th>
                                <th class="ps-1 pe-4 py-3 text-center whitespace-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($alternatif as $index => $item)
                                <tr class="hover:bg-slate-50/80 transition"
                                    x-show="!search || '{{ strtolower(($item->no_kk ?? '') . ' ' . $item->nik . ' ' . $item->nama_warga . ' ' . ($item->rt_rw ?? '') . ' ' . ($item->pekerjaan ?? '')) }}'.includes(search.toLowerCase())">
                                    <td
                                        class="ps-4 pe-1 py-3 text-center font-bold text-slate-400 text-xs whitespace-nowrap">
                                        {{ ($alternatif->currentPage() - 1) * $alternatif->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-2 py-3 font-mono font-bold text-indigo-600 text-xs whitespace-nowrap">
                                        {{ $item->no_kk ?? '-' }}
                                    </td>
                                    <td class="px-2 py-3 font-mono font-bold text-slate-800 text-xs whitespace-nowrap">
                                        {{ $item->nik }}
                                    </td>
                                    <td class="px-2 py-3 font-bold text-slate-900 text-xs">
                                        {{ $item->nama_warga }}
                                    </td>
                                    <td class="px-2 py-3 text-slate-600 text-xs whitespace-nowrap">
                                        {{ $item->rt_rw ?? '-' }}
                                    </td>
                                    <td class="px-2 py-3 text-slate-600 text-xs font-semibold">
                                        {{ $item->pekerjaan ?? '-' }}
                                    </td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap">
                                        @if($item->user)
                                            <span
                                                title="{{ $item->user->email }}"
                                                class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-md border border-emerald-200/80 inline-flex items-center gap-1 cursor-help">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Terhubung
                                            </span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 bg-slate-100 text-slate-400 text-[11px] font-medium rounded-md">
                                                Belum Terhubung
                                            </span>
                                        @endif
                                    </td>
                                    <td class="ps-1 pe-4 py-3 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('warga.edit', $item->id) }}"
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 hover:bg-indigo-50 text-slate-700 hover:text-indigo-600 rounded-lg text-xs font-semibold transition">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('warga.destroy', $item->id) }}" method="POST"
                                                onsubmit="confirmDelete(event, this, 'Hapus Data Warga?', 'Menghapus data warga ini juga akan menghapus penilaian terkait.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-2 py-1 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg text-xs font-semibold transition">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-8 text-center text-slate-400">
                                        Belum ada data calon penerima bansos. Silakan tambah data baru.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div
                    class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <span
                        class="text-xs font-semibold px-3 py-1.5 bg-slate-100 text-slate-700 rounded-lg border border-slate-200 w-fit">
                        Total: {{ $totalWarga }} Calon Penerima
                    </span>
                    <div>
                        {{ $alternatif->links('partials.pagination') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>