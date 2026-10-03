<section class="space-y-4">
    <header class="flex items-center gap-3 border-b border-rose-100 pb-4 mb-4">
        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
        </div>
        <div>
            <h3 class="text-base font-extrabold text-rose-900">
                Zona Bahaya: Hapus Akun
            </h3>
            <p class="text-xs text-rose-600/80 mt-0.5">
                Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
            </p>
        </div>
    </header>

    <div class="p-4 bg-rose-50/60 border border-rose-200 rounded-xl text-xs text-rose-800 leading-relaxed">
        Setelah akun Anda dihapus, seluruh sumber daya, riwayat pengajuan bansos, dan data akun Anda akan dihapus secara permanen dari server SPK Bansos RT.
    </div>

    <div>
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="bg-rose-600 hover:bg-rose-700 px-5 py-2.5 rounded-xl font-extrabold shadow-md shadow-rose-100 text-xs"
        >
            Hapus Akun Permanen
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-4">
                <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">
                        Apakah Anda yakin ingin menghapus akun?
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Masukkan kata sandi Anda untuk mengonfirmasi penghapusan permanen.
                    </p>
                </div>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <x-input-label for="password" value="Kata Sandi Konfirmasi" class="sr-only" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full rounded-xl"
                        placeholder="Masukkan kata sandi Anda..."
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1" />
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition">
                    Batal
                </button>
                <x-danger-button class="bg-rose-600 hover:bg-rose-700 px-5 py-2.5 rounded-xl font-extrabold text-xs shadow-md shadow-rose-100">
                    Ya, Hapus Akun Saya
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
