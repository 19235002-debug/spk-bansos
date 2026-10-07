<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-black text-xl text-slate-900 leading-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Sistem Pendukung Keputusan Seleksi Penerima Bantuan Sosial RT 011/04 Jelambar</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- FLOW STEPPER WIZARD (Tahapan Penggunaan SPK untuk Admin) -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-5">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 uppercase tracking-wide">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        ALUR SELEKSI PENERIMA BANSOS
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Panduan 4 langkah untuk mengelola dan memproses penyaluran bansos.</p>
                </div>
                <div>
                    <span
                        class="px-3 py-1 rounded-full text-xs font-extrabold border flex items-center gap-1.5 {{ $sawStatus['isComplete'] ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : 'bg-amber-100 text-amber-800 border-amber-300' }}">
                        @if($sawStatus['isComplete'])
                            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Sistem Operasional
                        @else
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Tahapan Belum Lengkap
                        @endif
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Step 1: Master Kriteria -->
                <a href="{{ route('kriteria.index') }}"
                    class="p-4 rounded-xl border {{ $kriteriaStatus['isComplete'] ? 'bg-emerald-50/50 border-emerald-200 hover:border-emerald-400' : 'bg-slate-50 border-slate-200 hover:border-indigo-300' }} transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span
                                class="w-7 h-7 rounded-lg {{ $kriteriaStatus['isComplete'] ? 'bg-emerald-600 text-white' : 'bg-slate-800 text-white' }} font-black text-xs flex items-center justify-center">1</span>
                            <span
                                class="text-[10px] font-extrabold uppercase px-2.5 py-0.5 rounded-md flex items-center gap-1 {{ $kriteriaStatus['isComplete'] ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                @if($kriteriaStatus['isComplete'])
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Tervalidasi
                                @else
                                    Konfigurasi
                                @endif
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-xs group-hover:text-indigo-600 transition">1. Kriteria & Bobot</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Tentukan kriteria penilaian, bobot, dan jenis kriteria.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                        <span class="text-slate-500 text-[11px]">Bobot: <strong
                                class="text-indigo-600 font-bold">{{ $kriteriaStatus['totalBobot'] }}</strong></span>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition">&rarr;</span>
                    </div>
                </a>

                <!-- Step 2: Data Calon Penerima -->
                <a href="{{ route('warga.index') }}"
                    class="p-4 rounded-xl border {{ $alternatifStatus['isComplete'] ? 'bg-emerald-50/50 border-emerald-200 hover:border-emerald-400' : 'bg-slate-50 border-slate-200 hover:border-indigo-300' }} transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span
                                class="w-7 h-7 rounded-lg {{ $alternatifStatus['isComplete'] ? 'bg-emerald-600 text-white' : 'bg-slate-800 text-white' }} font-black text-xs flex items-center justify-center">2</span>
                            <span
                                class="text-[10px] font-extrabold uppercase px-2.5 py-0.5 rounded-md flex items-center gap-1 {{ $alternatifStatus['isComplete'] ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                @if($alternatifStatus['isComplete'])
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Terverifikasi
                                @else
                                    Pendataan
                                @endif
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-xs group-hover:text-indigo-600 transition">2. Data Calon Penerima</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Kelola daftar NIK, nama kepala keluarga, No. RT, dan alamat warga.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                        <span class="text-slate-500 text-[11px]">Warga: <strong
                                class="text-emerald-600 font-bold">{{ $alternatifStatus['count'] }}
                                Orang</strong></span>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition">&rarr;</span>
                    </div>
                </a>

                <!-- Step 3: Penilaian -->
                <a href="{{ route('penilaian.index') }}"
                    class="p-4 rounded-xl border {{ $penilaianStatus['isComplete'] ? 'bg-emerald-50/50 border-emerald-200 hover:border-emerald-400' : 'bg-slate-50 border-slate-200 hover:border-indigo-300' }} transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span
                                class="w-7 h-7 rounded-lg {{ $penilaianStatus['isComplete'] ? 'bg-emerald-600 text-white' : 'bg-slate-800 text-white' }} font-black text-xs flex items-center justify-center">3</span>
                            <span
                                class="text-[10px] font-extrabold uppercase px-2.5 py-0.5 rounded-md flex items-center gap-1 {{ $penilaianStatus['isComplete'] ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                @if($penilaianStatus['isComplete'])
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Matriks Terisi
                                @else
                                    Perlu Dilengkapi
                                @endif
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-xs group-hover:text-indigo-600 transition">3. Penilaian</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Isi skor penilaian untuk setiap warga.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                        <span class="text-slate-500 text-[11px]">Terisi: <strong
                                class="text-violet-600 font-bold">{{ $penilaianStatus['count'] }} /
                                {{ $penilaianStatus['expected'] }}</strong></span>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition">&rarr;</span>
                    </div>
                </a>

                <!-- Step 4: Perhitungan SAW -->
                <a href="{{ route('perhitungan.index') }}"
                    class="p-4 rounded-xl border {{ $sawStatus['isComplete'] ? 'bg-emerald-50/50 border-emerald-200 hover:border-emerald-400' : 'bg-slate-50 border-slate-200 hover:border-indigo-300' }} transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span
                                class="w-7 h-7 rounded-lg {{ $sawStatus['isComplete'] ? 'bg-emerald-600 text-white' : 'bg-slate-800 text-white' }} font-black text-xs flex items-center justify-center">4</span>
                            <span
                                class="text-[10px] font-extrabold uppercase px-2.5 py-0.5 rounded-md flex items-center gap-1 {{ $sawStatus['isComplete'] ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-slate-200 text-slate-600 border border-slate-300' }}">
                                @if($sawStatus['isComplete'])
                                    <svg class="w-3 h-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    Laporan Tersedia
                                @else
                                    Proses Perhitungan
                                @endif
                            </span>
                        </div>
                        <h4 class="font-bold text-slate-900 text-xs group-hover:text-indigo-600 transition">4. Perhitungan SAW</h4>
                        <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">
                            Hitung hasil akhir otomatis dan cetak laporan hasil seleksi.
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-200/60 flex items-center justify-between text-xs">
                        <span
                            class="{{ $sawStatus['isComplete'] ? 'text-emerald-600' : 'text-indigo-600' }} font-bold text-[11px]">Lihat
                            Hasil Perhitungan</span>
                        <span class="text-indigo-600 font-bold group-hover:translate-x-1 transition">&rarr;</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Quick Metrics Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

            <!-- Metric 1: Kriteria -->
            <div
                class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 right-0 h-1 bg-indigo-600"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Total Kriteria</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalKriteria }} <span
                                class="text-xs font-semibold text-slate-500">Item</span></h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                </div>
                <div
                    class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Bobot Total: <strong
                            class="text-indigo-600 font-bold">{{ $sawData['totalBobot'] }}</strong></span>
                    <a href="{{ route('kriteria.index') }}"
                        class="text-indigo-600 font-bold hover:underline flex items-center gap-1">
                        Kelola &rarr;
                    </a>
                </div>
            </div>

            <!-- Metric 2: Alternatif -->
            <div
                class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 right-0 h-1 bg-emerald-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Calon Penerima</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalAlternatif }} <span
                                class="text-xs font-semibold text-slate-500">Orang</span></h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <div
                    class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Data Warga Terdaftar</span>
                    <a href="{{ route('warga.index') }}"
                        class="text-emerald-600 font-bold hover:underline flex items-center gap-1">
                        Kelola &rarr;
                    </a>
                </div>
            </div>

            <!-- Metric 3: User Accounts -->
            <div
                class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 right-0 h-1 bg-violet-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Pengguna Sistem</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">{{ $totalUser }} <span
                                class="text-xs font-semibold text-slate-500">User</span></h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-600 flex items-center justify-center font-bold group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
                <div
                    class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Role Pengguna Sistem</span>
                    <span class="text-violet-600 font-bold">Admin & Warga</span>
                </div>
            </div>

            <!-- Metric 4: Team Proyek -->
            <div
                class="bg-white rounded-2xl p-5 border border-slate-200 shadow-xs hover:shadow-md transition duration-200 relative overflow-hidden group">
                <div class="absolute top-0 left-0 right-0 h-1 bg-amber-500"></div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Tim Pengembang</p>
                        <h3 class="text-3xl font-black text-slate-900 mt-1">4 <span
                                class="text-xs font-semibold text-slate-500">Peran</span></h3>
                    </div>
                    <div
                        class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold group-hover:scale-110 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div
                    class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Ketua, Analis, Dev, Tester</span>
                    <a href="{{ route('team.index') }}"
                        class="text-amber-600 font-bold hover:underline flex items-center gap-1">
                        Lihat Tim &rarr;
                    </a>
                </div>
            </div>
        </div>

        <!-- Top 5 Candidate Preview Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
            <div
                class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2 uppercase tracking-wide">
                        <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        PERINGKAT CALON PENERIMA BANSOS
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">Menampilkan calon penerima berdasarkan skor SAW tertinggi.</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('perhitungan.cetak') }}" target="_blank"
                        class="inline-flex items-center gap-1.5 px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs rounded-xl transition shadow-xs">
                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Laporan
                    </a>
                    <a href="{{ route('perhitungan.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold text-xs rounded-xl hover:bg-indigo-700 transition shadow-sm shrink-0">
                        Lihat Perhitungan Lengkap
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-xs text-left text-slate-600">
                    <thead
                        class="text-[11px] text-slate-500 uppercase bg-slate-100/70 border-b border-slate-200 font-bold tracking-wider">
                        <tr>
                            <th class="px-4 py-3.5 text-center whitespace-nowrap">Rank</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">No. KK</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">NIK</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">Nama</th>
                            <th class="px-4 py-3.5 whitespace-nowrap">RT</th>
                            <th class="px-4 py-3.5 text-center whitespace-nowrap">Skor SAW</th>
                            <th class="px-6 py-3.5 text-center whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($topRanking as $item)
                            <tr class="hover:bg-indigo-50/30 transition">
                                <td class="px-4 py-3.5 text-center font-bold whitespace-nowrap">
                                    @if($item['rank'] == 1)
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-amber-100 text-amber-900 font-black text-xs border border-amber-300 shadow-xs whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5 me-1 text-amber-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg> Rank #1
                                        </span>
                                    @elseif($item['rank'] == 2)
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-slate-200 text-slate-800 font-black text-xs border border-slate-300 shadow-xs whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5 me-1 text-slate-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg> Rank #2
                                        </span>
                                    @elseif($item['rank'] == 3)
                                        <span
                                            class="inline-flex items-center justify-center px-2.5 py-1 rounded-full bg-orange-100 text-orange-900 font-black text-xs border border-orange-300 shadow-xs whitespace-nowrap">
                                            <svg class="w-3.5 h-3.5 me-1 text-orange-600" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg> Rank #3
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-emerald-600 text-white font-black text-xs">#{{ $item['rank'] }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3.5 font-mono font-bold text-indigo-600 whitespace-nowrap">
                                    {{ $item['no_kk'] ?? '-' }}</td>
                                <td class="px-4 py-3.5 font-mono font-bold text-slate-800 whitespace-nowrap">
                                    {{ $item['nik'] ?? '-' }}</td>
                                <td class="px-4 py-3.5 font-extrabold text-slate-900 whitespace-nowrap">
                                    {{ $item['nama_warga'] ?? '-' }}</td>
                                <td class="px-4 py-3.5 text-slate-600 whitespace-nowrap">{{ $item['rt_rw'] ?? '-' }}</td>
                                <td class="px-4 py-3.5 text-center font-black text-indigo-600 text-sm whitespace-nowrap">
                                    {{ number_format($item['score'], 4) }}
                                </td>
                                <td class="px-6 py-3.5 text-center whitespace-nowrap">
                                    @if($item['rank'] <= 10)
                                        <span
                                            class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-extrabold rounded-full border border-emerald-300 whitespace-nowrap">
                                            Penerima Utama (Lulus)
                                        </span>
                                    @elseif($item['rank'] <= 15)
                                        <span
                                            class="inline-block px-3 py-1 bg-amber-100 text-amber-900 text-xs font-bold rounded-full border border-amber-300 whitespace-nowrap">
                                            Peringkat Cadangan
                                        </span>
                                    @else
                                        <span
                                            class="inline-block px-3 py-1 bg-slate-100 text-slate-500 text-xs font-medium rounded-full border border-slate-200 whitespace-nowrap">
                                            Tidak Lulus / Belum Layak
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data warga atau penilaian yang terdaftar di sistem.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>