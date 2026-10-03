<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            Edit Data Kriteria Penilaian: {{ $kriteria->kode_kriteria }}
        </h2>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">

                <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="kode_kriteria" class="block text-xs font-bold uppercase text-slate-700 mb-1">Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" id="kode_kriteria" value="{{ old('kode_kriteria', $kriteria->kode_kriteria) }}" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        @error('kode_kriteria') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="nama_kriteria" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" id="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        @error('nama_kriteria') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="bobot" class="block text-xs font-bold uppercase text-slate-700 mb-1">Nilai Bobot Kriteria</label>
                        <input type="number" step="0.01" name="bobot" id="bobot" value="{{ old('bobot', $kriteria->bobot) }}" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        @error('bobot') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tipe" class="block text-xs font-bold uppercase text-slate-700 mb-1">Tipe Atribut Kriteria</label>
                        <select name="tipe" id="tipe" class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                            <option value="benefit" {{ old('tipe', $kriteria->tipe) == 'benefit' ? 'selected' : '' }}>Benefit (Keuntungan)</option>
                            <option value="cost" {{ old('tipe', $kriteria->tipe) == 'cost' ? 'selected' : '' }}>Cost (Biaya)</option>
                        </select>
                        @error('tipe') <p class="text-xs text-rose-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4 flex items-center justify-end gap-3 border-t border-slate-100">
                        <a href="{{ route('kriteria.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold text-xs rounded-xl hover:bg-slate-200 transition">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold text-xs rounded-xl hover:bg-indigo-700 transition shadow-sm">
                            Perbarui Kriteria
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
