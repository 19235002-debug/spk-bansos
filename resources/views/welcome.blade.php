<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('app_name', 'SPK Bansos RT') }} - {{ setting('institution_name', 'Pengurus RT') }}</title>
    @if(setting('favicon') && file_exists(public_path(setting('favicon'))))
        <link rel="icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-indigo-500 selection:text-white min-h-screen flex flex-col justify-between overflow-x-hidden">

    <!-- Bright Ambient Background Gradient -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[650px] bg-gradient-to-tr from-indigo-200/50 via-purple-100/40 to-blue-50 blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-1/2 right-0 w-96 h-96 bg-violet-200/40 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-10 left-0 w-96 h-96 bg-indigo-200/40 rounded-full blur-3xl pointer-events-none -z-10"></div>

    <!-- Navigation Header -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/90 border-b border-slate-200/80 shadow-xs transition duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                    <img src="{{ asset(setting('app_logo')) }}" alt="Logo" class="h-10 w-auto object-contain">
                @else
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 via-indigo-700 to-violet-700 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition">
                        {{ strtoupper(substr(setting('app_name', 'SPK'), 0, 1)) }}
                    </div>
                @endif
                <div>
                    <span class="font-black text-lg text-slate-900 tracking-tight leading-none block uppercase group-hover:text-indigo-600 transition">{{ setting('app_name', 'SPK BANSOS RT') }}</span>
                    <span class="text-[10px] text-indigo-600 font-extrabold uppercase tracking-widest block mt-0.5">{{ setting('institution_name', 'Pengurus RT') }}</span>
                </div>
            </a>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden lg:flex items-center gap-5 xl:gap-6 text-xs font-bold uppercase tracking-wider text-slate-600">
                <a href="#beranda" class="hover:text-indigo-600 transition">Beranda</a>
                <a href="#benefit" class="hover:text-indigo-600 transition">Benefit</a>
                <a href="#syarat" class="hover:text-indigo-600 transition">Kriteria</a>
                <a href="#metode" class="hover:text-indigo-600 transition">Rumus SAW</a>
                <a href="#jadwal" class="hover:text-indigo-600 transition">Jadwal</a>
                <a href="#faq" class="hover:text-indigo-600 transition">FAQ</a>
                <a href="#kontak" class="hover:text-indigo-600 transition">Kontak</a>
            </nav>

            <!-- Auth Actions -->
            <div class="flex items-center gap-3 pl-4 lg:pl-6 lg:border-l lg:border-slate-200/80">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition shadow-md shadow-indigo-500/25 flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard Portal
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2.5 text-indigo-700 hover:text-indigo-900 border border-indigo-200 hover:border-indigo-400 bg-indigo-50/50 hover:bg-indigo-100/50 font-extrabold text-xs rounded-xl transition whitespace-nowrap">
                        Masuk Portal
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition shadow-md shadow-indigo-500/25 hidden sm:inline-flex items-center gap-2 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Daftar Akun
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO SECTION (BRIGHT, READABLE, & VIBRANT) -->
    <section id="beranda" class="relative pt-10 pb-16 md:pt-16 md:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                <!-- Hero Left Text -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <!-- Status Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-100 border border-indigo-200 text-indigo-800 text-xs font-bold shadow-xs">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        <span>Portal Resmi Seleksi Penerima Bantuan Sosial (Bansos) RT</span>
                    </div>

                    <!-- Main Title -->
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                        Sistem Pendukung Keputusan <br class="hidden sm:inline">
                        <span class="bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 bg-clip-text text-transparent">
                            Penerima Bansos RT
                        </span>
                    </h1>

                    <!-- Description -->
                    <p class="text-sm sm:text-base text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-medium">
                        Solusi terpadu untuk melakukan verifikasi data warga, kalkulasi otomatis matriks <strong class="text-indigo-700 font-bold">Simple Additive Weighting (SAW)</strong>, serta merangking calon penerima bantuan sosial secara <strong class="text-slate-900 font-bold">objektif, presisi, dan transparan</strong>.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        @auth
                            <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm rounded-2xl transition duration-150 shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                Buka Dashboard Portal
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-black text-sm rounded-2xl transition duration-150 shadow-lg shadow-indigo-600/30 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                                Daftar Warga Baru
                            </a>
                            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 bg-white hover:bg-slate-100 text-slate-800 border border-slate-300 font-extrabold text-sm rounded-2xl transition duration-150 flex items-center justify-center gap-2">
                                Masuk Ke Akun
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Hero Graphic Showcase (White Card Simulation) -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div class="absolute -inset-2 bg-gradient-to-r from-indigo-400 via-purple-300 to-indigo-300 rounded-3xl blur-xl opacity-50 pointer-events-none"></div>
                        
                        <div class="relative bg-white border border-slate-200/90 rounded-3xl p-6 sm:p-8 shadow-2xl space-y-6">
                            <!-- Card Header -->
                            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold shadow-md shadow-indigo-500/30">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-slate-900 text-sm">Pratinjau Simulasi SAW Engine</h4>
                                        <p class="text-[11px] text-slate-500 font-medium">Kalkulasi Skor Preferensi Akhir ($V_i$)</p>
                                    </div>
                                </div>
                                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 text-[10px] font-black rounded-lg uppercase">Engine Active</span>
                            </div>

                            <!-- Mock Ranking Rows -->
                            <div class="space-y-3">
                                <div class="p-3.5 rounded-2xl bg-indigo-50/70 border border-indigo-200/80 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-xl bg-indigo-600 text-white font-black text-xs flex items-center justify-center shadow-xs">#1</span>
                                        <div>
                                            <span class="font-extrabold text-xs text-slate-900 block">Rekomendasi Utama Bansos</span>
                                            <span class="text-[10px] text-indigo-700 font-medium">Skor Paling Optimal ($V_1$)</span>
                                        </div>
                                    </div>
                                    <span class="font-black text-sm text-indigo-700">0.9650</span>
                                </div>

                                <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-xl bg-slate-200 text-slate-700 font-bold text-xs flex items-center justify-center">#2</span>
                                        <div>
                                            <span class="font-bold text-xs text-slate-800 block">Kandidat Terverifikasi</span>
                                            <span class="text-[10px] text-slate-500 font-medium">Lolos Kualifikasi Penuh ($V_2$)</span>
                                        </div>
                                    </div>
                                    <span class="font-mono text-xs font-extrabold text-slate-700">0.8920</span>
                                </div>

                                <div class="p-3.5 rounded-2xl bg-slate-50/60 border border-slate-200 flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-xl bg-slate-200 text-slate-600 font-bold text-xs flex items-center justify-center">#3</span>
                                        <div>
                                            <span class="font-bold text-xs text-slate-700 block">Kandidat Cadangan</span>
                                            <span class="text-[10px] text-slate-500 font-medium">Memenuhi Syarat Minimal ($V_3$)</span>
                                        </div>
                                    </div>
                                    <span class="font-mono text-xs font-bold text-slate-600">0.8410</span>
                                </div>
                            </div>

                            <!-- Footer Micro Note -->
                            <div class="pt-3 text-[11px] text-slate-500 flex items-center justify-between border-t border-slate-100">
                                <span class="flex items-center gap-1.5 font-medium">
                                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Normalisasi Benefit & Cost Valid
                                </span>
                                <span class="font-bold text-indigo-600 uppercase text-[10px] tracking-wider">Metode SAW Engine</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BENEFIT & FASILITAS BANSOS -->
    <section id="benefit" class="py-16 bg-white border-y border-slate-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="px-3.5 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-extrabold uppercase tracking-wider">Manfaat Penerima</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Fasilitas & Penyaluran Bansos RT</h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 font-medium">
                    Program penyaluran bantuan sosial memberikan dukungan pokok dan finansial tepat sasaran bagi warga yang membutuhkan.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Benefit 1 -->
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 hover:border-indigo-300 transition shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mb-4 shadow-md shadow-indigo-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-base mb-1">Bantuan Subsidi Sembako & Tunai</h4>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Penyaluran paket kebutuhan pokok dan uang tunai secara berkala untuk warga penerima prioritas.
                    </p>
                </div>

                <!-- Benefit 2 -->
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 hover:border-indigo-300 transition shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mb-4 shadow-md shadow-indigo-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-base mb-1">Dukungan Penanganan Kesejahteraan</h4>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Pendataan langsung oleh pengurus RT agar bantuan tepat guna bagi keluarga pra-sejahtera.
                    </p>
                </div>

                <!-- Benefit 3 -->
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 hover:border-indigo-300 transition shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mb-4 shadow-md shadow-indigo-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-base mb-1">Transkrip Lolos PDF Official</h4>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Surat dan transkrip bukti hasil seleksi berstempel pengurus RT yang dapat diunduh langsung.
                    </p>
                </div>

                <!-- Benefit 4 -->
                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-200 hover:border-indigo-300 transition shadow-xs">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mb-4 shadow-md shadow-indigo-500/30">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-base mb-1">Transparansi Penilaian SAW</h4>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Perhitungan berbasis pembobotan matematis tanpa intervensi subjekif untuk menjaga keadilan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI DETIL KRITERIA & SUB-KRITERIA -->
    <section id="syarat" class="py-16 bg-slate-100/70 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="px-3.5 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-extrabold uppercase tracking-wider">Penilaian Terukur</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Detail Kriteria & Pembobotan Penilaian</h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 font-medium">
                    Setiap indikator dihitung berdasarkan bobot persentase resmi yang terstandarisasi.
                </p>
            </div>

            <!-- Kriteria Cards Grid -->
            @if(isset($kriteriaList) && count($kriteriaList) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach($kriteriaList as $item)
                        @php
                            $tipeKriteria = strtolower($item->tipe ?? $item->jenis ?? 'benefit');
                            $kodeKriteria = $item->kode_kriteria ?? $item->kode ?? '';
                        @endphp
                        <div class="p-6 bg-white rounded-2xl border border-slate-200 hover:border-indigo-400 transition shadow-xs flex flex-col justify-between group">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 rounded-xl text-[10px] font-black uppercase tracking-wider {{ $tipeKriteria == 'benefit' ? 'bg-emerald-100 text-emerald-800 border border-emerald-200' : 'bg-amber-100 text-amber-800 border border-amber-200' }}">
                                        {{ strtoupper($tipeKriteria) }}
                                    </span>
                                    <span class="font-mono text-xs font-bold text-indigo-700 bg-indigo-100 px-2.5 py-1 rounded-lg border border-indigo-200">
                                        {{ $kodeKriteria }}
                                    </span>
                                </div>
                                <h4 class="font-black text-slate-900 text-base mb-1 group-hover:text-indigo-600 transition">{{ $item->nama_kriteria }}</h4>
                                <p class="text-xs text-slate-600 font-medium mt-2 leading-relaxed">
                                    Atribut <strong class="text-slate-900">{{ ucfirst($tipeKriteria) }}</strong>: {{ $tipeKriteria == 'benefit' ? 'Semakin tinggi nilai yang diperoleh warga, semakin prioritas.' : 'Semakin rendah pendapatan/nilai, semakin prioritas.' }}
                                </p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-5">
                                <span class="text-xs text-slate-500 font-bold">Bobot Preferensi:</span>
                                <span class="font-black text-base text-indigo-700">{{ $item->bobot * 100 }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-xl text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">BENEFIT</span>
                            <span class="font-mono text-xs font-bold text-indigo-700 bg-indigo-100 px-2.5 py-1 rounded-lg">C1</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1">Indeks Prestasi Kumulatif (IPK)</h4>
                        <p class="text-xs text-slate-600 mt-1 font-medium">Semakin tinggi nilai IPK, semakin diprioritaskan.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-4 text-xs font-bold">
                            <span class="text-slate-500">Bobot Penilaian:</span>
                            <span class="text-indigo-700 font-black">35%</span>
                        </div>
                    </div>
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-xl text-[10px] font-black bg-amber-100 text-amber-800 border border-amber-200 uppercase">COST</span>
                            <span class="font-mono text-xs font-bold text-indigo-700 bg-indigo-100 px-2.5 py-1 rounded-lg">C2</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1">Pendapatan Orang Tua</h4>
                        <p class="text-xs text-slate-600 mt-1 font-medium">Semakin rendah pendapatan, semakin diprioritaskan.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-4 text-xs font-bold">
                            <span class="text-slate-500">Bobot Penilaian:</span>
                            <span class="text-indigo-700 font-black">30%</span>
                        </div>
                    </div>
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 rounded-xl text-[10px] font-black bg-emerald-100 text-emerald-800 border border-emerald-200 uppercase">BENEFIT</span>
                            <span class="font-mono text-xs font-bold text-indigo-700 bg-indigo-100 px-2.5 py-1 rounded-lg">C3</span>
                        </div>
                        <h4 class="font-black text-slate-900 text-base mb-1">Prestasi Non-Akademik</h4>
                        <p class="text-xs text-slate-600 mt-1 font-medium">Semakin banyak sertifikat juara, semakin diprioritaskan.</p>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-4 text-xs font-bold">
                            <span class="text-slate-500">Bobot Penilaian:</span>
                            <span class="text-indigo-700 font-black">20%</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Syarat Dokumen & Ketentuan Umum Card -->
            <div class="bg-gradient-to-r from-indigo-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-8 sm:p-10 shadow-xl grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="font-black text-xl text-white mb-4 flex items-center gap-2.5">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ketentuan Umum Pendaftar
                    </h4>
                    <ul class="space-y-3 text-xs text-slate-300 font-medium">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Warga domisili resmi terdaftar dengan Nomor Induk Kependudukan (NIK).</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Memenuhi kriteria tingkat pendapatan dan kelayakan hunian keluarga.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            <span>Tidak sedang menerima bantuan ganda dari program bansos lain yang setara.</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-xl text-white mb-4 flex items-center gap-2.5">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7h8m0 0v9a2 2 0 01-2 2h-6"/></svg>
                        Dokumen Verifikasi Pendaftaran
                    </h4>
                    <ul class="space-y-3 text-xs text-slate-300 font-medium">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Fotokopi Kartu Tanda Penduduk (KTP) & Kartu Keluarga (KK) berlaku.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Surat Keterangan Pengantar RT atau SKTM Kelurahan.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span>Bukti rekening listrik / foto kondisi ketidaklayakan rumah.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA & RUMUS MATEMATIKA SAW ENGINE -->
    <section id="metode" class="py-16 bg-white border-b border-slate-200 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="px-3.5 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-extrabold uppercase tracking-wider">Metodologi Keputusan</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Bagaimana Rumus SAW Bekerja?</h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 font-medium">
                    Penjelasan sederhana kalkulasi Simple Additive Weighting dalam 3 langkah mudah dipahami.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center mb-5 group-hover:scale-105 transition shadow-md shadow-indigo-500/30">
                        1
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-2">1. Pengumpulan Matriks ($X$)</h4>
                    <p class="text-slate-600 text-xs leading-relaxed font-medium">
                        Seluruh skor kriteria warga disusun dalam bentuk matriks keputusan $X$. Setiap kolom mewakili indikator penilaian yang terverifikasi.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center mb-5 group-hover:scale-105 transition shadow-md shadow-indigo-500/30">
                        2
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-2">2. Normalisasi Matriks ($R$)</h4>
                    <p class="text-slate-600 text-xs leading-relaxed font-medium">
                        Mengubah skala angka menjadi 0 hingga 1. Untuk atribut <strong class="text-emerald-700 font-bold">Benefit</strong> (skor / max) dan <strong class="text-amber-700 font-bold">Cost</strong> (min / skor).
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200 shadow-sm hover:shadow-md transition group">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-xl flex items-center justify-center mb-5 group-hover:scale-105 transition shadow-md shadow-indigo-500/30">
                        3
                    </div>
                    <h4 class="font-extrabold text-slate-900 text-lg mb-2">3. Skor Preferensi ($V_i$)</h4>
                    <p class="text-slate-600 text-xs leading-relaxed font-medium">
                        Mengalikan matriks ternormalisasi $R$ dengan bobot $W$, kemudian dijumlahkan $V_i = \sum (w_j \times r_{ij})$ untuk menentukan posisi perangkingan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- JADWAL & LINIMASA SELEKSI -->
    <section id="jadwal" class="py-16 bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="px-3.5 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-extrabold uppercase tracking-wider">Agenda Kegiatan</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Linimasa Tahapan Seleksi Bansos</h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 font-medium">
                    Pastikan Anda memperhatikan jadwal tahapan berikut agar proses pengajuan berjalan lancar.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Step 1 -->
                <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs relative flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-4">Tahap 1</span>
                        <h4 class="font-extrabold text-slate-900 text-base mb-1">Registrasi & Koneksi NIK</h4>
                        <p class="text-xs text-slate-500 font-medium">Warga membuat akun di portal dan menautkan NIK resmi.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 font-bold text-xs text-indigo-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>01 - 15 Oktober 2026</span>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs relative flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-4">Tahap 2</span>
                        <h4 class="font-extrabold text-slate-900 text-base mb-1">Verifikasi Data Kriteria</h4>
                        <p class="text-xs text-slate-500 font-medium">Panitia Admin melakukan verifikasi berkas dan validasi sub-kriteria.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 font-bold text-xs text-indigo-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>16 - 20 Oktober 2026</span>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs relative flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-4">Tahap 3</span>
                        <h4 class="font-extrabold text-slate-900 text-base mb-1">Kalkulasi Engine SAW</h4>
                        <p class="text-xs text-slate-500 font-medium">Sistem secara otomatis mengolah matriks normalisasi dan pembobotan.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 font-bold text-xs text-indigo-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>21 Oktober 2026</span>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-xs relative flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-4">Tahap 4</span>
                        <h4 class="font-extrabold text-slate-900 text-base mb-1">Pengumuman & Cetak PDF</h4>
                        <p class="text-xs text-slate-500 font-medium">Pengumuman peringkat penerima bansos dan unduh transkrip bukti lolos.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 font-bold text-xs text-indigo-700 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>22 Oktober 2026</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION (ALPINE ACCORDION) -->
    <section id="faq" class="py-16 bg-white border-b border-slate-200" x-data="{ active: 1 }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <span class="px-3.5 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-extrabold uppercase tracking-wider">Bantuan Pendaftar</span>
                <h2 class="text-2xl sm:text-4xl font-black text-slate-900 tracking-tight mt-3">Pertanyaan Yang Sering Diajukan (FAQ)</h2>
                <p class="mt-2 text-xs sm:text-sm text-slate-600 font-medium">
                    Jawaban cepat atas pertanyaan seputar pendaftaran, mekanisme penilaian, dan pencetakan bukti lolos.
                </p>
            </div>

            <div class="max-w-4xl mx-auto space-y-4">
                <!-- Question 1 -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = active === 1 ? null : 1" class="w-full p-5 text-left font-extrabold text-sm text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Bagaimana cara menautkan NIK jika saya mendaftar akun baru?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0" :class="{ 'rotate-180': active === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-5 pb-5 text-xs text-slate-600 leading-relaxed font-medium border-t border-slate-200/60 pt-3">
                        Setelah berhasil mendaftar akun, silakan masuk ke <strong class="text-indigo-600">Dashboard Warga</strong>. Jika data Anda belum terhubung, gunakan fitur tombol <strong>"Koneksi NIK"</strong> dan masukkan NIK resmi Anda untuk langsung menarik data domisili.
                    </div>
                </div>

                <!-- Question 2 -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = active === 2 ? null : 2" class="w-full p-5 text-left font-extrabold text-sm text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Apakah hasil perangkingan bansos ini terjamin transparan?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0" :class="{ 'rotate-180': active === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-5 pb-5 text-xs text-slate-600 leading-relaxed font-medium border-t border-slate-200/60 pt-3">
                        Sangat transparan. Sistem menggunakan algoritma matematika terstandar <strong class="text-indigo-600">Simple Additive Weighting (SAW)</strong>. Matriks keputusan, nilai normalisasi, dan pembobotan kriteria dapat dilihat serta diverifikasi secara terbuka oleh warga.
                    </div>
                </div>

                <!-- Question 3 -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = active === 3 ? null : 3" class="w-full p-5 text-left font-extrabold text-sm text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Bagaimana cara mengunduh bukti transkrip hasil seleksi bansos?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0" :class="{ 'rotate-180': active === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-5 pb-5 text-xs text-slate-600 leading-relaxed font-medium border-t border-slate-200/60 pt-3">
                        Warga yang terdaftar dapat menekan tombol <strong class="text-indigo-600">"Cetak Transkrip PDF"</strong> di Dashboard Warga atau halaman Pengumuman Bansos untuk langsung mengunduh file PDF resmi lengkap dengan ringkasan skor.
                    </div>
                </div>

                <!-- Question 4 -->
                <div class="bg-slate-50 rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = active === 4 ? null : 4" class="w-full p-5 text-left font-extrabold text-sm text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Apakah saya masih bisa memperbarui nilai atau berkas pengajuan?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0" :class="{ 'rotate-180': active === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="active === 4" x-collapse class="px-5 pb-5 text-xs text-slate-600 leading-relaxed font-medium border-t border-slate-200/60 pt-3">
                        Perubahan data kriteria dapat dilakukan selama masa periode pengisian data belum ditutup oleh Panitia Admin. Setelah masa verifikasi berakhir, data akan dikunci untuk proses pengolahan matriks SAW.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION BANNER -->
    <section class="py-14 bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-700 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h3 class="text-2xl sm:text-4xl font-black tracking-tight mb-3">Siap Mengikuti Seleksi Penerimaan Bansos?</h3>
            <p class="text-xs sm:text-sm text-indigo-100 max-w-2xl mx-auto mb-8 font-medium">
                Daftarkan akun Warga Anda sekarang dan lengkapi kriteria penilaian untuk bergabung dalam seleksi resmi.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-white hover:bg-slate-100 text-indigo-900 font-black text-sm rounded-2xl transition shadow-lg">
                        Buka Dashboard Portal
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white hover:bg-slate-100 text-indigo-900 font-black text-sm rounded-2xl transition shadow-lg">
                        Daftar Akun Warga
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-indigo-800/60 hover:bg-indigo-800 text-white border border-indigo-400/50 font-bold text-sm rounded-2xl transition">
                        Masuk Portal Akun
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- FOOTER & KONTAK (DYNAMIC SETTINGS DRIVEN) -->
    <footer id="kontak" class="bg-slate-900 text-slate-400 text-xs py-14 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-10 pb-10 border-b border-slate-800">
                <!-- Col 1: Brand Info -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                            <img src="{{ asset(setting('app_logo')) }}" alt="Logo" class="h-10 w-auto object-contain">
                        @else
                            <div class="w-10 h-10 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-black text-lg shadow-md shadow-indigo-500/30">
                                {{ strtoupper(substr(setting('app_name', 'SPK'), 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <span class="font-black text-white text-base block uppercase tracking-tight">{{ setting('app_name', 'SPK BANSOS RT/RW') }}</span>
                            <span class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider block">{{ setting('institution_name', 'Pengurus RT/RW Bansos') }}</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-md">
                        Sistem Pendukung Keputusan Pemilihan Calon Penerima Bantuan Sosial (Bansos) Warga dengan Metode Simple Additive Weighting (SAW). Platform resmi terintegrasi dan transparan.
                    </p>
                </div>

                <!-- Col 2: Quick Links -->
                <div class="md:col-span-3 space-y-3">
                    <h5 class="font-extrabold text-white text-sm uppercase tracking-wider">Tautan Pintar</h5>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#beranda" class="hover:text-indigo-400 transition">Beranda Utama</a></li>
                        <li><a href="#benefit" class="hover:text-indigo-400 transition">Fasilitas Bansos</a></li>
                        <li><a href="#syarat" class="hover:text-indigo-400 transition">Syarat & Kriteria</a></li>
                        <li><a href="#metode" class="hover:text-indigo-400 transition">Metode SAW Engine</a></li>
                        <li><a href="#jadwal" class="hover:text-indigo-400 transition">Jadwal Seleksi</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-400 transition">Portal Login</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Helpdesk (Dynamic Settings Driven with SVG Icons) -->
                <div class="md:col-span-4 space-y-3">
                    <h5 class="font-extrabold text-white text-sm uppercase tracking-wider">Layanan Informasi System</h5>
                    <ul class="space-y-3 text-xs text-slate-300">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>{{ setting('address', 'Kantor Pengurus RT 05 / RW 03, Kelurahan Setempat') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span>{{ setting('contact_email', 'admin@rtrw.id') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>{{ setting('contact_phone', '0812-3456-7890') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="flex flex-col sm:flex-row items-center justify-between text-[11px] text-slate-500 gap-4">
                <div>
                    {{ str_replace('{year}', date('Y'), setting('footer_text', '© ' . date('Y') . ' ' . setting('app_name', 'SPK Bansos RT/RW') . ' - ' . setting('institution_name', 'Pengurus RT/RW Bansos') . '. All rights reserved.')) }}
                </div>
                <div class="font-mono text-indigo-400 font-bold">
                    SAW Engine Version v2.0
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
