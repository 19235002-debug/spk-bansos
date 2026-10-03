<x-guest-layout>
    <div x-data="{ showPassword: false }">
        <!-- Form Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Pendaftaran Warga Baru</h2>
            <p class="text-xs text-slate-500 mt-1">Buat akun Warga untuk mengikuti proses seleksi penerimaan bantuan sosial (bansos) RT.</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs text-rose-700">
                <div class="font-bold flex items-center gap-1.5 mb-1 text-rose-800">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Gagal Mendaftar:
                </div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Nama Lengkap Kepala Keluarga / Warga</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <input id="name" 
                           name="name" 
                           type="text" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name"
                           placeholder="Contoh: Pak Suparno"
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Alamat Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <input id="email" 
                           name="email" 
                           type="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username"
                           placeholder="warga@gmail.com"
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                </div>
            </div>

            <!-- NIK (Nomor Induk Kependudukan) -->
            <div>
                <label for="nik" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">NIK (Nomor Induk Kependudukan)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-6 0h6"/></svg>
                    </div>
                    <input id="nik" 
                           name="nik" 
                           type="text" 
                           value="{{ old('nik') }}" 
                           placeholder="Contoh: 3171012304750001"
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-mono font-bold text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                </div>
            </div>

            <!-- Password Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input id="password" 
                               name="password" 
                               :type="showPassword ? 'text' : 'password'" 
                               required 
                               autocomplete="new-password"
                               placeholder="Minimal 8 Karakter"
                               class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Konfirmasi Sandi</label>
                    <div class="relative" x-data="{ showPassword: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <input id="password_confirmation" 
                               name="password_confirmation" 
                               :type="showPassword ? 'text' : 'password'" 
                               required 
                               autocomplete="new-password"
                               placeholder="Ulangi Sandi"
                               class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                            <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition duration-150 shadow-md shadow-indigo-500/30 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Daftar Akun Warga
                </button>
            </div>

            <!-- Footer Link -->
            <div class="text-center pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-500">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:underline">
                        Masuk di Sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
