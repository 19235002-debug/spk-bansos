<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Tambah Data Warga (Calon Penerima Bansos)
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">

                <form action="{{ route('warga.store') }}" method="POST" class="space-y-5"
                    x-data="{ createAccount: false }">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="no_kk" class="block text-xs font-bold uppercase text-slate-700 mb-1">No. KK (Nomor Kartu Keluarga)</label>
                            <input type="text" name="no_kk" id="no_kk" value="{{ old('no_kk') }}" placeholder="Contoh: 3171010101010001"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('no_kk')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="nik" class="block text-xs font-bold uppercase text-slate-700 mb-1">NIK (Nomor Induk Kepala Keluarga)</label>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" placeholder="Contoh: 3171012304750001"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                required>
                            @error('nik')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="nama_warga" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Lengkap Kepala Keluarga / Warga</label>
                        <input type="text" name="nama_warga" id="nama_warga" value="{{ old('nama_warga') }}"
                            placeholder="Contoh: Pak Suparno"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            required>
                        @error('nama_warga')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="rt_rw" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nomor / Wilayah RT</label>
                            <input type="text" name="rt_rw" id="rt_rw" value="{{ old('rt_rw', 'RT 011/04') }}"
                                placeholder="RT 011/04"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('rt_rw')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="pekerjaan" class="block text-xs font-bold uppercase text-slate-700 mb-1">Pekerjaan Utama</label>
                            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                                placeholder="Contoh: Buruh Bangunan / Driver Ojol"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                            @error('pekerjaan')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-xs font-bold uppercase text-slate-700 mb-1">Alamat Lengkap / No. Rumah</label>
                        <input type="text" name="alamat" id="alamat" value="{{ old('alamat', 'Jl. Satria X No. , RT 011/04, Kel. Jelambar, Jakarta Barat') }}"
                            placeholder="Contoh: Jl. Satria X No. 12, RT 011/04, Kel. Jelambar"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        @error('alamat')
                        <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-xs font-bold uppercase text-slate-700 mb-1">Hubungkan ke Akun Warga Terdaftar (Opsional)</label>
                        <select name="user_id" id="user_id"
                            class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            :disabled="createAccount">
                            <option value="">-- Pilih Akun User (Jika Sudah Ada) --</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" {{ old('user_id') == $u->id ? 'selected' : '' }}>{{ $u->name }}
                                    ({{ $u->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Auto create user check -->
                    <div class="p-4 bg-indigo-50/60 rounded-xl border border-indigo-100 space-y-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="create_user" value="1" x-model="createAccount"
                                class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs font-bold text-indigo-950">Buatkan Akun Login Warga Otomatis</span>
                        </label>

                        <div x-show="createAccount" x-transition class="pt-2">
                            <label for="email" class="block text-xs font-bold uppercase text-slate-700 mb-1">Email Login Warga</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="warga@gmail.com"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm bg-white">
                            <p class="text-[11px] text-slate-500 mt-1">Password bawaan akun baru: <strong
                                    class="text-indigo-700 font-mono">password123</strong></p>
                            @error('email')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('warga.index') }}"
                            class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 text-white font-semibold text-xs rounded-xl hover:bg-indigo-700 transition shadow-sm">
                            Simpan Data Warga
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
