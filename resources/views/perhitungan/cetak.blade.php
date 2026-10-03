<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Seleksi Bansos - {{ setting('app_name', 'SPK SAW') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                p: 0 !important;
            }

            .print-card {
                shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
        }
    </style>
</head>

<body class="bg-slate-100 p-4 md:p-8 text-slate-800 font-sans antialiased">

    <div
        class="max-w-4xl mx-auto bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-slate-200 print-card space-y-6">

        <!-- Print Action Bar (No Print) -->
        <div class="no-print flex items-center justify-between bg-indigo-50 p-4 rounded-xl border border-indigo-200">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-indigo-600 text-white flex items-center justify-center font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-sm">Mode Cetak / Download PDF Laporan</h3>
                    <p class="text-xs text-slate-600">Klik tombol di kanan untuk mencetak laporan resmi atau
                        menyimpannya sebagai file PDF.</p>
                </div>
            </div>
            <button onclick="window.print()"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak / Simpan PDF
            </button>
        </div>

        @php
            $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
            $formattedDate = date('d') . ' ' . $months[(int) date('m')] . ' ' . date('Y');
        @endphp

        <!-- Official Header / Kop Surat -->
        <div class="border-b-4 border-double border-slate-900 pb-4 mb-6 flex items-center justify-between">
            <div class="shrink-0">
                @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                    <img src="{{ asset(setting('app_logo')) }}" alt="Logo" class="h-16 w-auto object-contain">
                @else
                    <div
                        class="w-14 h-14 rounded-2xl bg-indigo-600 text-white font-black text-2xl flex items-center justify-center shadow-md">
                        {{ strtoupper(substr(setting('app_name', 'S'), 0, 1)) }}
                    </div>
                @endif
            </div>

            <div class="text-center px-4 flex-1">
                <h1 class="text-lg md:text-xl font-black uppercase tracking-tight text-slate-900 leading-tight">
                    {{ setting('institution_name', 'PENGURUS RT') }}
                </h1>
                <p class="text-xs font-semibold text-slate-700 mt-1">
                    {{ setting('address', 'Kantor Pengurus RT 01, Kelurahan Setempat') }}
                </p>
                <p class="text-[11px] text-slate-500 mt-1 flex items-center justify-center gap-2 flex-wrap">
                    <span>Tanggal Cetak: <strong class="text-slate-800">{{ $formattedDate }}</strong></span>
                    @if(setting('contact_email'))
                        <span>&bull;</span>
                        <span>Contact: <strong class="text-slate-700">{{ setting('contact_email') }}</strong></span>
                    @endif
                    @if(setting('contact_phone'))
                        <span>&bull;</span>
                        <span>Telp/WA: <strong class="text-slate-700">{{ setting('contact_phone') }}</strong></span>
                    @endif
                </p>
            </div>

            <div class="shrink-0 text-right">
                <span
                    class="inline-block px-3 py-1 bg-slate-100 border border-slate-300 text-[11px] font-mono font-bold text-slate-800 rounded-lg shadow-2xs">
                    DOKUMEN RESMI
                </span>
            </div>
        </div>

        <!-- Document Title -->
        <div class="text-center py-2">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wider underline">LAPORAN HASIL AKHIR
                SELEKSI PENERIMA BANTUAN SOSIAL (BANSOS)</h2>
            <p class="text-xs text-slate-500 mt-0.5">Laporan Resmi Hasil Penilaian dan Evaluasi Seleksi Bansos Warga RT
            </p>
        </div>

        <!-- Section 1: Data Kriteria -->
        <div>
            <h3 class="text-xs font-bold uppercase text-slate-700 tracking-wider mb-2 flex items-center gap-1.5">
                <span
                    class="w-4 h-4 rounded-md bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black">1</span>
                Parameter Kriteria & Bobot Penilaian
            </h3>
            <div class="overflow-x-auto border border-slate-300 rounded-xl">
                <table class="w-full text-xs text-left">
                    <thead class="bg-slate-100 uppercase text-slate-700 font-bold border-b border-slate-300">
                        <tr>
                            <th class="p-2.5 text-center border-r border-slate-300 w-16">Kode</th>
                            <th class="p-2.5 border-r border-slate-300">Nama Kriteria</th>
                            <th class="p-2.5 text-center border-r border-slate-300 w-28">Bobot (W)</th>
                            <th class="p-2.5 text-center w-28">Jenis Kriteria</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($sawData['kriteria'] as $k)
                            <tr>
                                <td class="p-2.5 text-center font-bold font-mono border-r border-slate-300 text-indigo-700">
                                    {{ $k->kode_kriteria }}
                                </td>
                                <td class="p-2.5 border-r border-slate-300 font-semibold text-slate-800">
                                    {{ $k->nama_kriteria }}
                                </td>
                                <td class="p-2.5 text-center font-bold border-r border-slate-300">{{ $k->bobot }}
                                    ({{ $k->bobot * 100 }}%)</td>
                                <td
                                    class="p-2.5 text-center uppercase font-bold text-[10px] {{ $k->tipe == 'benefit' ? 'text-emerald-700' : 'text-amber-700' }}">
                                    {{ $k->tipe }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 2: Hasil Akhir Perangkingan -->
        <div>
            <h3 class="text-xs font-bold uppercase text-slate-700 tracking-wider mb-2 flex items-center gap-1.5">
                <span
                    class="w-4 h-4 rounded-md bg-indigo-600 text-white flex items-center justify-center text-[10px] font-black">2</span>
                Daftar Hasil Perangkingan & Pengumuman Penerima Bantuan Sosial (Bansos)
            </h3>
            <div class="overflow-x-auto border border-slate-300 rounded-xl">
                <table class="w-full text-xs text-left">
                    <thead class="bg-slate-100 uppercase text-slate-700 font-bold border-b border-slate-300">
                        <tr>
                            <th class="p-2.5 text-center border-r border-slate-300 w-16">Rank</th>
                            <th class="p-2.5 border-r border-slate-300 w-28">No. KK</th>
                            <th class="p-2.5 border-r border-slate-300 w-28">NIK Kepala Keluarga</th>
                            <th class="p-2.5 border-r border-slate-300">Nama Kepala Keluarga</th>
                            <th class="p-2.5 border-r border-slate-300">RT</th>
                            <th class="p-2.5 text-center border-r border-slate-300 w-28">Skor Akhir</th>
                            <th class="p-2.5 text-center w-40">Status Hasil</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @foreach($sawData['ranking'] as $item)
                            <tr
                                class="{{ $item['rank'] <= 10 ? 'bg-emerald-50/50' : ($item['rank'] <= 15 ? 'bg-amber-50/30' : '') }}">
                                <td class="p-2.5 text-center font-bold border-r border-slate-300">
                                    <span
                                        class="inline-flex items-center justify-center w-6 h-6 rounded-full {{ $item['rank'] <= 10 ? 'bg-emerald-600 text-white' : ($item['rank'] <= 15 ? 'bg-amber-500 text-white' : 'bg-slate-200 text-slate-700') }} text-xs font-black">
                                        {{ $item['rank'] }}
                                    </span>
                                </td>
                                <td class="p-2.5 font-mono font-bold border-r border-slate-300 text-indigo-700">
                                    {{ $item['no_kk'] ?? '-' }}
                                </td>
                                <td class="p-2.5 font-mono font-bold border-r border-slate-300 text-slate-900">
                                    {{ $item['nik'] ?? $item['nim'] ?? '-' }}
                                </td>
                                <td class="p-2.5 border-r border-slate-300 font-bold text-slate-900">
                                    {{ $item['nama'] ?? $item['nama_warga'] ?? '-' }}
                                </td>
                                <td class="p-2.5 border-r border-slate-300 text-slate-600">
                                    {{ $item['rt_rw'] ?? $item['prodi'] ?? '-' }}
                                </td>
                                <td
                                    class="p-2.5 text-center font-mono font-bold text-indigo-700 border-r border-slate-300 text-sm">
                                    {{ number_format($item['score'], 4) }}
                                </td>
                                <td class="p-2.5 text-center font-bold">
                                    @if($item['rank'] <= 10)
                                        <span
                                            class="px-2.5 py-1 rounded-md bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase border border-emerald-300">
                                            LULUS (Penerima)
                                        </span>
                                    @elseif($item['rank'] <= 15)
                                        <span
                                            class="px-2 py-1 rounded-md bg-amber-100 text-amber-900 text-[10px] font-bold uppercase border border-amber-300">
                                            CADANGAN
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 rounded-md bg-slate-100 text-slate-500 text-[10px] uppercase border border-slate-200">
                                            BELUM LAYAK
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Signature & Validation Area -->
        <div class="pt-6 grid grid-cols-2 gap-8 text-xs border-t border-slate-200">
            <div>
                <p class="font-bold text-slate-700">Catatan Resmi:</p>
                <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                    1. Hasil perankingan ditentukan secara objektif oleh sistem berdasarkan bobot kriteria yang
                    disepakati.<br>
                    2. Keputusan penerima bantuan sosial bersifat final dan disahkan oleh Pengurus RT.
                </p>
            </div>
            <div class="text-center w-72 justify-self-end relative">
                <p class="text-slate-800 font-bold leading-snug">
                    {{ setting('institution_name', 'Pengurus RT') }}
                </p>
                <p class="text-slate-600 text-xs">{{ $formattedDate }}</p>
                <p class="font-bold text-slate-900 mt-2">Panitia Seleksi Bansos RT</p>

                <!-- Signature & Stamp Overlay Area -->
                <div class="relative h-20 my-1 flex items-end justify-center">
                    @if(setting('stempel_rt') && file_exists(public_path(setting('stempel_rt'))))
                        <img src="{{ asset(setting('stempel_rt')) }}" alt="Stempel RT"
                            class="absolute left-1/2 -translate-x-1/2 -bottom-10 w-72 h-44 object-contain pointer-events-none opacity-90 z-10 mix-blend-multiply rotate-[-4deg]">
                    @endif
                    <p
                        class="font-extrabold border-b border-slate-900 pb-1 text-slate-900 inline-block px-4 relative z-20">
                        ( Pengurus RT )
                    </p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>