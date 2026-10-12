<!-- Modern Premium Header Navbar -->
<header class="h-16 bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40 flex items-center justify-between px-4 sm:px-6 shadow-xs">
    <!-- Left Section: Mobile Menu Toggle & System Title -->
    <div class="flex items-center gap-3 sm:gap-4">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 rounded-xl text-slate-500 hover:text-slate-800 hover:bg-slate-100 transition focus:outline-none">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <!-- System Branding & Live Status Badge -->
        <div class="flex items-center gap-3">
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-slate-100/80 border border-slate-200/60 text-slate-700 text-xs font-semibold">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="tracking-tight text-slate-800 font-bold">Sistem Seleksi Bansos RT</span>
            </div>

            <div class="hidden lg:flex items-center gap-1.5 text-xs text-slate-500 font-medium border-l border-slate-200 pl-3">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</span>
            </div>
        </div>
    </div>

    <!-- Right Section: User Profile Card & Dropdown -->
    <div class="flex items-center gap-3">
        <!-- User Dropdown Menu (Modern & Premium Design) -->
        <x-dropdown align="right" width="64" contentClasses="p-2 bg-white/95 backdrop-blur-md rounded-2xl border border-slate-200/90 shadow-2xl shadow-indigo-950/15">
            <x-slot name="trigger">
                <button class="group flex items-center gap-2.5 p-1.5 pr-3 rounded-2xl border border-slate-200/80 bg-white hover:border-indigo-300 hover:shadow-md hover:shadow-indigo-500/10 transition-all duration-200 focus:outline-none">
                    <!-- Avatar with Gradient & Shadow -->
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-600 text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-500/25 group-hover:scale-105 transition-transform duration-200">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <!-- User Information & Sub-Role -->
                    <div class="hidden md:flex flex-col text-left leading-tight">
                        <span class="text-xs font-black text-slate-800 group-hover:text-indigo-600 transition-colors max-w-[130px] truncate">
                            {{ Auth::user()->name }}
                        </span>
                        <span class="text-[10px] font-extrabold text-indigo-600 uppercase tracking-wider">
                            {{ Auth::user()->isAdmin() ? 'ADMIN' : 'WARGA' }}
                        </span>
                    </div>

                    <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 group-hover:translate-y-0.5 transition-all ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- User Profile Summary Header Card -->
                <div class="p-3 bg-gradient-to-br from-slate-50 to-indigo-50/50 rounded-xl border border-slate-100 flex items-start gap-3 mb-1.5">
                    <div class="relative shrink-0">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-600 text-white flex items-center justify-center font-black text-xs shadow-md shadow-indigo-500/25">
                            {{ mb_substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-black text-slate-900 truncate leading-tight">{{ Auth::user()->name }}</p>
                        <p class="text-[11px] text-slate-500 truncate mt-0.5 font-medium">{{ Auth::user()->email }}</p>
                        <div class="mt-1.5">
                            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-md text-[10px] font-black uppercase tracking-wider {{ Auth::user()->isAdmin() ? 'bg-amber-100/90 text-amber-800 border border-amber-200' : 'bg-indigo-100/80 text-indigo-700 border border-indigo-200/70' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ Auth::user()->isAdmin() ? 'bg-amber-500' : 'bg-indigo-600' }}"></span>
                                {{ Auth::user()->isAdmin() ? 'Pengurus RT (Admin)' : 'Warga RT' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Navigation Action Links -->
                <div class="space-y-0.5">
                    <!-- Profile Akun Link -->
                    <x-dropdown-link :href="route('profile.edit')" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-xl hover:bg-indigo-50/70 transition-all">
                        <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <span class="text-xs font-extrabold text-slate-800 group-hover:text-indigo-700 block leading-tight">Profil Akun</span>
                            <span class="text-[10px] font-medium text-slate-400 group-hover:text-indigo-500 block">Kelola info akun & sandi</span>
                        </div>
                        <svg class="w-3 h-3 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </x-dropdown-link>

                    @if(!Auth::user()->isAdmin())
                        <!-- Shortcut Hasil Seleksi untuk Warga -->
                        <x-dropdown-link :href="route('hasil.index')" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-xl hover:bg-emerald-50/70 transition-all">
                            <div class="w-7 h-7 rounded-lg bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 text-left">
                                <span class="text-xs font-extrabold text-slate-800 group-hover:text-emerald-700 block leading-tight">Hasil Pengumuman</span>
                                <span class="text-[10px] font-medium text-slate-400 group-hover:text-emerald-600 block">Lihat kelayakan bansos</span>
                            </div>
                            <svg class="w-3 h-3 text-slate-300 group-hover:text-emerald-600 group-hover:translate-x-0.5 transition-all ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </x-dropdown-link>
                    @else
                        <!-- Shortcut Pengaturan untuk Admin -->
                        <x-dropdown-link :href="route('settings.index')" class="group flex items-center gap-2.5 px-2.5 py-2 rounded-xl hover:bg-indigo-50/70 transition-all">
                            <div class="w-7 h-7 rounded-lg bg-slate-100 text-slate-600 group-hover:bg-indigo-600 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0 text-left">
                                <span class="text-xs font-extrabold text-slate-800 group-hover:text-indigo-700 block leading-tight">Pengaturan Sistem</span>
                                <span class="text-[10px] font-medium text-slate-400 group-hover:text-indigo-500 block">Identitas RT & kriteria</span>
                            </div>
                            <svg class="w-3 h-3 text-slate-300 group-hover:text-indigo-600 group-hover:translate-x-0.5 transition-all ml-auto shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                            </svg>
                        </x-dropdown-link>
                    @endif
                </div>

                <div class="my-1.5 border-t border-slate-100"></div>

                <!-- Logout Link -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="group flex items-center gap-2.5 px-2.5 py-2 rounded-xl text-rose-600 hover:bg-rose-50/80 hover:text-rose-700 transition-all">
                        <div class="w-7 h-7 rounded-lg bg-rose-50 text-rose-600 group-hover:bg-rose-600 group-hover:text-white flex items-center justify-center transition-colors shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 text-left">
                            <span class="text-xs font-extrabold text-rose-600 group-hover:text-rose-700 block leading-tight">Keluar (Logout)</span>
                            <span class="text-[10px] font-medium text-rose-400 block">Akhiri sesi login akun Anda</span>
                        </div>
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</header>
