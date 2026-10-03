<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Lupa Kata Sandi?</h2>
        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
            Masukkan alamat email akun Anda. Kami akan mengirimkan tautan untuk mereset kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-xs font-semibold text-emerald-600 bg-emerald-50 p-3 rounded-xl border border-emerald-200" :status="session('status')" />

    @if ($errors->any())
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-700">
            @foreach ($errors->all() as $error)
                <p>&bull; {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
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
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="nama@email.com"
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
            </div>
        </div>

        <div class="pt-2 flex flex-col gap-3">
            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition duration-150 shadow-md shadow-indigo-500/30 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Kirim Tautan Reset Password
            </button>

            <a href="{{ route('login') }}" class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition text-center">
                Kembali ke Halaman Login
            </a>
        </div>
    </form>
</x-guest-layout>
