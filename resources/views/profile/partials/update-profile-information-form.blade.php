<section>
    <header class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-6">
        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <div>
            <h3 class="text-base font-extrabold text-slate-900">
                Informasi Profil Akun
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">
                Perbarui identitas pengguna dan alamat email utama Anda.
            </p>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5 text-xs">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Nama Lengkap" class="font-bold text-slate-700" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <x-text-input id="name" name="name" type="text" class="pl-9 block w-full rounded-xl" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda..." />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Alamat Email" class="font-bold text-slate-700" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <x-text-input id="email" name="email" type="email" class="pl-9 block w-full rounded-xl" :value="old('email', $user->email)" required autocomplete="username" placeholder="nama@domain.com" />
            </div>
            <x-input-error class="mt-1" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-xl text-xs text-amber-800 flex items-start gap-2">
                    <svg class="w-4 h-4 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div>
                        <p class="font-semibold">Alamat email Anda belum terverifikasi.</p>
                        <button form="send-verification" class="mt-1 font-bold underline text-amber-900 hover:text-amber-700">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-bold text-xs text-emerald-600 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Tautan verifikasi baru telah dikirim ke alamat email Anda.
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-3 pt-2">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 px-5 py-2.5 rounded-xl font-extrabold shadow-md shadow-indigo-100">
                Simpan Profil
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-xs font-bold text-emerald-600 flex items-center gap-1 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-200"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Profil berhasil diperbarui!
                </span>
            @endif
        </div>
    </form>
</section>
