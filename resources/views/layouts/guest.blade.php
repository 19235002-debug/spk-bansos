<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-950">
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
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full text-slate-800 bg-slate-950 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-950/40 via-slate-950 to-slate-950">
            <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-800 grid grid-cols-1 lg:grid-cols-12 my-auto">
                <!-- Left Branding Panel (5 Cols) -->
                <div class="lg:col-span-5 bg-gradient-to-br from-slate-950 via-indigo-950 to-slate-950 p-8 md:p-10 text-white flex flex-col justify-between border-b lg:border-b-0 lg:border-r border-slate-800 relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
                    
                    <div class="relative z-10">
                        <!-- Logo Header -->
                        <div class="flex items-center gap-3 mb-8">
                            @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                                <img src="{{ asset(setting('app_logo')) }}" alt="Logo App" class="h-10 w-auto object-contain">
                            @else
                                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-500/30">
                                    {{ strtoupper(substr(setting('app_name', 'SPK'), 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <h2 class="font-extrabold text-white tracking-tight leading-none text-lg uppercase">{{ setting('app_name', 'SPK BANSOS RT') }}</h2>
                                <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-widest mt-1">{{ setting('app_tagline', 'METODE SAW ENGINE') }}</p>
                            </div>
                        </div>

                        <h3 class="text-2xl font-black tracking-tight text-white leading-snug">
                            Sistem Pendukung Keputusan Seleksi Penerima Bantuan Sosial
                        </h3>
                        <p class="mt-3 text-slate-300 text-xs leading-relaxed">
                            Platform terintegrasi untuk menghitung pembobotan kriteria dan perankingan calon penerima bantuan sosial (bansos) warga RT secara objektif, efisien, dan transparan.
                        </p>

                        <!-- Feature Badges -->
                        <div class="mt-6 space-y-2.5 text-xs text-slate-300">
                            <div class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span>Kalkulasi Algoritma SAW Otomatis</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span>Multi-Role Access (Admin & Warga)</span>
                            </div>
                            <div class="flex items-center gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-indigo-500/20 text-indigo-400 flex items-center justify-center font-bold shrink-0">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span>Cetak Transkrip & Laporan PDF Resmi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Info Card -->
                    <div class="mt-8 pt-6 border-t border-slate-800 text-[11px] text-slate-400 flex items-center justify-between">
                        <span>TailwindAdmin Version</span>
                        <span class="font-mono text-indigo-400 font-bold">v2.0 &bull; SAW</span>
                    </div>
                </div>

                <!-- Right Form Slot (7 Cols) -->
                <div class="lg:col-span-7 p-8 md:p-12 bg-white flex flex-col justify-center">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- SweetAlert2 Notifications -->
        @if(session('status'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    Swal.fire({
                        icon: 'info',
                        title: 'Informasi Status',
                        text: "{{ session('status') }}",
                        confirmButtonColor: '#4f46e5'
                    });
                });
            </script>
        @endif
    </body>
</html>
