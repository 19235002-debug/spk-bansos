<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Tambah Kriteria Penilaian Baru
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">

                <form action="{{ route('kriteria.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="kode_kriteria" class="block text-xs font-bold uppercase text-slate-700 mb-1">Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" id="kode_kriteria" value="{{ old('kode_kriteria') }}" placeholder="Contoh: C5" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        @error('kode_kriteria') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nama_kriteria" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" id="nama_kriteria" value="{{ old('nama_kriteria') }}" placeholder="Contoh: Tanggungan Orang Tua" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        @error('nama_kriteria') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="bobot" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nilai Bobot Kriteria (Rentang 0.01 - 1.0)</label>
                        <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot', '0.15') }}" placeholder="0.15" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        <p class="text-[11px] text-slate-400 mt-1">Contoh: 0.35 setara dengan 35%.</p>
                        @error('bobot') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tipe" class="block text-xs font-bold uppercase text-slate-700 mb-1">Tipe Atribut Kriteria</label>
                        <select name="tipe" id="tipe" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                            <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit (Makin tinggi makin prioritas, misal Tanggungan/Kondisi Rumah)</option>
                            <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost (Makin kecil makin prioritas, misal Pendapatan/Daya Listrik)</option>
                        </select>
                        @error('tipe') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('kriteria.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold text-xs rounded-xl hover:bg-indigo-700 transition shadow-sm">
                            Simpan Kriteria
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
