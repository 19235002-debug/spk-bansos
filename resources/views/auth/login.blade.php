<x-guest-layout>
    <div x-data="{ showPassword: false, email: '{{ old('email') }}', password: '' }">
        <!-- Form Header -->
        <div class="mb-6">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Masuk ke Akun Anda</h2>
            <p class="text-xs text-slate-500 mt-1">Silakan masukkan email dan kata sandi untuk mengakses portal SPK Bansos RT.</p>
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs text-rose-700">
                <div class="font-bold flex items-center gap-1.5 mb-1 text-rose-800">
                    <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Gagal Masuk:
                </div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Quick Demo Credentials Hint Box -->
        <div class="mb-6 p-4 bg-indigo-50/70 border border-indigo-100 rounded-2xl">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-extrabold text-indigo-900 uppercase tracking-wider flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Pilihan Akun Demo (1-Click Fill)
                </span>
            </div>
            <div class="grid grid-cols-2 gap-2 text-xs">
                <button type="button" @click="email = 'admin@gmail.com'; password = 'password'" class="p-2 bg-white hover:bg-indigo-600 hover:text-white border border-indigo-200 rounded-xl text-left transition font-medium group">
                    <span class="font-bold block text-slate-800 group-hover:text-white">Admin RT</span>
                    <span class="text-[10px] text-slate-400 group-hover:text-indigo-100">admin@gmail.com</span>
                </button>
                <button type="button" @click="email = 'suparno@gmail.com'; password = 'password'" class="p-2 bg-white hover:bg-indigo-600 hover:text-white border border-indigo-200 rounded-xl text-left transition font-medium group">
                    <span class="font-bold block text-slate-800 group-hover:text-white">Warga RT (Suparno)</span>
                    <span class="text-[10px] text-slate-400 group-hover:text-indigo-100">suparno@gmail.com</span>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

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
                           x-model="email" 
                           required 
                           autofocus 
                           autocomplete="username"
                           placeholder="nama@email.com"
                           class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1">
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Kata Sandi (Password)</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-indigo-600 hover:underline font-semibold">
                            Lupa Kata Sandi?
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <input id="password" 
                           name="password" 
                           :type="showPassword ? 'text' : 'password'" 
                           x-model="password" 
                           required 
                           autocomplete="current-password"
                           placeholder="••••••••"
                           class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
                    
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600">
                        <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 shadow-xs focus:ring-indigo-500">
                    <span class="ms-2 text-xs text-slate-600 font-medium">Ingat Saya di Perangkat Ini</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition duration-150 shadow-md shadow-indigo-500/30 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Masuk ke Sistem SPK
                </button>
            </div>

            <!-- Footer Link -->
            <div class="text-center pt-4 border-t border-slate-100">
                <p class="text-xs text-slate-500">
                    Belum memiliki akun Warga? 
                    <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:underline">
                        Daftar Warga di Sini
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
