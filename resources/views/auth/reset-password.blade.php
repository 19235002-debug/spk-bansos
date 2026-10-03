<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-black text-slate-900 tracking-tight">Atur Ulang Kata Sandi</h2>
        <p class="text-xs text-slate-500 mt-1">Masukkan kata sandi baru untuk akun Anda.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs text-rose-700">
            @foreach ($errors->all() as $error)
                <p>&bull; {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                       value="{{ old('email', $request->email) }}" 
                       required 
                       readonly
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-100 border border-slate-300 rounded-xl text-xs font-medium text-slate-700 cursor-not-allowed" />
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Kata Sandi Baru</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="password" 
                       name="password" 
                       type="password" 
                       required 
                       placeholder="Minimal 8 karakter"
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Konfirmasi Kata Sandi Baru</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <input id="password_confirmation" 
                       name="password_confirmation" 
                       type="password" 
                       required 
                       placeholder="Ulangi kata sandi baru"
                       class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-xs font-medium text-slate-900 focus:bg-white focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition duration-150" />
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition duration-150 shadow-md shadow-indigo-500/30 flex items-center justify-center gap-2">
                Simpan Kata Sandi Baru
            </button>
        </div>
    </form>
</x-guest-layout>
