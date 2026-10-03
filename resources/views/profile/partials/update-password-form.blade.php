<section>
    <header class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-6">
        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <div>
            <h3 class="text-base font-extrabold text-slate-900">
                Perbarui Kata Sandi
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan aman.
            </p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4 text-xs">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Kata Sandi Saat Ini" class="font-bold text-slate-700" />
            <div class="relative mt-1" x-data="{ showPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <input id="update_password_current_password" 
                       name="current_password" 
                       :type="showPassword ? 'text' : 'password'" 
                       class="pl-9 pr-10 block w-full rounded-xl border-slate-300 focus:border-indigo-600 focus:ring-indigo-600 text-xs font-medium text-slate-900" 
                       autocomplete="current-password" 
                       placeholder="Masukkan kata sandi lama..." />
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                    <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Kata Sandi Baru" class="font-bold text-slate-700" />
            <div class="relative mt-1" x-data="{ showPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <input id="update_password_password" 
                       name="password" 
                       :type="showPassword ? 'text' : 'password'" 
                       class="pl-9 pr-10 block w-full rounded-xl border-slate-300 focus:border-indigo-600 focus:ring-indigo-600 text-xs font-medium text-slate-900" 
                       autocomplete="new-password" 
                       placeholder="Minimal 8 karakter..." />
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                    <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Konfirmasi Kata Sandi Baru" class="font-bold text-slate-700" />
            <div class="relative mt-1" x-data="{ showPassword: false }">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <input id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       :type="showPassword ? 'text' : 'password'" 
                       class="pl-9 pr-10 block w-full rounded-xl border-slate-300 focus:border-indigo-600 focus:ring-indigo-600 text-xs font-medium text-slate-900" 
                       autocomplete="new-password" 
                       placeholder="Ulangi kata sandi baru..." />
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-indigo-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                    <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md shadow-indigo-500/30 transition">
                SIMPAN KATA SANDI
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-xs font-bold text-emerald-600 flex items-center gap-1 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Kata sandi berhasil diubah!
                </span>
            @endif
        </div>
    </form>
</section>
