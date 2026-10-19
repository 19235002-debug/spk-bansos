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

    <!-- Fonts: Inter / Figtree -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-slate-50 text-slate-800 selection:bg-indigo-600 selection:text-white min-h-screen flex flex-col justify-between overflow-x-hidden"
    x-data="{ mobileMenu: false }">

    <!-- Ambient Gradient Background Elements -->
    <div
        class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[600px] bg-gradient-to-tr from-indigo-100/60 via-purple-50/50 to-blue-50/60 blur-3xl pointer-events-none -z-10">
    </div>
    <div class="fixed top-1/3 right-0 w-80 h-80 bg-violet-100/50 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed bottom-10 left-0 w-80 h-80 bg-indigo-100/50 rounded-full blur-3xl pointer-events-none -z-10">
    </div>

    <!-- Navigation Header -->
    <header
        class="sticky top-0 z-50 backdrop-blur-md bg-white/95 border-b border-slate-200/90 shadow-xs transition duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3.5 group">
                @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                    <img src="{{ asset(setting('app_logo')) }}" alt="Logo" class="h-11 w-auto object-contain">
                @else
                    <div
                        class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-700 flex items-center justify-center text-white font-black text-xl shadow-md shadow-indigo-500/25 group-hover:scale-105 transition">
                        {{ strtoupper(substr(setting('app_name', 'SPK'), 0, 1)) }}
                    </div>
                @endif
                <div>
                    <span
                        class="font-black text-base sm:text-lg text-slate-900 tracking-tight leading-tight block group-hover:text-indigo-600 transition">
                        {{ setting('app_name', 'SPK BANSOS RT') }}
                    </span>
                    <span class="text-xs text-indigo-600 font-semibold block capitalize">
                        {{ \Illuminate\Support\Str::title(setting('institution_name', 'Pengurus RT 011/04 Kelurahan Jelambar')) }}
                    </span>
                </div>
            </a>

            <!-- Desktop Nav Links (Simpel, Ringkas, & Lega) -->
            <nav class="hidden lg:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#alur" class="hover:text-indigo-600 transition py-1">Alur</a>
                <a href="#kriteria" class="hover:text-indigo-600 transition py-1">Kriteria</a>
                <a href="#syarat" class="hover:text-indigo-600 transition py-1">Syarat</a>
                <a href="#jadwal" class="hover:text-indigo-600 transition py-1">Jadwal</a>
                <a href="#faq" class="hover:text-indigo-600 transition py-1">FAQ</a>
            </nav>

            <!-- Action Buttons -->
            <div class="hidden sm:flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition shadow-md shadow-indigo-600/25 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-4 py-2.5 text-slate-700 hover:text-indigo-600 font-bold text-sm rounded-xl transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition shadow-md shadow-indigo-600/25 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar Warga
                    </a>
                @endauth
            </div>

            <!-- Mobile Hamburger Toggle -->
            <div class="flex items-center lg:hidden">
                <button @click="mobileMenu = !mobileMenu" type="button"
                    class="p-2 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition focus:outline-none"
                    aria-label="Toggle menu">
                    <svg x-show="!mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="mobileMenu" x-transition.origin.top
            class="lg:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 space-y-2 shadow-lg">
            <a @click="mobileMenu = false" href="#alur"
                class="block px-3 py-2 rounded-lg text-slate-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition">Alur
                Pendaftaran</a>
            <a @click="mobileMenu = false" href="#kriteria"
                class="block px-3 py-2 rounded-lg text-slate-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition">Kriteria
                Penilaian</a>
            <a @click="mobileMenu = false" href="#syarat"
                class="block px-3 py-2 rounded-lg text-slate-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition">Syarat
                & Dokumen</a>
            <a @click="mobileMenu = false" href="#jadwal"
                class="block px-3 py-2 rounded-lg text-slate-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition">Jadwal</a>
            <a @click="mobileMenu = false" href="#faq"
                class="block px-3 py-2 rounded-lg text-slate-700 font-semibold hover:bg-indigo-50 hover:text-indigo-600 transition">FAQ</a>

            <div class="pt-3 border-t border-slate-100 flex flex-col gap-2">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="w-full text-center py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl">Buka
                        Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="w-full text-center py-2.5 bg-slate-100 text-slate-800 font-bold text-sm rounded-xl">Masuk
                        Akun</a>
                    <a href="{{ route('register') }}"
                        class="w-full text-center py-2.5 bg-indigo-600 text-white font-bold text-sm rounded-xl shadow-md">Daftar
                        Warga</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- 1. HERO SECTION -->
    <section id="beranda" class="relative pt-8 pb-16 md:pt-14 md:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                <!-- Hero Left: Text & Primary Actions -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <!-- Status Badge -->
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-800 text-xs sm:text-sm font-semibold shadow-xs">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Portal Resmi Penerimaan Bantuan Sosial Warga RT</span>
                    </div>

                    <!-- Main Catchy Title -->
                    <h1 class="text-3xl sm:text-5xl lg:text-5xl font-black text-slate-900 tracking-tight leading-tight">
                        Penyaluran Bantuan Sosial <br class="hidden sm:inline">
                        <span class="text-indigo-600">Lebih Adil, Transparan, & Tepat Sasaran</span>
                    </h1>

                    <!-- Clear, Human-Friendly Description -->
                    <p
                        class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Sistem resmi pengurus RT untuk membantu warga mengajukan bantuan, memvalidasi data keluarga, dan
                        menghitung kelayakan secara adil menggunakan pembobotan otomatis tanpa pilih kasih.
                    </p>

                    <!-- Key Stat Highlights (Easy to digest) -->
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 max-w-lg mx-auto lg:mx-0 py-2">
                        <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200 text-center shadow-xs">
                            <span
                                class="block text-xl sm:text-2xl font-black text-indigo-600">{{ $totalWarga ?? 0 }}</span>
                            <span class="text-xs text-slate-600 font-semibold mt-0.5 block">Warga Terdata</span>
                        </div>
                        <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200 text-center shadow-xs">
                            <span
                                class="block text-xl sm:text-2xl font-black text-indigo-600">{{ $totalKriteria ?? 4 }}</span>
                            <span class="text-xs text-slate-600 font-semibold mt-0.5 block">Kriteria Terukur</span>
                        </div>
                        <div class="bg-white p-3.5 sm:p-4 rounded-2xl border border-slate-200 text-center shadow-xs">
                            <span class="block text-xl sm:text-2xl font-black text-emerald-600">100%</span>
                            <span class="text-xs text-slate-600 font-semibold mt-0.5 block">Transparan</span>
                        </div>
                    </div>


                </div>

                <!-- Hero Right: Interactive Citizen-Friendly Preview Card -->
                <!-- Hero Right: Interactive Cek NIK Bansos Widget (Tanpa Login) -->
                <div class="lg:col-span-5 relative" id="cek-status">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        <div
                            class="absolute -inset-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-indigo-600 rounded-3xl blur-lg opacity-25">
                        </div>

                        <div x-data="{
                            query: '',
                            loading: false,
                            result: null,
                            error: null,
                            checkNik() {
                                if (!this.query.trim()) return;
                                this.loading = true;
                                this.error = null;
                                this.result = null;
                                fetch('{{ route('cek.nik') }}?nik=' + encodeURIComponent(this.query.trim()))
                                    .then(res => res.json())
                                    .then(data => {
                                        this.loading = false;
                                        if (data.status === 'success' || data.status === 'pending') {
                                            this.result = data.data;
                                        } else {
                                            this.error = data.message || 'Data NIK tidak ditemukan dalam sistem seleksi RT.';
                                        }
                                    })
                                    .catch(err => {
                                        this.loading = false;
                                        this.error = 'Gagal menghubungi server. Silakan periksa koneksi Anda.';
                                    });
                            },
                            resetCheck() {
                                this.query = '';
                                this.result = null;
                                this.error = null;
                            },
                            quickCheck(val) {
                                this.query = val;
                                this.checkNik();
                            }
                        }"
                            class="relative bg-white border border-slate-200 rounded-3xl p-6 sm:p-7 shadow-xl space-y-5">

                            <!-- Widget Header -->
                            <div class="flex items-center justify-between gap-3 border-b border-slate-100 pb-4">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div
                                        class="w-10 h-10 shrink-0 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-600/30">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0">
                                        <h3 class="font-extrabold text-slate-900 text-base leading-tight">Cek Status Bansos RT</h3>
                                        <p class="text-xs text-slate-500 leading-tight mt-0.5">Cek kelayakan instan tanpa perlu login</p>
                                    </div>
                                </div>
                                <span
                                    class="shrink-0 px-2.5 py-1 bg-emerald-50 text-emerald-700 text-[11px] font-bold rounded-full border border-emerald-200 whitespace-nowrap">
                                    Hasil Realtime
                                </span>
                            </div>

                            <!-- STATE 1: SEARCH FORM (Ketika Belum Ada Hasil / Reset) -->
                            <div x-show="!result && !error" class="space-y-4">
                                <form @submit.prevent="checkNik()" class="space-y-3">
                                    <div>
                                        <label for="input-nik" class="block text-xs font-bold text-slate-700 mb-1.5">
                                            Nomor Induk Kependudukan (NIK) atau Nama:
                                        </label>
                                        <div class="relative">
                                            <input id="input-nik" type="text" x-model="query"
                                                placeholder="Ketik 16 digit NIK atau Nama..." required
                                                class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-300 rounded-xl text-sm font-semibold text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition placeholder:text-slate-400" />
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" :disabled="loading || !query.trim()"
                                        class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 disabled:bg-slate-300 text-white font-bold text-sm rounded-xl transition duration-150 shadow-md shadow-indigo-600/25 flex items-center justify-center gap-2">
                                        <template x-if="!loading">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                                Periksa Status Kelayakan
                                            </span>
                                        </template>
                                        <template x-if="loading">
                                            <span class="flex items-center gap-2">
                                                <svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                                        stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor"
                                                        d="M4 12a8 8 0 018-8v8H4z"></path>
                                                </svg>
                                                Memeriksa Data Kelayakan...
                                            </span>
                                        </template>
                                    </button>
                                </form>

                                <div
                                    class="pt-2 text-[11px] text-slate-500 flex items-center gap-1.5 border-t border-slate-100">
                                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                    <span>Privasi aman: Digit tengah NIK disamarkan otomatis.</span>
                                </div>
                            </div>

                            <!-- STATE 2: HASIL DITEMUKAN (SUCCESS RESULT CARD) -->
                            <div x-show="result" class="space-y-4" style="display: none;">
                                <!-- Status Banner -->
                                <div class="p-4 rounded-2xl border" :class="{
                                        'bg-emerald-50 border-emerald-300 text-emerald-950': result && result.status_type === 'lulus',
                                        'bg-amber-50 border-amber-300 text-amber-950': result && result.status_type === 'cadangan',
                                        'bg-slate-100 border-slate-300 text-slate-900': result && result.status_type === 'tidak_lulus',
                                        'bg-sky-50 border-sky-300 text-sky-950': result && result.status_type === 'pending'
                                    }">
                                    <div class="flex items-center justify-between mb-1.5">
                                        <span
                                            class="px-2.5 py-0.5 rounded-full text-[11px] font-black uppercase tracking-wider"
                                            :class="{
                                                'bg-emerald-200 text-emerald-900': result && result.status_type === 'lulus',
                                                'bg-amber-200 text-amber-900': result && result.status_type === 'cadangan',
                                                'bg-slate-200 text-slate-800': result && result.status_type === 'tidak_lulus',
                                                'bg-sky-200 text-sky-900': result && result.status_type === 'pending'
                                            }" x-text="result ? result.status_title : ''"></span>
                                        <span class="text-xs font-bold opacity-80"
                                            x-text="result ? result.rt_rw : ''"></span>
                                    </div>

                                    <h4 class="text-lg font-black" x-text="result ? result.nama : ''"></h4>
                                    <p class="text-xs font-mono opacity-90 mt-0.5">NIK: <span
                                            x-text="result ? result.nik_masked : ''"></span></p>
                                    <p class="text-xs mt-2 leading-relaxed opacity-95"
                                        x-text="result ? result.status_desc : ''"></p>
                                </div>

                                <!-- Metric Highlights (Bahasa Ramah Warga) -->
                                <div class="grid grid-cols-3 gap-2" x-show="result && result.rank">
                                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-center">
                                        <span class="text-[10px] font-bold uppercase text-slate-500 block">Peringkat</span>
                                        <span class="text-base font-black text-indigo-700 block mt-0.5">
                                            #<span x-text="result ? result.rank : '-'"></span>
                                            <span class="text-[10px] font-semibold text-slate-500">/<span
                                                    x-text="result ? result.total_peserta : '-'"></span></span>
                                        </span>
                                    </div>
                                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-center">
                                        <span class="text-[10px] font-bold uppercase text-slate-500 block">Kode</span>
                                        <span class="text-sm font-mono font-black text-indigo-800 block mt-1" x-text="result ? result.kode : '-'"></span>
                                    </div>
                                    <div class="p-2.5 bg-slate-50 rounded-xl border border-slate-200 text-center">
                                        <span class="text-[10px] font-bold uppercase text-slate-500 block">Skor Vi</span>
                                        <span class="text-xs font-mono font-black text-slate-900 block mt-1" x-text="result ? result.score : '-'"></span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2 pt-1">
                                    <button @click="resetCheck()" type="button"
                                        class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl transition">
                                        &larr; Cek NIK Lain
                                    </button>
                                    <a href="{{ route('login') }}"
                                        class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition text-center shadow-sm">
                                        Masuk & Unduh PDF
                                    </a>
                                </div>
                            </div>

                            <!-- STATE 3: ERROR / TIDAK DITEMUKAN -->
                            <div x-show="error" class="space-y-4" style="display: none;">
                                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 space-y-2">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <h4 class="font-extrabold text-sm">Data Tidak Ditemukan</h4>
                                    </div>
                                    <p class="text-xs leading-relaxed" x-text="error"></p>
                                </div>

                                <div
                                    class="p-3.5 bg-slate-50 rounded-xl border border-slate-200 text-xs text-slate-600 space-y-1">
                                    <p class="font-bold text-slate-800">Belum terdaftar sebagai penerima bansos?</p>
                                    <p>Anda dapat membuat akun warga baru untuk mengajukan diri ke pengurus RT.</p>
                                </div>

                                <div class="flex items-center gap-2 pt-1">
                                    <button @click="resetCheck()" type="button"
                                        class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl transition">
                                        Coba Cari Lagi
                                    </button>
                                    <a href="{{ route('register') }}"
                                        class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs rounded-xl transition text-center shadow-sm">
                                        Daftar Warga Baru
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- 2. ALUR PENDAFTARAN (3 LANGKAH MUDAH) -->
    <section id="alur" class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span
                    class="px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    Panduan Warga
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    3 Langkah Mudah Mengikuti Seleksi Bansos
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Proses pendaftaran dirancang sederhana dan dapat diakses langsung oleh seluruh warga RT melalui
                    handphone atau komputer.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div
                    class="bg-slate-50 p-7 rounded-3xl border border-slate-200 hover:border-indigo-300 transition duration-150 relative flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-lg flex items-center justify-center mb-5 shadow-md shadow-indigo-600/30">
                            1
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg mb-2">Buat Akun & Verifikasi NIK</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Daftarkan akun menggunakan email Anda, lalu lakukan klaim NIK (Nomor Induk Kependudukan)
                            sesuai KTP agar tersambung dengan database warga RT.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-slate-200/80 text-xs text-indigo-700 font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                        Hanya butuh NIK & data KTP
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    class="bg-slate-50 p-7 rounded-3xl border border-slate-200 hover:border-indigo-300 transition duration-150 relative flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-lg flex items-center justify-center mb-5 shadow-md shadow-indigo-600/30">
                            2
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg mb-2">Lengkapi Data Kriteria Mandiri</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Isi informasi kriteria keluarga Anda dengan jujur: nominal pendapatan bulanan, jumlah
                            tanggungan, kondisi rumah, dan daya listrik terpasang.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-slate-200/80 text-xs text-indigo-700 font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                        Bisa diperbarui sewaktu-waktu
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    class="bg-slate-50 p-7 rounded-3xl border border-slate-200 hover:border-indigo-300 transition duration-150 relative flex flex-col justify-between">
                    <div>
                        <div
                            class="w-12 h-12 rounded-2xl bg-indigo-600 text-white font-black text-lg flex items-center justify-center mb-5 shadow-md shadow-indigo-600/30">
                            3
                        </div>
                        <h3 class="font-extrabold text-slate-900 text-lg mb-2">Pantau Hasil & Cetak Bukti</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Setelah periode seleksi selesai, sistem langsung menampilkan status kelayakan Anda. Warga
                            yang lolos dapat langsung mencetak transkrip surat bukti resmi PDF.
                        </p>
                    </div>
                    <div
                        class="mt-6 pt-4 border-t border-slate-200/80 text-xs text-indigo-700 font-bold flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Surat bukti berstempel pengurus RT
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. KRITERIA PENILAIAN BANSOS (TRANSPARAN & MUDAH DIPAHAMI) -->
    <section id="kriteria" class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span
                    class="px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    Dasar Penilaian
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    Kriteria Resmi Penilaian Bantuan Sosial
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Tidak ada penilaian rahasia. Seluruh calon penerima dinilai secara terbuka berdasarkan 4 indikator
                    berikut:
                </p>
            </div>

            <!-- Dynamic or Bansos-Tailored Cards -->
            @if(isset($kriteriaList) && count($kriteriaList) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($kriteriaList as $item)
                        @php
                            $tipe = strtolower($item->tipe ?? $item->jenis ?? 'benefit');
                            $kode = $item->kode_kriteria ?? $item->kode ?? '';
                            $bobotPersen = round(($item->bobot ?? 0) * 100);
                        @endphp
                        <div
                            class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs hover:border-indigo-400 hover:shadow-md transition flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-4">
                                    <span
                                        class="px-3 py-1 rounded-xl text-xs font-extrabold uppercase {{ $tipe == 'cost' ? 'bg-amber-50 text-amber-800 border border-amber-200' : 'bg-emerald-50 text-emerald-800 border border-emerald-200' }}">
                                        {{ $tipe == 'cost' ? 'Nilai Rendah Didahulukan' : 'Nilai Tinggi Didahulukan' }}
                                    </span>
                                    <span
                                        class="font-bold text-xs text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">
                                        {{ $kode }}
                                    </span>
                                </div>
                                <h3 class="font-extrabold text-slate-900 text-base mb-2">
                                    {{ $item->nama_kriteria }}
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                    @if($tipe == 'cost')
                                        Semakin kecil nilainya (misal: pendapatan lebih rendah atau daya listrik lebih kecil),
                                        semakin diprioritaskan.
                                    @else
                                        Semakin tinggi nilainya (misal: jumlah tanggungan lebih banyak atau tingkat urgensi rumah),
                                        semakin diprioritaskan.
                                    @endif
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-xs text-slate-500 font-semibold">Bobot Penilaian:</span>
                                <span class="text-lg font-black text-indigo-700">{{ $bobotPersen }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback 4 Standar Bansos RT -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Kriteria 1: Pendapatan -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="px-3 py-1 rounded-xl text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    Nilai Rendah Didahulukan
                                </span>
                                <span
                                    class="font-bold text-xs text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">C1</span>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base mb-2">Pendapatan Bulanan Keluarga</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Total pemasukan seluruh anggota keluarga per bulan. Keluarga berpenghasilan lebih rendah
                                berhak atas prioritas lebih tinggi.
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-semibold">Bobot Penilaian:</span>
                            <span class="text-lg font-black text-indigo-700">35%</span>
                        </div>
                    </div>

                    <!-- Kriteria 2: Tanggungan -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="px-3 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    Nilai Tinggi Didahulukan
                                </span>
                                <span
                                    class="font-bold text-xs text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">C2</span>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base mb-2">Jumlah Tanggungan Keluarga</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Jumlah anak, lansia, atau anggota keluarga yang belum bekerja dalam satu kartu keluarga
                                (KK).
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-semibold">Bobot Penilaian:</span>
                            <span class="text-lg font-black text-indigo-700">25%</span>
                        </div>
                    </div>

                    <!-- Kriteria 3: Kondisi Rumah -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="px-3 py-1 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                                    Nilai Tinggi Didahulukan
                                </span>
                                <span
                                    class="font-bold text-xs text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">C3</span>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base mb-2">Kondisi Bangunan Rumah</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Tingkat kelayakan fisik rumah tinggal (keadaan lantai, dinding, atap, dan sanitasi
                                keluarga).
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-semibold">Bobot Penilaian:</span>
                            <span class="text-lg font-black text-indigo-700">20%</span>
                        </div>
                    </div>

                    <!-- Kriteria 4: Daya Listrik -->
                    <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-xs flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="px-3 py-1 rounded-xl text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    Nilai Rendah Didahulukan
                                </span>
                                <span
                                    class="font-bold text-xs text-indigo-700 bg-indigo-50 px-2.5 py-1 rounded-lg border border-indigo-200">C4</span>
                            </div>
                            <h3 class="font-extrabold text-slate-900 text-base mb-2">Kapasitas Daya Listrik (VA)</h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                                Daya listrik PLN yang terpasang di rumah tinggal (daya 450 VA diprioritaskan di atas 900 VA
                                atau 1300 VA).
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs text-slate-500 font-semibold">Bobot Penilaian:</span>
                            <span class="text-lg font-black text-indigo-700">20%</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- 4. CARA KERJA SISTEM (TRANSPARAN TANPA FORMULA RUMIT) -->
    <section id="transparansi" class="py-16 bg-white border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span
                    class="px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    Jaminan Keadilan
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    Bagaimana Sistem Menentukan Kelayakan?
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Sistem seleksi menggunakan metode penilaian objektif berstandar resmi agar seluruh keputusan murni
                    berdasarkan data faktual keluarga, bebas prasangka, dan adil untuk seluruh warga.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Point 1 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base mb-2">1. Bebas Pilih Kasih (Objektif)</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pengurus RT tidak menentukan kelayakan secara manual. Sistem menghitung langsung dari angka riil
                        yang diunggah warga, menjamin keadilan bagi siapa pun yang mengajukan.
                    </p>
                </div>

                <!-- Point 2 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base mb-2">2. Transparansi Nilai Penuh</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Warga dapat melihat rincian nilai kelayakan masing-masing di dashboard. Nilai akhir merupakan
                        gabungan persentase bobot kriteria yang jelas tanpa rumus tersembunyi.
                    </p>
                </div>

                <!-- Point 3 -->
                <div class="p-6 bg-slate-50 rounded-3xl border border-slate-200">
                    <div
                        class="w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-slate-900 text-base mb-2">3. Bukti Transkrip Berstempel</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Hasil seleksi dapat diunduh langsung dalam format PDF resmi dengan nomor surat dan stempel
                        pengurus RT sebagai dokumen sah penerima bantuan sosial.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. SYARAT & BERKAS PENDAFTARAN -->
    <section id="syarat" class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-gradient-to-br from-indigo-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-8 sm:p-12 shadow-xl">
                <div class="max-w-3xl mb-8">
                    <span
                        class="px-3.5 py-1 rounded-full bg-indigo-800 text-indigo-200 text-xs font-bold uppercase tracking-wider">
                        Kelengkapan Administrasi
                    </span>
                    <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight mt-3">
                        Syarat & Dokumen Yang Perlu Disiapkan
                    </h2>
                    <p class="text-sm sm:text-base text-slate-300 mt-2">
                        Pastikan Anda telah menyiapkan dokumen berikut sebelum mengisi formulir data pengajuan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4 border-t border-indigo-800/60">
                    <!-- Syarat Umum -->
                    <div>
                        <h3 class="text-lg font-bold text-indigo-200 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Ketentuan Umum Pendaftar:
                        </h3>
                        <ul class="space-y-3 text-sm text-slate-200">
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                <span>Warga berdomisili sah di wilayah <strong>RT 011/04 Kelurahan Jelambar</strong>.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                <span>Memiliki <strong>NIK KTP & Kartu Keluarga (KK)</strong> yang valid dan aktif.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">✓</span>
                                <span>Bersedia diverifikasi dan disurvei lapangan oleh <strong>pengurus RT</strong>.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div>
                        <h3 class="text-lg font-bold text-indigo-200 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Berkas Yang Diperlukan:
                        </h3>
                        <ul class="space-y-3 text-sm text-slate-200">
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">1</span>
                                <span>Foto atau fotokopi <strong>Kartu Tanda Penduduk (KTP)</strong> Kepala Keluarga.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">2</span>
                                <span>Foto atau fotokopi <strong>Kartu Keluarga (KK)</strong> terbaru.</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span
                                    class="w-5 h-5 rounded-full bg-indigo-800 text-indigo-200 flex items-center justify-center text-xs font-bold shrink-0">3</span>
                                <span>Bukti rekening atau struk pembayaran <strong>listrik PLN</strong> rumah tinggal terakhir.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. JADWAL SELEKSI -->
    <section id="jadwal" class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span
                    class="px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    Linimasa Kegiatan
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    Jadwal & Tahapan Seleksi Bansos
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Pahami tahapan seleksi berikut agar pengajuan bantuan sosial keluarga Anda berjalan lancar.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tahap 1 -->
                <div
                    class="bg-slate-50 p-6 rounded-3xl border border-slate-200 hover:border-indigo-300 transition shadow-2xs">
                    <span
                        class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-3">Tahap
                        1</span>
                    <h3 class="font-extrabold text-slate-900 text-base mb-1.5">Pendaftaran & Klaim NIK</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Warga mendaftar akun dan memasukkan NIK
                        resmi KTP.</p>
                </div>

                <!-- Tahap 2 -->
                <div
                    class="bg-slate-50 p-6 rounded-3xl border border-slate-200 hover:border-indigo-300 transition shadow-2xs">
                    <span
                        class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-3">Tahap
                        2</span>
                    <h3 class="font-extrabold text-slate-900 text-base mb-1.5">Verifikasi Berkas RT</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Panitia pengurus RT memvalidasi
                        kesesuaian data yang diunggah.</p>
                </div>

                <!-- Tahap 3 -->
                <div
                    class="bg-slate-50 p-6 rounded-3xl border border-slate-200 hover:border-indigo-300 transition shadow-2xs">
                    <span
                        class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-3">Tahap
                        3</span>
                    <h3 class="font-extrabold text-slate-900 text-base mb-1.5">Penilaian Sistem Otomatis</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Sistem menghitung bobot kriteria dan
                        menentukan peringkat kelayakan secara adil.</p>
                </div>

                <!-- Tahap 4 -->
                <div
                    class="bg-slate-50 p-6 rounded-3xl border border-slate-200 hover:border-indigo-300 transition shadow-2xs">
                    <span
                        class="inline-block px-3 py-1 bg-indigo-600 text-white font-black text-xs rounded-xl mb-3">Tahap
                        4</span>
                    <h3 class="font-extrabold text-slate-900 text-base mb-1.5">Pengumuman & Cetak PDF</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">Pengumuman kelayakan terbuka & warga
                        dapat mengunduh transkrip resmi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. TANYA JAWAB (FAQ) -->
    <section id="faq" class="py-16 bg-slate-50" x-data="{ active: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span
                    class="px-3.5 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-bold uppercase tracking-wider">
                    Pusat Bantuan
                </span>
                <h2 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight mt-3">
                    Pertanyaan Yang Sering Diajukan (FAQ)
                </h2>
                <p class="mt-2 text-sm sm:text-base text-slate-600">
                    Penjelasan praktis seputar akun, proses seleksi, dan cara mengunduh bukti kelayakan.
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="active = active === 1 ? null : 1"
                        class="w-full p-5 text-left font-bold text-base text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Bagaimana cara mendaftar akun dan menghubungkan NIK?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0"
                            :class="{ 'rotate-180': active === 1 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Klik tombol <strong>"Daftar Warga"</strong> di bagian atas halaman. Masukkan nama, email, dan
                        kata sandi Anda. Setelah masuk ke Dashboard Warga, klik tombol <strong>"Koneksi NIK"</strong>
                        dan ketikkan 16 digit NIK yang tertera di KTP Anda.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="active = active === 2 ? null : 2"
                        class="w-full p-5 text-left font-bold text-base text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Bagaimana jika saya salah mengisi data kriteria keluarga?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0"
                            :class="{ 'rotate-180': active === 2 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Selama periode pengajuan masih berlangsung (sebelum tahap verifikasi ditutup), Anda dapat
                        memperbarui data kriteria kapan saja melalui Dashboard Warga pada menu <strong>"Perbarui Data
                            Pengajuan"</strong>.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="active = active === 3 ? null : 3"
                        class="w-full p-5 text-left font-bold text-base text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Apakah hasil penilaian benar-benar transparan dan tidak memihak?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0"
                            :class="{ 'rotate-180': active === 3 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Ya. Seluruh kriteria dan persentase pembobotan diatur secara transparan. Sistem menghitung
                        kelayakan secara otomatis tanpa campur tangan subjektif, sehingga bantuan diprioritaskan bagi
                        keluarga yang paling berhak.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs">
                    <button @click="active = active === 4 ? null : 4"
                        class="w-full p-5 text-left font-bold text-base text-slate-900 flex items-center justify-between gap-4">
                        <span class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Bagaimana cara mendapatkan surat bukti jika saya dinyatakan lolos?
                        </span>
                        <svg class="w-5 h-5 text-slate-400 transition-transform duration-200 shrink-0"
                            :class="{ 'rotate-180': active === 4 }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="active === 4" x-collapse
                        class="px-5 pb-5 text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                        Di Dashboard Warga, Anda akan menemukan tombol <strong>"Cetak Transkrip Seleksi"</strong> atau
                        <strong>"Cetak Bukti Pengajuan"</strong>. Dokumen PDF resmi berstempel pengurus RT akan langsung
                        terunduh ke perangkat Anda.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. BANNER AJAKAN (CALL TO ACTION) -->
    <section class="py-14 bg-gradient-to-r from-indigo-600 to-violet-700 text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-2xl sm:text-4xl font-black tracking-tight mb-3">
                Siap Mengajukan Bantuan Sosial Warga?
            </h2>
            <p class="text-sm sm:text-base text-indigo-100 max-w-2xl mx-auto mb-8">
                Daftarkan akun warga Anda sekarang juga dan lengkapi data kriteria untuk berpartisipasi dalam program
                bansos RT secara adil dan terbuka.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="w-full sm:w-auto px-8 py-3.5 bg-white hover:bg-slate-100 text-indigo-900 font-extrabold text-base rounded-xl transition shadow-lg">
                        Buka Dashboard Warga
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="w-full sm:w-auto px-8 py-3.5 bg-white hover:bg-slate-100 text-indigo-900 font-extrabold text-base rounded-xl transition shadow-lg">
                        Daftar Akun Baru
                    </a>
                    <a href="{{ route('login') }}"
                        class="w-full sm:w-auto px-8 py-3.5 bg-indigo-800/80 hover:bg-indigo-800 text-white border border-indigo-400 font-bold text-base rounded-xl transition">
                        Masuk Portal Akun
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <!-- 9. FOOTER & KONTAK RESMI PENGURUS RT -->
    <footer id="kontak" class="bg-slate-900 text-slate-400 text-sm py-14 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 mb-10 pb-10 border-b border-slate-800">
                <!-- Col 1: Instansi & Deskripsi -->
                <div class="md:col-span-5 space-y-4">
                    <div class="flex items-center gap-3">
                        @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                            <img src="{{ asset(setting('app_logo')) }}" alt="Logo" class="h-10 w-auto object-contain">
                        @else
                            <div
                                class="w-10 h-10 rounded-2xl bg-indigo-600 flex items-center justify-center text-white font-black text-lg">
                                {{ strtoupper(substr(setting('app_name', 'SPK'), 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <span class="font-extrabold text-white text-base block tracking-tight">
                                {{ setting('app_name', 'SPK BANSOS RT') }}
                            </span>
                            <span class="text-xs text-indigo-400 font-bold uppercase tracking-wider block">
                                {{ setting('institution_name', 'Pengurus RT 011 / RW 04') }}
                            </span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">
                        {{ setting('app_description', 'Sistem Pendukung Keputusan Seleksi Calon Penerima Bantuan Sosial Warga RT Menggunakan Metode Simple Additive Weighting (SAW) yang Transparan dan Terukur.') }}
                    </p>
                </div>

                <!-- Col 2: Tautan Menu Cepat -->
                <div class="md:col-span-3 space-y-3">
                    <h3 class="font-bold text-white text-sm uppercase tracking-wider">Navigasi Halaman</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#beranda" class="hover:text-indigo-400 transition">Beranda Utama</a></li>
                        <li><a href="#alur" class="hover:text-indigo-400 transition">Alur Pendaftaran</a></li>
                        <li><a href="#kriteria" class="hover:text-indigo-400 transition">Kriteria Penilaian</a></li>
                        <li><a href="#syarat" class="hover:text-indigo-400 transition">Syarat & Dokumen</a></li>
                        <li><a href="#jadwal" class="hover:text-indigo-400 transition">Jadwal Seleksi</a></li>
                        <li><a href="#faq" class="hover:text-indigo-400 transition">Pertanyaan Umum (FAQ)</a></li>
                    </ul>
                </div>

                <!-- Col 3: Layanan Bantuan & Sekretariat RT -->
                <div class="md:col-span-4 space-y-3">
                    <h3 class="font-bold text-white text-sm uppercase tracking-wider">Sekretariat Pengurus RT</h3>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ setting('address', 'Kantor Pengurus RT 011 / RW 04, Kelurahan Setempat') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>{{ setting('contact_email', 'admin@rtrw.id') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>{{ setting('contact_phone', '0812-3456-7890') }}</span>
                        </li>
                    </ul>

                    @php
                        $rawPhone = preg_replace('/[^0-9]/', '', setting('contact_phone', '081234567890'));
                        if (str_starts_with($rawPhone, '0')) {
                            $waPhone = '62' . substr($rawPhone, 1);
                        } else {
                            $waPhone = $rawPhone;
                        }
                    @endphp
                    <div class="pt-2">
                        <a href="https://wa.me/{{ $waPhone }}?text=Halo%20Pengurus%20RT,%20saya%20ingin%20bertanya%20seputar%20bantuan%20sosial"
                            target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition shadow-sm">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Hubungi WhatsApp Pengurus RT
                        </a>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <div>
                    {{ str_replace('{year}', date('Y'), setting('footer_text', '© ' . date('Y') . ' ' . setting('app_name', 'SPK Bansos RT') . ' - ' . setting('institution_name', 'Pengurus RT') . '. All rights reserved.')) }}
                </div>

            </div>
        </div>
    </footer>

</body>

</html>