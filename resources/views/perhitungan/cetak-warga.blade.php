<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Evaluasi Bansos RT - {{ $alternatif->nama_warga }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: #fff !important;
                padding: 0 !important;
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

    <!-- Action Bar (No Print) -->
    <div class="max-w-4xl mx-auto mb-4 no-print flex justify-between items-center px-2">
        <a href="{{ route('dashboard') }}"
            class="text-xs font-bold text-slate-600 hover:text-indigo-600 flex items-center gap-1 transition">
            &larr; Kembali ke Dashboard
        </a>
        <button onclick="window.print()"
            class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl shadow-md transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 00-2 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Bukti Evaluasi (PDF)
        </button>
    </div>

    <!-- Official Warga Transcript Paper -->
    <div
        class="max-w-4xl mx-auto bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-slate-200 print-card space-y-6">

        @php
            $months = [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'];
            $formattedDate = date('d') . ' ' . $months[(int) date('m')] . ' ' . date('Y');
        @endphp

        <!-- Kop Surat Header -->
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
                    NO. REF: SAW/{{ date('Ymd') }}/{{ $alternatif->id }}
                </span>
            </div>
        </div>

        <!-- Document Title -->
        <div class="text-center py-1">
            <h2 class="text-base font-extrabold text-slate-900 uppercase tracking-wide underline">SURAT BUKTI HASIL
                EVALUASI SELEKSI BANSOS WARGA RT</h2>
            <p class="text-xs text-slate-500 mt-0.5">Laporan Hasil Evaluasi Individual Warga Calon Penerima Bansos</p>
        </div>

        <!-- Citizen Information Card (Private Data Only) -->
        <div class="bg-slate-50 p-5 rounded-2xl border border-slate-200 grid grid-cols-2 sm:grid-cols-5 gap-4 text-xs">
            <div>
                <span class="text-slate-400 font-bold uppercase text-[10px] block">No. KK (Kartu Keluarga)</span>
                <span
                    class="font-mono font-bold text-indigo-700 text-sm block mt-0.5">{{ $alternatif->no_kk ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold uppercase text-[10px] block">Nama Kepala Keluarga</span>
                <span class="font-extrabold text-slate-900 text-sm block mt-0.5">{{ $alternatif->nama_warga }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold uppercase text-[10px] block">NIK Kepala Keluarga</span>
                <span class="font-mono font-bold text-slate-900 text-sm block mt-0.5">{{ $alternatif->nik }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold uppercase text-[10px] block">No. RT / RW</span>
                <span class="font-bold text-slate-800 text-xs block mt-1">{{ $alternatif->rt_rw ?? '-' }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold uppercase text-[10px] block">Pekerjaan</span>
                <span class="font-bold text-slate-800 text-xs block mt-1">{{ $alternatif->pekerjaan ?? '-' }}</span>
            </div>
        </div>

        <!-- Result Box Summary -->
        @if($userRank)
            <div
                class="p-6 rounded-2xl border {{ $userRank['rank'] <= 10 ? 'bg-emerald-50/80 border-emerald-300 text-emerald-950' : ($userRank['rank'] <= 15 ? 'bg-amber-50/80 border-amber-300 text-amber-950' : 'bg-slate-100/80 border-slate-300 text-slate-900') }} flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="space-y-1 text-center md:text-left">
                    <span
                        class="text-[10px] uppercase tracking-wider font-extrabold px-2.5 py-0.5 rounded-full {{ $userRank['rank'] <= 10 ? 'bg-emerald-200 text-emerald-900' : ($userRank['rank'] <= 15 ? 'bg-amber-200 text-amber-900' : 'bg-slate-200 text-slate-800') }}">
                        Status Rekomendasi Bansos
                    </span>
                    <h3 class="text-xl font-black mt-1">
                        @if($userRank['rank'] <= 10)
                            LULUS - DIREKOMENDASIKAN PENERIMA UTAMA BANSOS
                        @elseif($userRank['rank'] <= 15)
                            CADANGAN - DIUSULKAN DALAM DAFTAR CADANGAN
                        @else
                            BELUM LAYAK / TIDAK LULUS SELEKSI
                        @endif
                    </h3>
                    <p class="text-xs opacity-90">
                        Berdasarkan hasil perhitungan Simple Additive Weighting (SAW), Anda berada pada <strong>Peringkat
                            ke-{{ $userRank['rank'] }}</strong> dari {{ count($sawData['ranking']) }} calon penerima bansos.
                    </p>
                </div>
                <div class="text-center shrink-0 px-6 py-3 bg-white rounded-xl border border-slate-200/80 shadow-2xs">
                    <span class="text-[10px] uppercase font-bold text-slate-400 block">Skor Preferensi</span>
                    <span
                        class="text-2xl font-black font-mono text-indigo-700 block mt-0.5">{{ number_format($userRank['score'], 4) }}</span>
                </div>
            </div>
        @endif

        <!-- Evaluation Details Table -->
        <div class="space-y-3">
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                Rincian Evaluasi Nilai Kriteria & Normalisasi SAW
            </h3>

            <div class="border border-slate-200 rounded-xl overflow-hidden text-xs">
                <table class="w-full text-left">
                    <thead
                        class="bg-slate-50 border-b border-slate-200 font-bold uppercase text-[10px] text-slate-600 tracking-wider">
                        <tr>
                            <th class="px-4 py-2.5 text-center">Kode</th>
                            <th class="px-4 py-2.5">Nama Kriteria Penilaian</th>
                            <th class="px-4 py-2.5 text-center">Tipe</th>
                            <th class="px-4 py-2.5 text-center">Bobot</th>
                            <th class="px-4 py-2.5 text-center">Nilai Asli</th>
                            <th class="px-4 py-2.5 text-center">Normalisasi (R)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($sawData['kriteria'] as $k)
                            @php
                                $valX = $sawData['matrixX'][$alternatif->id][$k->id] ?? 0;
                                $valR = $sawData['matrixR'][$alternatif->id][$k->id] ?? 0;
                            @endphp
                            <tr class="hover:bg-slate-50/50">
                                <td class="px-4 py-2.5 text-center font-mono font-bold text-indigo-600">
                                    {{ $k->kode_kriteria }}</td>
                                <td class="px-4 py-2.5 font-bold text-slate-800">{{ $k->nama_kriteria }}</td>
                                <td class="px-4 py-2.5 text-center">
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $k->tipe == 'benefit' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $k->tipe }}
                                    </span>
                                </td>
                                <td class="px-4 py-2.5 text-center font-mono font-bold text-slate-700">
                                    {{ $k->bobot * 100 }}%</td>
                                <td class="px-4 py-2.5 text-center font-mono font-bold text-slate-800">
                                    @if($k->kode_kriteria == 'C1')
                                        Rp {{ number_format($valX, 0, ',', '.') }}
                                    @elseif($k->kode_kriteria == 'C2')
                                        {{ (int) $valX }} Jiwa
                                    @elseif($k->kode_kriteria == 'C3')
                                        {{ (int) $valX }}
                                    @elseif($k->kode_kriteria == 'C4')
                                        {{ (int) $valX }} VA
                                    @else
                                        {{ number_format($valX, 2) }}
                                    @endif
                                </td>
                                <td class="px-4 py-2.5 text-center font-mono font-bold text-emerald-600">
                                    {{ number_format($valR, 4) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Signature Block -->
        <div class="pt-8 grid grid-cols-2 gap-8 text-center text-xs">
            <div class="space-y-16">
                <div>
                    <p class="font-bold text-slate-700">Warga Penerima (Kepala Keluarga)</p>
                    <p class="text-[10px] text-slate-400">Pemilik Data Identitas</p>
                </div>
                <div>
                    <p class="font-bold text-slate-900 border-b border-slate-300 pb-1 inline-block min-w-[160px]">
                        {{ $alternatif->nama_warga }}</p>
                    <p class="text-[10px] font-mono text-slate-500 mt-0.5">NIK: {{ $alternatif->nik }}</p>
                </div>
            </div>

            <div class="space-y-16 relative">
                <div>
                    <p class="font-bold text-slate-700">Pengurus RT 011 / RW 04 Jelambar</p>
                    <p class="text-[10px] text-slate-400">Ketua RT / Tim Seleksi Bansos</p>
                </div>

                <!-- Overlay RT Seal Stamp -->
                @if(setting('stempel_rt') && file_exists(public_path(setting('stempel_rt'))))
                    <img src="{{ asset(setting('stempel_rt')) }}" alt="Stempel Resmi RT"
                        class="absolute left-1/2 -translate-x-1/2 bottom-4 w-48 h-28 opacity-90 pointer-events-none mix-blend-multiply rotate-[-4deg] drop-shadow-sm">
                @endif

                <div class="relative z-10">
                    <p class="font-bold text-slate-900 border-b border-slate-300 pb-1 inline-block min-w-[160px]">(
                        Pengurus RT )</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">Disahkan Secara Resmi</p>
                </div>
            </div>
        </div>

        <!-- Document Footer Note -->
        <div class="border-t border-slate-200 pt-4 text-[10px] text-slate-400 text-center space-y-1">
            <p>Dokumen ini dicetak otomatis oleh sistem SPK Bantuan Sosial RT menggunakan metode Simple Additive
                Weighting (SAW).</p>
            <p>&copy; {{ date('Y') }} {{ setting('app_name', 'SPK Bansos RT') }}. Semua Hak Dilindungi.</p>
        </div>

    </div>

</body>

</html>