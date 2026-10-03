<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-black text-xl text-slate-900 leading-tight flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile & Pengaturan Akun
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">Kelola informasi identitas pribadi, keamanan kata sandi, dan status akun Anda.</p>
            </div>
            <div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ Auth::user()->isAdmin() ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'bg-emerald-50 text-emerald-700 border-emerald-200' }}">
                    Role: {{ Auth::user()->role }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">

        <!-- User Profile Hero Summary Banner -->
        <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 rounded-2xl p-6 md:p-8 text-white shadow-xl relative overflow-hidden border border-slate-800">
            <div class="absolute right-0 top-0 bottom-0 w-1/3 opacity-15 bg-[radial-gradient(#6366f1_1px,transparent_1px)] [background-size:16px_16px]"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-4 md:gap-6">
                    <!-- Profile Avatar Circle -->
                    <div class="w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-gradient-to-tr from-indigo-500 to-violet-500 text-white font-black text-2xl md:text-3xl flex items-center justify-center shadow-lg shadow-indigo-500/30 border-2 border-white/20 shrink-0">
                        {{ mb_substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-2.5 py-0.5 rounded-md text-[10px] font-extrabold uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-400/30 backdrop-blur-md flex items-center gap-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                Akun Terverifikasi
                            </span>
                        </div>
                        <h1 class="text-xl md:text-2xl font-extrabold tracking-tight">
                            {{ Auth::user()->name }}
                        </h1>
                        <p class="text-xs md:text-sm text-slate-300 mt-0.5">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>

                <!-- Account Metadata Pills -->
                <div class="flex flex-wrap md:flex-col items-start md:items-end gap-2 text-xs border-t md:border-t-0 md:border-l border-white/10 pt-4 md:pt-0 md:pl-6">
                    <div class="text-slate-300">
                        Terdaftar Sejak: <strong class="text-white">{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : '-' }}</strong>
                    </div>
                    <div class="text-slate-300">
                        Status: <strong class="text-indigo-300 capitalize">{{ Auth::user()->role }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Form Cards Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Card 1: Profile Information -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 hover:shadow-md transition">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Card 2: Update Password -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs p-6 hover:shadow-md transition">
                @include('profile.partials.update-password-form')
            </div>
        </div>

    </div>
</x-app-layout>
