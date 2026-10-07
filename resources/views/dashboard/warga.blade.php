<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3" x-data>
            <div>
                <h2 class="font-black text-xl text-slate-900 leading-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Dashboard
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Sistem Pendukung Keputusan Seleksi Penerima Bantuan Sosial RT 011/04 Jelambar</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if($alternatif)
                    <a href="{{ route('warga.cetakWarga') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition shadow-xs">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 00-2 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                        Cetak Bukti Evaluasi Bansos
                    </a>
                @endif
                <a href="{{ route('hasil.index') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs rounded-xl transition shadow-md shadow-indigo-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Pengumuman Bansos
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- Onboarding Progress Stepper Timeline -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002 2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Alur Tahapan Seleksi Bantuan Sosial Warga
            </h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Step 1 -->
                <div class="p-4 rounded-xl border border-emerald-200 bg-emerald-50/50 flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase text-emerald-700">Langkah 1</span>
                        <h4 class="font-bold text-slate-900 text-xs mt-0.5">Registrasi Akun</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Akun warga berhasil terdaftar di portal.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-4 rounded-xl border {{ $alternatif ? 'border-emerald-200 bg-emerald-50/50' : 'border-amber-300 bg-amber-50/60 animate-pulse' }} flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full {{ $alternatif ? 'bg-emerald-600 text-white' : 'bg-amber-500 text-white' }} flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                        @if($alternatif)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @else
                            2
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase {{ $alternatif ? 'text-emerald-700' : 'text-amber-700' }}">Langkah 2</span>
                        <h4 class="font-bold text-slate-900 text-xs mt-0.5">Koneksi Data NIK</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">
                            {{ $alternatif ? 'Terhubung ke NIK: ' . $alternatif->nik : 'Klaim NIK Anda di bawah ini.' }}
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-4 rounded-xl border {{ $alternatif ? 'border-emerald-200 bg-emerald-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full {{ $alternatif ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }} flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                        @if($alternatif)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @else
                            3
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase {{ $alternatif ? 'text-emerald-700' : 'text-slate-500' }}">Langkah 3</span>
                        <h4 class="font-bold text-slate-900 text-xs mt-0.5">Pengisian Kriteria</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">Lengkapi data pendapatan & kondisi rumah.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-4 rounded-xl border {{ $userRank ? 'border-emerald-200 bg-emerald-50/50' : 'border-slate-200 bg-slate-50 opacity-60' }} flex items-start gap-3">
                    <div class="w-8 h-8 rounded-full {{ $userRank ? 'bg-emerald-600 text-white' : 'bg-slate-300 text-slate-600' }} flex items-center justify-center font-bold text-xs shrink-0 shadow-xs">
                        @if($userRank)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @else
                            4
                        @endif
                    </div>
                    <div>
                        <span class="text-[10px] font-extrabold uppercase {{ $userRank ? 'text-emerald-700' : 'text-slate-500' }}">Langkah 4</span>
                        <h4 class="font-bold text-slate-900 text-xs mt-0.5">Hasil Perhitungan SAW</h4>
                        <p class="text-[11px] text-slate-500 mt-0.5">
                            {{ $userRank ? 'Peringkat #' . $userRank['rank'] . ' Terhitung' : 'Menunggu kalkulasi admin.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        @if(!$alternatif)
            <!-- Claim NIK Banner -->
            <div class="bg-gradient-to-r from-amber-500 via-orange-500 to-amber-600 text-white rounded-2xl p-6 shadow-lg space-y-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-black tracking-tight">Klaim Data NIK Warga Anda</h3>
                        <p class="text-xs text-amber-100 mt-1">Pilih NIK Anda yang telah didaftarkan pengurus RT untuk menyambungkan akun portal ini.</p>
                    </div>

                    <form action="{{ route('warga.claimNik') }}" method="POST" class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                        @csrf
                        <select name="nik" required class="rounded-xl border-none text-slate-900 text-xs px-3 py-2.5 focus:ring-2 focus:ring-white">
                            <option value="">-- Pilih NIK / Nama Warga --</option>
                            @foreach($unlinkedAlternatifList as $unlinked)
                                <option value="{{ $unlinked->nik }}">{{ $unlinked->nik }} - {{ $unlinked->nama_warga }} ({{ $unlinked->rt_rw ?? 'RT' }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md transition whitespace-nowrap">
                            Klaim NIK Saya &rarr;
                        </button>
                    </form>
                </div>
            </div>
        @endif

        @if($alternatif)
            <!-- Data Warga & Score Kriteria (Read-Only Verified by Pengurus RT) -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs space-y-6">
                <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-bold text-slate-900">Data Identitas & Nilai Kriteria Warga</h3>
                            <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-extrabold rounded-md border border-emerald-300 inline-flex items-center gap-1">
                                <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Verified Pengurus RT
                            </span>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">Data kriteria ini dikelola dan diverifikasi langsung oleh Pengurus RT untuk penilaian seleksi bansos.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        @if($alternatif->no_kk)
                            <span class="text-xs font-mono font-bold px-3 py-1 bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-lg w-fit">
                                No. KK: {{ $alternatif->no_kk }}
                            </span>
                        @endif
                        <span class="text-xs font-mono font-bold px-3 py-1 bg-slate-100 text-slate-700 border border-slate-200 rounded-lg w-fit">
                            NIK: {{ $alternatif->nik }}
                        </span>
                    </div>
                </div>

                <!-- Read-Only Identity Card -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-slate-50/80 p-4 rounded-xl border border-slate-200/80 text-xs">
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[10px] block">Nama Kepala Keluarga</span>
                        <span class="font-extrabold text-slate-900 text-sm block mt-0.5">{{ $alternatif->nama_warga }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[10px] block">Wilayah RT / RW</span>
                        <span class="font-bold text-slate-800 text-xs block mt-1">{{ $alternatif->rt_rw ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 font-bold uppercase text-[10px] block">Pekerjaan Utama</span>
                        <span class="font-bold text-slate-800 text-xs block mt-1">{{ $alternatif->pekerjaan ?? '-' }}</span>
                    </div>
                </div>

                <!-- Read-Only Criteria Grid -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        Parameter Nilai Kriteria Bansos (Metode SAW)
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($sawData['kriteria'] as $k)
                            @php
                                $p = $alternatif->penilaian->where('kriteria_id', $k->id)->first();
                                $val = $p ? $p->nilai : 0;
                            @endphp
                            <div class="p-4 bg-slate-50/50 rounded-xl border border-slate-200/80 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] font-mono font-bold px-2 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-100 rounded">
                                        {{ $k->kode_kriteria }}
                                    </span>
                                    <h5 class="text-xs font-bold text-slate-900 mt-1.5">{{ $k->nama_kriteria }}</h5>
                                    <span class="text-[10px] text-slate-400">Tipe: {{ strtoupper($k->tipe) }} | Bobot {{ $k->bobot * 100 }}%</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm font-black font-mono text-indigo-700 block">
                                        @if($k->kode_kriteria == 'C1')
                                            Rp {{ number_format($val, 0, ',', '.') }}
                                        @elseif($k->kode_kriteria == 'C2')
                                            {{ (int)$val }} Jiwa
                                        @elseif($k->kode_kriteria == 'C3')
                                            {{ (int)$val }} Skor
                                        @elseif($k->kode_kriteria == 'C4')
                                            {{ (int)$val }} VA
                                        @else
                                            {{ number_format($val, 2) }}
                                        @endif
                                    </span>
                                    <span class="text-[10px] font-semibold text-emerald-600">Terdaftar</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-app-layout>
