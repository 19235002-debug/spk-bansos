<!-- Sidebar Navigation (TailwindAdmin Theme) -->
<aside class="w-64 bg-slate-900 border-r border-slate-800 text-slate-300 flex flex-col h-full shrink-0">
    <!-- Brand Logo Header -->
    <div class="h-14 shrink-0 flex items-center px-5 border-b border-slate-800 bg-slate-950/60">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            @if(setting('app_logo') && file_exists(public_path(setting('app_logo'))))
                <img src="{{ asset(setting('app_logo')) }}" alt="Logo App" class="h-8 w-auto object-contain">
            @else
                <div
                    class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-500 to-violet-500 flex items-center justify-center text-white font-black text-base shadow-md shadow-indigo-500/20">
                    S
                </div>
            @endif
            <div class="flex flex-col">
                <span
                    class="font-black text-white tracking-tight leading-none text-xs uppercase">SPK BANSOS</span>
                <span
                    class="text-[9px] text-indigo-400 font-bold uppercase tracking-widest mt-0.5">RT 011/04 JELAMBAR</span>
            </div>
        </a>
    </div>

    <!-- Sidebar Menu Items -->
    <div class="flex-1 overflow-y-auto p-4 space-y-6 sidebar-menu">
        @if(Auth::user()->isAdmin())
            <!-- GROUP 1 : UTAMA -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </nav>
            </div>

            <!-- GROUP 2 : SPK — SELEKSI BANSOS -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">SPK — SELEKSI BANSOS</p>
                <nav class="space-y-1">
                    <a href="{{ route('warga.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('warga.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Calon Penerima</span>
                    </a>

                    <a href="{{ route('kriteria.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('kriteria.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
                        </svg>
                        <span>Kriteria & Bobot</span>
                    </a>

                    <a href="{{ route('penilaian.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('penilaian.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span>Penilaian</span>
                    </a>

                    <a href="{{ route('perhitungan.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('perhitungan.index') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span>Perhitungan SAW</span>
                    </a>

                    <a href="{{ route('hasil.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('hasil.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Hasil Seleksi</span>
                    </a>
                </nav>
            </div>

            <!-- GROUP 3 : MANAJEMEN SISTEM -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">MANAJEMEN SISTEM</p>
                <nav class="space-y-1">
                    <a href="{{ route('settings.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('settings.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan</span>
                    </a>

                    <a href="{{ route('dokumentasi.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('dokumentasi.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Dokumentasi</span>
                    </a>

                    <a href="{{ route('team.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('team.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Kelola Tim</span>
                    </a>
                </nav>
            </div>
        @else
            <!-- GROUP WARGA -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2">UTAMA</p>
                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('hasil.index') }}"
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('hasil.*') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/80' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Hasil Seleksi</span>
                    </a>
                </nav>
            </div>
        @endif
    </div>
</aside>

<!-- SIDEBAR SCROLLBAR STYLING -->
<style>
    .sidebar-menu {
        scrollbar-width: thin;
        scrollbar-color: #334155 transparent;
    }

    .sidebar-menu::-webkit-scrollbar {
        width: 4px;
    }

    .sidebar-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-menu::-webkit-scrollbar-thumb {
        background: #334155;
        border-radius: 9999px;
    }

    .sidebar-menu::-webkit-scrollbar-thumb:hover {
        background: #475569;
    }
</style>