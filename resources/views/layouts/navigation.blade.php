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
        <!-- User Dropdown Menu -->
        <x-dropdown align="right" width="56" contentClasses="py-0 bg-white overflow-hidden rounded-2xl border border-slate-200/80 shadow-xl">
            <x-slot name="trigger">
                <button class="group flex items-center gap-2.5 p-1.5 pr-3 rounded-2xl border border-slate-200/80 bg-slate-50/80 hover:bg-white hover:border-indigo-200 hover:shadow-xs transition-all duration-200 focus:outline-none">
                    <!-- Avatar with Gradient & Shadow -->
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-indigo-600 via-indigo-500 to-violet-600 text-white flex items-center justify-center font-extrabold text-xs shadow-md shadow-indigo-500/20 group-hover:scale-105 transition-transform duration-200">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <!-- User Information & Sub-Role -->
                    <div class="hidden md:flex flex-col text-left leading-tight">
                        <span class="text-xs font-bold text-slate-800 group-hover:text-indigo-600 transition-colors max-w-[120px] truncate">
                            {{ Auth::user()->name }}
                        </span>
                        <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider">
                            {{ Auth::user()->isAdmin() ? 'ADMIN' : 'WARGA' }}
                        </span>
                    </div>

                    <svg class="w-4 h-4 text-slate-400 group-hover:text-slate-600 transition-colors ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- User Profile Summary Header -->
                <div class="px-4 py-3.5 bg-slate-50 border-b border-slate-100">
                    <p class="text-xs font-bold text-slate-900 truncate leading-tight">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                    <div class="mt-2.5 inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-100">
                        Role: {{ Auth::user()->isAdmin() ? 'ADMIN' : 'WARGA' }}
                    </div>
                </div>

                <div class="py-1">
                    <x-dropdown-link :href="route('profile.edit')">
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        <span>Profile Akun</span>
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Keluar (Logout)</span>
                        </x-dropdown-link>
                    </form>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</header>
