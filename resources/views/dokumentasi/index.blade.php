<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Dokumentasi & Panduan Sistem SPK Bansos RT
        </h2>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen" x-data="{ activeTab: 'saw' }">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Navigation Tabs -->
            <div class="bg-white rounded-2xl border border-slate-200 p-2 shadow-xs flex flex-wrap gap-2">
                <button @click="activeTab = 'saw'"
                    :class="activeTab === 'saw' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 font-semibold' : 'text-slate-600 hover:bg-slate-100 font-medium'"
                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm transition duration-150 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Metodologi Algoritma SAW
                </button>

                <button @click="activeTab = 'workflow'"
                    :class="activeTab === 'workflow' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 font-semibold' : 'text-slate-600 hover:bg-slate-100 font-medium'"
                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm transition duration-150 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Alur Kerja Aplikasi (Workflow)
                </button>

                <button @click="activeTab = 'architecture'"
                    :class="activeTab === 'architecture' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 font-semibold' : 'text-slate-600 hover:bg-slate-100 font-medium'"
                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm transition duration-150 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                    </svg>
                    Arsitektur Proyek SI
                </button>

                <button @click="activeTab = 'roles'"
                    :class="activeTab === 'roles' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 font-semibold' : 'text-slate-600 hover:bg-slate-100 font-medium'"
                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm transition duration-150 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Hak Akses (Role Matrix)
                </button>

                <button @click="activeTab = 'faq'"
                    :class="activeTab === 'faq' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200 font-semibold' : 'text-slate-600 hover:bg-slate-100 font-medium'"
                    class="px-4 py-2.5 rounded-xl text-xs md:text-sm transition duration-150 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    FAQ & Tanya Jawab
                </button>
            </div>

            <!-- TAB CONTENT 1: SAW METHODOLOGY -->
            <div x-show="activeTab === 'saw'" x-transition class="space-y-6">
                <!-- Overview Card -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm">1</span>
                        Pengertian Metode Simple Additive Weighting (SAW)
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Metode <strong>Simple Additive Weighting (SAW)</strong> dikenal dengan istilah metode
                        penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating
                        kinerja pada setiap warga (calon penerima) pada semua atribut/kriteria. Metode SAW membutuhkan proses
                        normalisasi matriks keputusan ($X$) ke suatu skala yang dapat diperbandingkan dengan semua
                        rating warga yang ada.
                    </p>
                </div>

                <!-- Rumus Normalisasi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Benefit Formula Card -->
                    <div class="bg-emerald-50/50 border border-emerald-200 rounded-2xl p-6 space-y-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider border border-emerald-300">
                                Kriteria Benefit (Keuntungan)
                            </span>
                        </div>
                        <h4 class="text-base font-bold text-slate-800">Rumus Normalisasi Kriteria Benefit</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Kriteria yang nilainya semakin <strong>besar</strong> semakin layak diprioritaskan
                            (misalnya: Jumlah Tanggungan Keluarga, Kondisi Rumah).
                        </p>
                        <div
                            class="bg-white p-4 rounded-xl border border-emerald-200 font-mono text-sm text-emerald-900 font-bold text-center shadow-inner">
                            r<sub>ij</sub> = x<sub>ij</sub> / Max(x<sub>ij</sub>)
                        </div>
                        <p class="text-[11px] text-slate-500">
                            Dimana <em>x<sub>ij</sub></em> adalah nilai warga ke-i pada kriteria ke-j, dan
                            <em>Max(x<sub>ij</sub>)</em> adalah nilai maksimum pada kriteria ke-j.
                        </p>
                    </div>

                    <!-- Cost Formula Card -->
                    <div class="bg-amber-50/50 border border-amber-200 rounded-2xl p-6 space-y-3">
                        <div class="flex items-center gap-2">
                            <span
                                class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-800 text-xs font-bold uppercase tracking-wider border border-amber-300">
                                Kriteria Cost (Biaya)
                            </span>
                        </div>
                        <h4 class="text-base font-bold text-slate-800">Rumus Normalisasi Kriteria Cost</h4>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            Kriteria yang nilainya semakin <strong>kecil</strong> semakin layak diprioritaskan
                            (misalnya: Pendapatan Keluarga per Bulan, Daya Listrik Rumah).
                        </p>
                        <div
                            class="bg-white p-4 rounded-xl border border-amber-200 font-mono text-sm text-amber-900 font-bold text-center shadow-inner">
                            r<sub>ij</sub> = Min(x<sub>ij</sub>) / x<sub>ij</sub>
                        </div>
                        <p class="text-[11px] text-slate-500">
                            Dimana <em>Min(x<sub>ij</sub>)</em> adalah nilai minimum pada kriteria ke-j, dan
                            <em>x<sub>ij</sub></em> adalah nilai warga ke-i pada kriteria ke-j.
                        </p>
                    </div>
                </div>

                <!-- Rumus Perhitungan Preferensi V -->
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
                    <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2 border-b border-slate-100 pb-3">
                        <span
                            class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-sm">2</span>
                        Rumus Nilai Preferensi / Skor Akhir (V<sub>i</sub>)
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Nilai preferensi untuk setiap warga (V<sub>i</sub>) diperoleh dengan mengalikan matriks
                        ternormalisasi (R<sub>ij</sub>) dengan bobot kriteria (W<sub>j</sub>) yang dispesifikasikan.
                        Warga dengan nilai V<sub>i</sub> tertinggi merupakan rekomendasi penerima bantuan sosial
                        (bansos) RT terbaik.
                    </p>
                    <div
                        class="bg-indigo-900 text-indigo-100 p-5 rounded-xl font-mono text-center text-base md:text-lg font-bold shadow-md">
                        V<sub>i</sub> = ∑ (w<sub>j</sub> × r<sub>ij</sub>)
                    </div>

                    <!-- Existing Kriteria Active List -->
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Kriteria & Skala
                            Batas Aktif Saat Ini di Sistem:</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">
                            @foreach($kriteriaList as $k)
                                <div
                                    class="bg-slate-50 p-3.5 rounded-xl border border-slate-200 flex flex-col justify-between space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="font-bold text-slate-800 text-sm">{{ $k->kode_kriteria }} -
                                            {{ $k->nama_kriteria }}</span>
                                        <span
                                            class="px-2 py-0.5 bg-indigo-100 text-indigo-800 font-black text-xs rounded-lg">
                                            {{ $k->bobot * 100 }}%
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="capitalize text-slate-500">Tipe: <strong
                                                class="{{ $k->tipe === 'benefit' ? 'text-emerald-600' : 'text-amber-600' }}">{{ $k->tipe }}</strong></span>
                                        <span class="font-semibold text-indigo-600 text-[11px]">
                                            @if($k->kode_kriteria == 'C1')
                                                Rupiah (Rp) / Bulan
                                            @elseif($k->kode_kriteria == 'C2')
                                                Jumlah Jiwa (0+)
                                            @elseif($k->kode_kriteria == 'C3')
                                                Range: 1 - 5 (1: Sangat Baik, 5: Sangat Memprihatinkan)
                                            @elseif($k->kode_kriteria == 'C4')
                                                VA (Watt)
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 2: WORKFLOW -->
            <div x-show="activeTab === 'workflow'" x-transition class="space-y-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Langkah-Langkah Pengoperasian Sistem SPK Bansos RT
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <!-- Step 1 -->
                        <div
                            class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 hover:shadow-xs transition duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">1</span>
                                </div>
                                <h4 class="font-bold text-slate-900 text-sm mb-2 leading-snug">Master Kriteria</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Admin mengelola kriteria penilaian (Pendapatan, Tanggungan, Kondisi Rumah, Daya
                                    Listrik), menentukan bobot W (total = 1.0), dan tipe kriteria (Benefit / Cost).
                                </p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div
                            class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 hover:shadow-xs transition duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">2</span>
                                </div>
                                <h4 class="font-bold text-slate-900 text-sm mb-2 leading-snug">Master Data Warga</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Admin menginputkan data warga (NIK, Nama Warga, RT, Pekerjaan, Alamat)
                                    yang berhak mengikuti seleksi bansos.
                                </p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div
                            class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 hover:shadow-xs transition duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">3</span>
                                </div>
                                <h4 class="font-bold text-slate-900 text-sm mb-2 leading-snug">Input Nilai Matriks</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Admin mengisikan skor nilai kriteria untuk setiap warga pada formulir matriks
                                    keputusan awal.
                                </p>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div
                            class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 hover:shadow-xs transition duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">4</span>
                                </div>
                                <h4 class="font-bold text-slate-900 text-sm mb-2 leading-snug">Kalkulasi Engine SAW</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Sistem secara otomatis menghitung matriks normalisasi R dan skor preferensi V untuk
                                    melakukan perangkingan penerima bansos.
                                </p>
                            </div>
                        </div>

                        <!-- Step 5 -->
                        <div
                            class="bg-slate-50 p-5 rounded-2xl border border-slate-200/80 hover:border-indigo-300 hover:shadow-xs transition duration-200 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">5</span>
                                </div>
                                <h4 class="font-bold text-slate-900 text-sm mb-2 leading-snug">Pengumuman & Cetak</h4>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Hasil peringkat akhir dapat diakses oleh Warga & Admin dapat mencetak laporan resmi
                                    (PDF / cetak fisik).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 3: ARCHITECTURE -->
            <div x-show="activeTab === 'architecture'" x-transition class="space-y-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-6">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Spesifikasi Arsitektur Sistem Informasi & Database
                    </h3>

                    <!-- Specs Badges -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] uppercase font-bold text-slate-400">Framework Backend</span>
                            <h4 class="text-base font-extrabold text-slate-800 mt-1">Laravel 11.x / 12.x</h4>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] uppercase font-bold text-slate-400">Styling & UI</span>
                            <h4 class="text-base font-extrabold text-slate-800 mt-1">Tailwind CSS v3</h4>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] uppercase font-bold text-slate-400">Interaktivitas Frontend</span>
                            <h4 class="text-base font-extrabold text-slate-800 mt-1">Alpine.js v3</h4>
                        </div>
                        <div class="p-4 rounded-xl bg-slate-50 border border-slate-200">
                            <span class="text-[10px] uppercase font-bold text-slate-400">Database Engine</span>
                            <h4 class="text-base font-extrabold text-slate-800 mt-1">MySQL / MariaDB</h4>
                        </div>
                    </div>

                    <!-- Database Entity Schema Table -->
                    <div>
                        <h4 class="text-sm font-bold text-slate-800 mb-3">Struktur Entitas Tabel Database (ERD):</h4>
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-xs text-left text-slate-600 border border-slate-200 rounded-xl overflow-hidden">
                                <thead
                                    class="bg-slate-100 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200">
                                    <tr>
                                        <th class="p-3">Nama Tabel</th>
                                        <th class="p-3">Kunci (Keys)</th>
                                        <th class="p-3">Atribut / Kolom Utama</th>
                                        <th class="p-3">Fungsi / Peranan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white">
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">users</td>
                                        <td class="p-3">PK: id</td>
                                        <td class="p-3">name, email, password, role ('admin'|'warga')</td>
                                        <td class="p-3">Autentikasi & Otorisasi Pengguna Sistem (Admin RT / Warga)</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">kriteria</td>
                                        <td class="p-3">PK: id</td>
                                        <td class="p-3">kode_kriteria, nama_kriteria, bobot, tipe ('benefit'|'cost')
                                        </td>
                                        <td class="p-3">Master Kriteria & Bobot SAW Bansos</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">warga</td>
                                        <td class="p-3">PK: id, FK: user_id</td>
                                        <td class="p-3">no_kk, nik, nama_warga, rt_rw, pekerjaan, alamat</td>
                                        <td class="p-3">Master Data Warga Calon Penerima Bansos (RT 011/04)</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">penilaian</td>
                                        <td class="p-3">PK: id, FK: warga_id, kriteria_id</td>
                                        <td class="p-3">nilai (double)</td>
                                        <td class="p-3">Matriks Keputusan (X) untuk perhitungan SAW</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">team_members</td>
                                        <td class="p-3">PK: id</td>
                                        <td class="p-3">nama, nim, peran, email, tugas, avatar, github_url,
                                            linkedin_url, urutan</td>
                                        <td class="p-3">Manajemen Anggota Tim Proyek Sistem Informasi SPK Bansos</td>
                                    </tr>
                                    <tr>
                                        <td class="p-3 font-mono font-bold text-indigo-600">settings</td>
                                        <td class="p-3">PK: id</td>
                                        <td class="p-3">key, value</td>
                                        <td class="p-3">Pengaturan Konfigurasi Aplikasi (Judul, Logo, Stempel RT,
                                            Kontak)</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 4: ROLES -->
            <div x-show="activeTab === 'roles'" x-transition class="space-y-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Matriks Hak Akses Pengguna (Role-Based Access Control)
                    </h3>

                    <div class="overflow-x-auto">
                        <table
                            class="w-full text-xs text-left text-slate-600 border border-slate-200 rounded-xl overflow-hidden">
                            <thead
                                class="bg-slate-100 text-slate-700 font-bold uppercase tracking-wider border-b border-slate-200">
                                <tr>
                                    <th class="p-3">Fitur / Modul</th>
                                    <th class="p-3 text-center">Role Admin (Pengurus RT)</th>
                                    <th class="p-3 text-center">Role Warga</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Dashboard Utama</td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Full Access (Statistik & Top 5 Warga)
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            View (Status Pengajuan & Kelayakan)
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Kelola Data Kriteria (CRUD)</td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Ya (Tambah/Edit/Hapus)
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-rose-500">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-rose-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tidak Akses
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Kelola Data Warga</td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Ya (Tambah/Edit/Hapus/Reset Password)
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-rose-500">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-rose-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tidak Akses
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Input & Update Matriks Nilai</td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Ya (Batch Update)
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-rose-500">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-rose-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tidak Akses
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Perhitungan SAW Engine & Cetak Laporan
                                    </td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Ya (Hitung & Cetak Laporan Resmi)
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Lihat Hasil Akhir & Peringkat Bansos
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-3 font-semibold text-slate-800">Manajemen Tim Proyek SI & Pengaturan
                                        Sistem</td>
                                    <td class="p-3 text-center font-bold text-emerald-600">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-100 text-emerald-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-emerald-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            Full CRUD & Pengaturan Logo/Favicon
                                        </span>
                                    </td>
                                    <td class="p-3 text-center font-bold text-rose-500">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded bg-rose-100 text-rose-800 font-bold text-[11px]">
                                            <svg class="w-3.5 h-3.5 me-1 text-rose-600" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Tidak Akses
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB CONTENT 5: FAQ -->
            <div x-show="activeTab === 'faq'" x-transition class="space-y-6">
                <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-xs space-y-4">
                    <h3 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pertanyaan Yang Sering Diajukan (FAQ)
                    </h3>

                    <div class="space-y-3" x-data="{ openFaq: null }">
                        <!-- FAQ 1 -->
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <button @click="openFaq = openFaq === 1 ? null : 1"
                                class="w-full p-4 text-left font-bold text-slate-800 bg-slate-50 hover:bg-slate-100 transition flex justify-between items-center text-sm">
                                <span>Mengapa jumlah total bobot kriteria harus bernilai 1.0 (100%)?</span>
                                <svg class="w-5 h-5 text-slate-500 transition-transform"
                                    :class="openFaq === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openFaq === 1" x-collapse
                                class="p-4 bg-white text-xs text-slate-600 leading-relaxed border-t border-slate-200">
                                Dalam metode SAW, bobot kriteria (W) merepresentasikan tingkat kepentingan relatif dari
                                masing-masing kriteria. Penjumlahan total bobot bernilai 1.0 menjamin skala perhitungan
                                rasional dan tidak membiaskan skor preferensi akhir kelayakan bansos.
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <button @click="openFaq = openFaq === 2 ? null : 2"
                                class="w-full p-4 text-left font-bold text-slate-800 bg-slate-50 hover:bg-slate-100 transition flex justify-between items-center text-sm">
                                <span>Bagaimana jika ada warga yang belum diisi nilainya pada kriteria tertentu?</span>
                                <svg class="w-5 h-5 text-slate-500 transition-transform"
                                    :class="openFaq === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openFaq === 2" x-collapse
                                class="p-4 bg-white text-xs text-slate-600 leading-relaxed border-t border-slate-200">
                                Sistem secara otomatis menginisialisasi nilai default (0). Admin disarankan untuk
                                melengkapi seluruh matriks nilai pada menu <strong>Input Nilai Matriks</strong> sebelum
                                mempublikasikan pengumuman penerima bansos.
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <button @click="openFaq = openFaq === 3 ? null : 3"
                                class="w-full p-4 text-left font-bold text-slate-800 bg-slate-50 hover:bg-slate-100 transition flex justify-between items-center text-sm">
                                <span>Berapa batas skala nilai untuk kriteria Pendapatan, Tanggungan, Kondisi Rumah, dan
                                    Daya Listrik?</span>
                                <svg class="w-5 h-5 text-slate-500 transition-transform"
                                    :class="openFaq === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openFaq === 3" x-collapse
                                class="p-4 bg-white text-xs text-slate-600 leading-relaxed border-t border-slate-200">
                                <ul class="space-y-1">
                                    <li>• <strong>C1 (Pendapatan Keluarga per Bulan)</strong>: Nominal Rupiah per Bulan
                                        (misal: <code>1500000</code>). Semakin kecil nilai, semakin tinggi prioritas
                                        (Cost).</li>
                                    <li>• <strong>C2 (Jumlah Tanggungan Keluarga)</strong>: Jumlah Jiwa (misal:
                                        <code>4</code>, diperbolehkan <code>0</code> jika tidak ada tanggungan). Semakin
                                        banyak tanggungan, semakin tinggi prioritas (Benefit).
                                    </li>
                                    <li>• <strong>C3 (Kondisi Rumah)</strong>: Skala range <strong>1 - 5</strong> (Skor
                                        1 = Sangat Baik, Skor 2 = Baik, Skor 3 = Cukup, Skor 4 = Memprihatinkan, Skor 5
                                        = Sangat Memprihatinkan). Semakin tinggi skor kondisi rumah (semakin
                                        memprihatinkan), semakin tinggi prioritas penerima bansos (Benefit).</li>
                                    <li>• <strong>C4 (Daya Listrik Rumah)</strong>: Nilai Watt VA (misal:
                                        <code>450</code>, <code>900</code>, <code>1300</code>). Semakin kecil daya
                                        listrik, semakin tinggi prioritas (Cost).
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <button @click="openFaq = openFaq === 4 ? null : 4"
                                class="w-full p-4 text-left font-bold text-slate-800 bg-slate-50 hover:bg-slate-100 transition flex justify-between items-center text-sm">
                                <span>Bagaimana jika data warga sangat banyak di dalam tabel?</span>
                                <svg class="w-5 h-5 text-slate-500 transition-transform"
                                    :class="openFaq === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openFaq === 4" x-collapse
                                class="p-4 bg-white text-xs text-slate-600 leading-relaxed border-t border-slate-200">
                                Setiap tabel telah dilengkapi <strong>Fitur Pencarian Real-Time</strong> (cari
                                berdasarkan NIK, Nama, Pekerjaan, atau RT) dan <strong>Pagination Modern</strong> yang
                                membatasi tampilan data per halaman agar layar tetap ringan dan mudah dibaca.
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="border border-slate-200 rounded-xl overflow-hidden">
                            <button @click="openFaq = openFaq === 5 ? null : 5"
                                class="w-full p-4 text-left font-bold text-slate-800 bg-slate-50 hover:bg-slate-100 transition flex justify-between items-center text-sm">
                                <span>Apakah laporan hasil penerima bansos dapat dicetak?</span>
                                <svg class="w-5 h-5 text-slate-500 transition-transform"
                                    :class="openFaq === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openFaq === 5" x-collapse
                                class="p-4 bg-white text-xs text-slate-600 leading-relaxed border-t border-slate-200">
                                Ya! Admin dapat mengklik tombol <strong>Cetak Laporan</strong> di menu Perhitungan SAW.
                                Sistem akan membuka halaman cetak laporan resmi yang siap dicetak langsung atau disimpan
                                sebagai PDF.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>