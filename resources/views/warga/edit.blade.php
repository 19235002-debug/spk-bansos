<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Edit Calon Penerima: {{ $alternatif->nama_warga }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">

                <form action="{{ route('warga.update', $alternatif->id) }}" method="POST" class="space-y-5"
                    x-data="{ createAccount: false, showPassword: false }">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="no_kk" class="block text-xs font-bold uppercase text-slate-700 mb-1">No. KK (Nomor Kartu Keluarga)</label>
                            <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk', $alternatif->no_kk) }}" placeholder="Contoh: 3171010101010001"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('no_kk')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nik" class="block text-xs font-bold uppercase text-slate-700 mb-1">NIK (Nomor Induk Kepala Keluarga)</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik', $alternatif->nik) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                required>
                            @error('nik')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="nama_warga" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Warga</label>
                        <input type="text" name="nama_warga" id="nama_warga"
                            value="{{ old('nama_warga', $alternatif->nama_warga) }}"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                        @error('nama_warga')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="rt_rw" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor / Wilayah RT</label>
                            <input type="text" name="rt_rw" id="rt_rw" value="{{ old('rt_rw', $alternatif->rt_rw) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('rt_rw')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-xs font-bold uppercase text-slate-700 mb-1">Pekerjaan</label>
                            <input type="text" name="pekerjaan" id="pekerjaan"
                                value="{{ old('pekerjaan', $alternatif->pekerjaan) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('pekerjaan')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Lengkap</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $alternatif->alamat) }}"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('alamat')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-xs font-bold uppercase text-slate-700 mb-1">Tautan Akun Login User</label>
                        <select name="user_id" id="user_id"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            :disabled="createAccount">
                            <option value="">-- Tidak Terhubung ke User Login --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ old('user_id', $alternatif->user_id) == $u->id ? 'selected' : '' }}>
                                    {{ $u->name }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password Management for Admin -->
                    <div class="p-4 bg-indigo-50/70 rounded-xl border border-indigo-100 space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <label for="password" class="block text-xs font-bold uppercase text-indigo-950">
                                Edit / Reset Password Akun Login Warga
                            </label>
                            @if($alternatif->user)
                                <span class="text-[11px] px-2.5 py-0.5 bg-emerald-100 text-emerald-800 font-bold rounded-md border border-emerald-200/60 inline-flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Terhubung: {{ $alternatif->user->email }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" id="password" placeholder="Masukkan password baru (minimal 6 karakter)"
                                class="w-full pr-10 rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm bg-white">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 transition" title="Tampilkan/Sembunyikan Kata Sandi">
                                <svg class="w-4 h-4" x-show="!showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg class="w-4 h-4" x-show="showPassword" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.03 10.03 0 014.122-.913c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18"/></svg>
                            </button>
                        </div>

                        <p class="text-[11px] text-slate-500">
                            Isi kolom ini jika Admin ingin mengubah atau menguji reset password akun login warga yang terhubung. Biarkan kosong jika tidak ingin mengubah password.
                        </p>
                        @error('password')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    @if(!$alternatif->user_id)
                    <!-- Option to create user if not yet linked -->
                    <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-100 space-y-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="create_user" value="1" x-model="createAccount"
                                class="rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                            <span class="text-xs font-bold text-emerald-900">Buatkan Akun Login Warga Baru Otomatis</span>
                        </label>

                        <div x-show="createAccount" x-transition class="pt-2">
                            <label for="email" class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Login Warga</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="warga@gmail.com"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm bg-white">
                            <p class="text-[11px] text-slate-500 mt-1">Jika kolom password di atas diisi, akan memakai password tersebut. Jika kosong, password bawaan: <strong class="text-emerald-700 font-mono">password123</strong></p>
                            @error('email')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    @endif

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('warga.index') }}"
                            class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white font-semibold text-xs rounded-xl hover:bg-indigo-700 transition shadow-sm">
                            Perbarui Data Calon Penerima
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
