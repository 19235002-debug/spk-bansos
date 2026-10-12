<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-black text-xl sm:text-2xl text-slate-900 leading-tight flex items-center gap-2">
                    <svg class="w-7 h-7 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Halaman Warga
                </h2>
                <p class="text-sm text-slate-600 mt-1">
                    Selamat Datang, <strong class="text-indigo-900 font-extrabold">{{ Auth::user()->name }}</strong>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                @if($alternatif)
                    <a href="{{ route('warga.cetakWarga') }}" target="_blank"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-800 font-extrabold text-xs sm:text-sm rounded-xl border border-slate-300 transition shadow-xs">
                        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Surat Bukti PDF
                    </a>
                @endif
                <a href="{{ route('hasil.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs sm:text-sm rounded-xl transition shadow-md shadow-indigo-600/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Hasil Seleksi RT
                </a>
            </div>
        </div>
    </x-slot>

    @php
        // Persiapan nomor WhatsApp pengurus RT
        $rawPhone = preg_replace('/[^0-9]/', '', setting('contact_phone', '081234567890'));
        $waPhone = str_starts_with($rawPhone, '0') ? '62' . substr($rawPhone, 1) : $rawPhone;

        // Ambil nilai kriteria C1 s/d C4 saat ini (jika ada)
        $valC1 = 0;
        $valC2 = 1;
        $valC3 = 3;
        $valC4 = 450;
        if ($alternatif) {
            foreach ($kriteriaList as $k) {
                $p = $alternatif->penilaian->where('kriteria_id', $k->id)->first();
                if ($p) {
                    if ($k->kode_kriteria == 'C1')
                        $valC1 = (int) $p->nilai;
                    if ($k->kode_kriteria == 'C2')
                        $valC2 = (int) $p->nilai;
                    if ($k->kode_kriteria == 'C3')
                        $valC3 = (int) $p->nilai;
                    if ($k->kode_kriteria == 'C4')
                        $valC4 = (int) $p->nilai;
                }
            }
        }
    @endphp

    <div class="space-y-6" x-data="{ 
        modalKriteria: {{ ($alternatif && !$isCriteriaFilled) ? 'true' : 'false' }},
        c1Nominal: {{ $valC1 > 0 ? $valC1 : 0 }},
        c1Display: '',
        c2Jumlah: {{ $valC2 > 0 ? $valC2 : 2 }},
        c3Skor: {{ $valC3 > 0 ? $valC3 : 3 }},
        c4Daya: {{ $valC4 > 0 ? $valC4 : 450 }},
        init() {
            this.c1Display = this.c1Nominal > 0 ? this.formatRupiah(this.c1Nominal) : '';
        },
        formatRupiah(num) {
            let n = parseInt(num) || 0;
            return n > 0 ? n.toLocaleString('id-ID') : '';
        },
        onInputC1(e) {
            let raw = e.target.value.replace(/[^0-9]/g, '');
            let num = parseInt(raw) || 0;
            this.c1Nominal = num;
            this.c1Display = raw ? num.toLocaleString('id-ID') : '';
        },
        terbilang(num) {
            num = parseInt(num) || 0;
            if (num <= 0) return '-';
            const satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
            function sebut(n) {
                if (n < 12) return satuan[n];
                if (n < 20) return sebut(n - 10) + ' Belas';
                if (n < 100) return sebut(Math.floor(n / 10)) + ' Puluh ' + sebut(n % 10);
                if (n < 200) return 'Seratus ' + sebut(n - 100);
                if (n < 1000) return sebut(Math.floor(n / 100)) + ' Ratus ' + sebut(n % 100);
                if (n < 2000) return 'Seribu ' + sebut(n - 1000);
                if (n < 1000000) return sebut(Math.floor(n / 1000)) + ' Ribu ' + sebut(n % 1000);
                if (n < 1000000000) return sebut(Math.floor(n / 1000000)) + ' Juta ' + sebut(n % 1000000);
                if (n < 1000000000000) return sebut(Math.floor(n / 1000000000)) + ' Miliar ' + sebut(n % 1000000000);
                return '';
            }
            return (sebut(num).replace(/\s+/g, ' ').trim() + ' Rupiah');
        }
    }">

        <!-- ========================================================================= -->
        <!-- 1. PANDUAN LANGKAH (RAMAH WARGA & MUDAH DIIKUTI)                           -->
        <!-- ========================================================================= -->
        <div class="bg-white rounded-3xl border border-slate-200 p-5 sm:p-6 shadow-xs">
            <h3 class="text-xs font-black uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                Panduan Mudah 3 Langkah Pengajuan Bansos Warga
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <!-- Langkah 1: Akun Warga -->
                <div class="p-4 rounded-2xl border border-emerald-300 bg-emerald-50/60 flex items-center gap-3.5">
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-xs">
                        ✓
                    </div>
                    <div>
                        <span class="text-[11px] font-extrabold uppercase text-emerald-800 block">Langkah 1</span>
                        <h4 class="font-extrabold text-slate-900 text-sm">Akun Terdaftar</h4>
                        <p class="text-xs text-slate-600 mt-0.5">Akun Anda sudah aktif.</p>
                    </div>
                </div>

                <!-- Langkah 2: Sambungkan NIK KTP -->
                <div
                    class="p-4 rounded-2xl border {{ $alternatif ? 'border-emerald-300 bg-emerald-50/60' : 'border-amber-300 bg-amber-50/80 ring-2 ring-amber-300' }} flex items-center gap-3.5">
                    <div
                        class="w-10 h-10 rounded-xl {{ $alternatif ? 'bg-emerald-600 text-white' : 'bg-amber-500 text-white animate-pulse' }} flex items-center justify-center font-black text-sm shrink-0 shadow-xs">
                        {{ $alternatif ? '✓' : '2' }}
                    </div>
                    <div>
                        <span
                            class="text-[11px] font-extrabold uppercase {{ $alternatif ? 'text-emerald-800' : 'text-amber-900' }} block">Langkah
                            2</span>
                        <h4 class="font-extrabold text-slate-900 text-sm">Sambungkan Nomor KTP</h4>
                        <p class="text-xs text-slate-600 mt-0.5">
                            {{ $alternatif ? 'Sudah terhubung: ' . $alternatif->nik : 'Wajib diisi agar terdata RT.' }}
                        </p>
                    </div>
                </div>

                <!-- Langkah 3: Formulir Kriteria Keluarga -->
                <div
                    class="p-4 rounded-2xl border {{ ($alternatif && $isCriteriaFilled) ? 'border-emerald-300 bg-emerald-50/60' : ($alternatif ? 'border-amber-300 bg-amber-50/80 ring-2 ring-amber-300' : 'border-slate-200 bg-slate-50 opacity-70') }} flex items-center gap-3.5">
                    <div
                        class="w-10 h-10 rounded-xl {{ ($alternatif && $isCriteriaFilled) ? 'bg-emerald-600 text-white' : ($alternatif ? 'bg-amber-500 text-white animate-pulse' : 'bg-slate-300 text-slate-600') }} flex items-center justify-center font-black text-sm shrink-0 shadow-xs">
                        {{ ($alternatif && $isCriteriaFilled) ? '✓' : '3' }}
                    </div>
                    <div>
                        <span
                            class="text-[11px] font-extrabold uppercase {{ ($alternatif && $isCriteriaFilled) ? 'text-emerald-800' : ($alternatif ? 'text-amber-900' : 'text-slate-500') }} block">Langkah
                            3</span>
                        <h4 class="font-extrabold text-slate-900 text-sm">Isi Pertanyaan Keluarga</h4>
                        <p class="text-xs text-slate-600 mt-0.5">
                            {{ ($alternatif && $isCriteriaFilled) ? 'Data lengkap & siap dinilai.' : 'Pendapatan, tanggungan, dll.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================================================= -->
        <!-- KONDISI A: WARGA BARU BELUM SAMBUNGKAN NIK (TAMPILAN SANGAT SEDERHANA)    -->
        <!-- ========================================================================= -->
        @if(!$alternatif)
            <div class="max-w-xl mx-auto bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6"
                x-data="{ tab: 'mandiri' }">
                <div class="text-center space-y-2">
                    <div
                        class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center mx-auto shadow-2xs">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                        </svg>
                    </div>
                    <h3 class="text-xl sm:text-2xl font-black text-slate-900">Sambungkan Nomor KTP Anda</h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed max-w-md mx-auto">
                        Cukup ketik 16 angka NIK yang tertera di KTP Anda agar sistem dapat menyambungkan akun dengan data
                        warga RT.
                    </p>
                </div>

                <!-- Tab Pemilihan Jika RT Sudah Daftarkan Nama -->
                @if($unlinkedAlternatifList->count() > 0)
                    <div class="flex items-center gap-2 p-1.5 bg-slate-100 rounded-2xl">
                        <button type="button" @click="tab = 'mandiri'"
                            :class="tab === 'mandiri' ? 'bg-white text-indigo-800 shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                            class="flex-1 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition text-center">
                            Ketik Nomor KTP Sendiri
                        </button>
                        <button type="button" @click="tab = 'pilih'"
                            :class="tab === 'pilih' ? 'bg-white text-indigo-800 shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                            class="flex-1 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition text-center">
                            Pilih Nama Dari Daftar RT
                        </button>
                    </div>
                @endif

                <!-- Form Ketik NIK Sendiri -->
                <div x-show="tab === 'mandiri'">
                    <form action="{{ route('warga.claimNik') }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                Nomor Induk Kependudukan (NIK KTP) <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" name="nik" required maxlength="20" placeholder="Contoh: 3173022304750001"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 focus:border-indigo-600 focus:ring-0 transition" />
                            <p class="text-xs text-slate-500 mt-1">Ketik 16 angka di bagian paling atas KTP Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">No. Kartu Keluarga (KK)</label>
                                <input type="text" name="no_kk" inputmode="numeric" maxlength="20"
                                    placeholder="16 digit No. KK (Opsional)"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 focus:border-indigo-600 focus:ring-0" />
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Pekerjaan Utama <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="pekerjaan" required placeholder="Misal: Penjaga SPBU, Buruh, Ojol"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 focus:border-indigo-600 focus:ring-0" />
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">Wilayah RT / RW <span
                                        class="text-rose-500">*</span></label>
                                <input type="text" name="rt_rw" required value="RT 011/04"
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 bg-slate-50 focus:border-indigo-600 focus:ring-0" />
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                                Sambungkan KTP Saya Sekarang &rarr;
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Form Pilih Dari RT -->
                @if($unlinkedAlternatifList->count() > 0)
                    <div x-show="tab === 'pilih'" style="display: none;">
                        <form action="{{ route('warga.claimNik') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                    Pilih Nama & NIK Anda:
                                </label>
                                <select name="nik" required
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 focus:border-indigo-600 focus:ring-0">
                                    <option value="">-- Klik di sini untuk memilih nama Anda --</option>
                                    @foreach($unlinkedAlternatifList as $unlinked)
                                        <option value="{{ $unlinked->nik }}">
                                            {{ $unlinked->nama_warga }} (NIK: {{ $unlinked->nik }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition shadow-sm flex items-center justify-center gap-2">
                                Sambungkan Nama Saya &rarr;
                            </button>
                        </form>
                    </div>
                @endif

                <!-- Bantuan WhatsApp Jika Gaptek -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Kesulitan mengisi nomor KTP?</span>
                    <a href="https://wa.me/{{ $waPhone }}?text=Halo%20Pengurus%20RT,%20saya%20butuh%20bantuan%20mendaftarkan%20nomor%20KTP"
                        target="_blank" rel="noopener noreferrer"
                        class="font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                        Tanya Pengurus RT &rarr;
                    </a>
                </div>
            </div>
        @endif

        <!-- ========================================================================= -->
        <!-- KONDISI B: WARGA SUDAH SAMBUNGKAN NIK                                     -->
        <!-- ========================================================================= -->
        @if($alternatif)

            <!-- Peringatan Ramah Jika Belum Isi Kriteria -->
            @if(!$isCriteriaFilled)
                <div
                    class="p-5 rounded-3xl bg-amber-50 border-2 border-amber-300 text-amber-950 flex flex-col sm:flex-row sm:items-center justify-between gap-4 shadow-sm">
                    <div class="flex items-start gap-3.5">
                        <div
                            class="w-10 h-10 rounded-2xl bg-amber-500 text-white flex items-center justify-center font-black text-lg shrink-0">
                            !
                        </div>
                        <div>
                            <h4 class="font-black text-base text-amber-950">Tinggal 1 Langkah Lagi: Lengkapi 4 Pertanyaan
                                Keluarga</h4>
                            <p class="text-xs sm:text-sm text-amber-900 mt-0.5">
                                KTP Anda sudah terhubung. Sekarang jawab 4 pertanyaan singkat seputar penghasilan dan rumah agar
                                pengajuan bansos dapat dinilai.
                            </p>
                        </div>
                    </div>
                    <button @click="modalKriteria = true" type="button"
                        class="px-5 py-3 bg-amber-600 hover:bg-amber-700 text-white text-xs sm:text-sm font-extrabold rounded-2xl transition whitespace-nowrap shadow-md">
                        Isi 4 Pertanyaan Sekarang &rarr;
                    </button>
                </div>
            @endif

            <!-- 2 Kolom Bersih: Kiri Status, Kanan 4 Jawaban Kriteria -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <!-- KOLOM KIRI (5 Kolom): KARTU HASIL & DATA DIRI -->
                <div class="lg:col-span-5 space-y-5">

                    <!-- Kartu Hasil Kelayakan Bansos RT -->
                    <div
                        class="bg-gradient-to-br from-indigo-900 via-indigo-950 to-slate-900 text-white rounded-3xl p-6 sm:p-7 shadow-xl space-y-5">
                        <div class="flex items-center justify-between">
                            <span
                                class="px-3 py-1 rounded-full text-xs font-black uppercase {{ ($userRank && $userRank['rank'] <= 10) ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-400/40' : (($userRank && $userRank['rank'] <= 15) ? 'bg-amber-500/20 text-amber-300 border border-amber-400/40' : 'bg-slate-700 text-slate-300') }}">
                                @if($userRank)
                                    {{ $userRank['rank'] <= 10 ? 'Lolos Kuota Penerima Bansos' : ($userRank['rank'] <= 15 ? 'Daftar Cadangan' : 'Antrean Pengajuan') }}
                                @else
                                    Sedang Diproses RT
                                @endif
                            </span>
                            <span class="text-xs font-bold text-indigo-300">{{ $alternatif->rt_rw ?? 'RT 011/04' }}</span>
                        </div>

                        <div>
                            <span class="text-xs text-indigo-300 font-bold uppercase tracking-wider block">Nama Kepala
                                Keluarga:</span>
                            <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight mt-0.5">
                                {{ $alternatif->nama_warga }}
                            </h3>
                            <p class="text-xs font-mono text-indigo-200 mt-1">NIK: {{ $alternatif->nik }}</p>
                        </div>

                        <!-- Peringkat Metric -->
                        <div class="grid grid-cols-2 gap-3 pt-3 border-t border-white/15">
                            <div class="bg-white/10 rounded-2xl p-3.5 text-center">
                                <span class="text-[11px] font-bold uppercase text-indigo-200 block">Peringkat Anda</span>
                                <span class="text-2xl font-black text-white block mt-0.5">
                                    {{ $userRank ? '#' . $userRank['rank'] : '-' }}
                                </span>
                                <span class="text-[10px] text-slate-300 block">dari {{ count($sawData['ranking']) }}
                                    pendaftar</span>
                            </div>
                            <div class="bg-white/10 rounded-2xl p-3.5 text-center">
                                <span class="text-[11px] font-bold uppercase text-indigo-200 block">Status Kuota</span>
                                <span class="text-sm font-black text-emerald-400 block mt-2">
                                    {{ ($userRank && $userRank['rank'] <= 10) ? 'Lolos Utama' : (($userRank && $userRank['rank'] <= 15) ? 'Cadangan' : 'Antrean') }}
                                </span>
                            </div>
                        </div>

                        <!-- Tombol Download Bukti -->
                        <div class="pt-1">
                            <a href="{{ route('warga.cetakWarga') }}" target="_blank"
                                class="w-full py-3 bg-white hover:bg-slate-100 text-indigo-950 font-black text-xs sm:text-sm rounded-2xl transition flex items-center justify-center gap-2 shadow-md">
                                <svg class="w-4 h-4 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                </svg>
                                Cetak Surat Bukti PDF Resmi
                            </a>
                        </div>
                    </div>

                    <!-- Kartu Data Identitas Singkat -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-5 sm:p-6 shadow-xs space-y-3.5">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h4 class="font-black text-xs uppercase tracking-wider text-slate-500">
                                Data Kependudukan Terdaftar
                            </h4>
                            <span
                                class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200">
                                Terverifikasi
                            </span>
                        </div>

                        <div class="space-y-2.5 text-xs sm:text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Pekerjaan:</span>
                                <span class="font-extrabold text-slate-800">{{ $alternatif->pekerjaan ?? '-' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Wilayah:</span>
                                <span class="font-extrabold text-slate-800">{{ $alternatif->rt_rw ?? 'RT 011/04' }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">No. Kartu Keluarga:</span>
                                <span class="font-mono font-bold text-slate-800">{{ $alternatif->no_kk ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- KOLOM KANAN (7 Kolom): 4 JAWABAN KRITERIA KELUARGA -->
                <div class="lg:col-span-7 space-y-5">

                    <!-- Kartu Jawaban Kriteria Warga -->
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-7 shadow-xs space-y-5">
                        <div
                            class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-100 pb-4">
                            <div>
                                <h3 class="text-base sm:text-lg font-black text-slate-900 flex items-center gap-2">
                                    <span class="w-3 h-3 rounded-full bg-indigo-600"></span>
                                    Data Keluarga Yang Anda Masukkan
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                                    Nilai ini digunakan sistem untuk menghitung bansos secara adil.
                                </p>
                            </div>

                            <!-- Tombol Ubah Data: Disembunyikan Jika Data Sudah Lengkap (Hanya Bisa Diubah Oleh Admin RT) -->
                            @if(!$isCriteriaFilled)
                                <button @click="modalKriteria = true" type="button"
                                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs sm:text-sm font-extrabold rounded-xl transition shadow-md shadow-indigo-600/20 whitespace-nowrap">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Lengkapi Data Keluarga
                                </button>
                            @endif
                        </div>

                        <!-- 4 Kartu Jawaban Kriteria Yang Jelas & Gampang Dibaca -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Kriteria 1: Penghasilan -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-1.5">
                                <span class="text-xs font-bold text-slate-500 block">1. Penghasilan Bulanan Keluarga</span>
                                <span class="text-lg font-black text-indigo-700 block font-mono">
                                    Rp {{ number_format($valC1, 0, ',', '.') }}
                                </span>
                                <span class="text-[11px] text-slate-500 block">Total pemasukan seluruh anggota
                                    keluarga</span>
                            </div>

                            <!-- Kriteria 2: Tanggungan -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-1.5">
                                <span class="text-xs font-bold text-slate-500 block">2. Jumlah Tanggungan di Rumah</span>
                                <span class="text-lg font-black text-indigo-700 block">
                                    {{ $valC2 }} Orang
                                </span>
                                <span class="text-[11px] text-slate-500 block">Anak, lansia, atau anggota belum
                                    bekerja</span>
                            </div>

                            <!-- Kriteria 3: Kondisi Rumah -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-1.5">
                                <span class="text-xs font-bold text-slate-500 block">3. Keadaan Bangunan Rumah</span>
                                <span class="text-base font-black text-indigo-700 block">
                                    @if($valC3 == 5)
                                        Sangat Rusak (Prioritas Utama)
                                    @elseif($valC3 == 4)
                                        Butuh Perbaikan Berat
                                    @elseif($valC3 == 3)
                                        Cukup Layak (Semi Permanen)
                                    @elseif($valC3 == 2)
                                        Rumah Layak Huni
                                    @else
                                        Rumah Sangat Layak
                                    @endif
                                </span>
                                <span class="text-[11px] text-slate-500 block">Tingkat kelayakan atap, dinding &
                                    lantai</span>
                            </div>

                            <!-- Kriteria 4: Listrik -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/90 space-y-1.5">
                                <span class="text-xs font-bold text-slate-500 block">4. Daya Listrik Rumah</span>
                                <span class="text-lg font-black text-indigo-700 block font-mono">
                                    {{ $valC4 }} VA
                                </span>
                                <span class="text-[11px] text-slate-500 block">
                                    {{ $valC4 <= 450 ? 'Listrik Bersubsidi (Prioritas Tertinggi)' : 'Kapasitas terpasang PLN' }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Bantuan WhatsApp Pengurus RT -->
                        <div
                            class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-xs sm:text-sm font-extrabold text-emerald-950">Butuh bantuan mengisi
                                        atau ada yang salah?</h5>
                                    <p class="text-xs text-emerald-800">Pengurus RT siap membantu via WhatsApp atau datang
                                        ke kantor RT.</p>
                                </div>
                            </div>
                            <a href="https://wa.me/{{ $waPhone }}?text=Halo%20Pengurus%20RT,%20saya%20warga%20RT%20ingin%20bertanya%20seputar%20pengajuan%20bansos"
                                target="_blank" rel="noopener noreferrer"
                                class="px-4 py-2 bg-emerald-700 hover:bg-emerald-800 text-white font-extrabold text-xs rounded-xl transition whitespace-nowrap shadow-xs text-center">
                                Chat WhatsApp RT
                            </a>
                        </div>
                    </div>

                </div>

            </div>

            <!-- ========================================================================= -->
            <!-- MODAL POPUP: FORMULIR 4 PERTANYAAN KELUARGA (HANYA MUNCUL JIKA BELUM LENGKAP) -->
            <!-- ========================================================================= -->
            @if(!$isCriteriaFilled)
                <div x-show="modalKriteria" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-3 sm:p-6"
                    style="display: none;">
                    <div @click.away="modalKriteria = false"
                        class="bg-white rounded-3xl border border-slate-200 w-full max-w-2xl max-h-[92vh] overflow-y-auto shadow-2xl p-6 sm:p-8 space-y-6">
                        <!-- Header Modal Yang Jelas & Bersahabat -->
                        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                            <div>
                                <span
                                    class="px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 text-xs font-extrabold uppercase">
                                    Formulir Warga RT
                                </span>
                                <h3 class="text-lg sm:text-xl font-black text-slate-900 mt-1">
                                    Jawab 4 Pertanyaan Singkat Keluarga
                                </h3>
                                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                                    Pilih jawaban yang paling sesuai dengan keadaan keluarga Anda saat ini.
                                </p>
                            </div>
                            <button @click="modalKriteria = false" type="button"
                                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition"
                                title="Tutup">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('warga.updatePengajuan') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Data Identitas Kependudukan (No KK, Pekerjaan, RT/RW, Alamat) -->
                            <div class="bg-slate-50 p-4 sm:p-5 rounded-2xl border border-slate-200/90 space-y-3.5">
                                <div class="flex items-center justify-between border-b border-slate-200/70 pb-2.5">
                                    <span
                                        class="text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                        Data Kartu Keluarga & Pekerjaan
                                    </span>
                                    <span class="text-[11px] text-slate-500 font-medium">Bisa diperbarui kapan saja</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                                    <!-- No. Kartu Keluarga (KK) -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                            No. Kartu Keluarga (KK)
                                        </label>
                                        <input type="text" name="no_kk" inputmode="numeric" maxlength="20"
                                            value="{{ old('no_kk', $alternatif->no_kk) }}"
                                            placeholder="16 digit No. KK, contoh: 3173020101010001"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 bg-white focus:border-indigo-600 focus:ring-0" />
                                        <span class="text-[11px] text-slate-400 mt-1 block">Tercantum di bagian atas Kartu Keluarga</span>
                                    </div>

                                    <!-- Pekerjaan Utama Anda -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                            Pekerjaan Utama Anda <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" name="pekerjaan" required
                                            value="{{ old('pekerjaan', $alternatif->pekerjaan) }}"
                                            placeholder="Misal: Penjaga SPBU, Buruh Harian, Pedagang"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 bg-white focus:border-indigo-600 focus:ring-0" />
                                        <span class="text-[11px] text-slate-400 mt-1 block">Pekerjaan kepala keluarga / pencari nafkah</span>
                                    </div>

                                    <!-- Wilayah RT / RW -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                            Wilayah RT / RW <span class="text-rose-500">*</span>
                                        </label>
                                        <input type="text" name="rt_rw" required
                                            value="{{ old('rt_rw', $alternatif->rt_rw ?? 'RT 011/04') }}"
                                            placeholder="Contoh: RT 011/04"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 bg-white focus:border-indigo-600 focus:ring-0" />
                                    </div>

                                    <!-- Alamat Rumah / Domisili -->
                                    <div>
                                        <label class="block text-xs font-bold uppercase text-slate-700 mb-1">
                                            Alamat Rumah / Gang <span class="text-slate-400 font-normal lowercase">(opsional)</span>
                                        </label>
                                        <input type="text" name="alamat" value="{{ old('alamat', $alternatif->alamat) }}"
                                            placeholder="Nama jalan, gang, atau nomor rumah"
                                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 bg-white focus:border-indigo-600 focus:ring-0" />
                                    </div>
                                </div>
                            </div>

                            <!-- 4 PERTANYAAN (UKURAN KONSISTEN DENGAN FORM ADMIN) -->
                            <div class="space-y-4">

                                @foreach($kriteriaList as $k)
                                    @if($k->kode_kriteria == 'C1')
                                        <!-- ================= PERTANYAAN 1: PENGHASILAN BULANAN ================= -->
                                        <div class="p-4 sm:p-5 rounded-2xl border border-slate-200 bg-white space-y-2.5 shadow-2xs">
                                            <div class="flex items-center justify-between">
                                                <label class="block text-sm font-bold text-slate-900">
                                                    1. Berapa perkiraan penghasilan seluruh keluarga per bulan? <span
                                                        class="text-rose-500">*</span>
                                                </label>
                                                <span
                                                    class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded">C1</span>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                Ketik nominal penghasilan bulanan keluarga (angka otomatis diberi titik pemisah rupiah):
                                            </p>

                                            <!-- Input Angka Berformat Ribuan (Ukuran Standar text-sm Sesuai Form Admin) -->
                                            <div>
                                                <div class="relative">
                                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center font-bold text-sm text-slate-500 pointer-events-none">Rp</span>
                                                    <input 
                                                        type="text" 
                                                        inputmode="numeric"
                                                        x-model="c1Display"
                                                        @input="onInputC1($event)"
                                                        placeholder="Contoh: 1.500.000"
                                                        class="w-full pl-11 pr-3.5 py-2.5 rounded-xl border border-slate-300 text-sm font-medium text-slate-900 focus:border-indigo-600 focus:ring-0"
                                                    />
                                                </div>
                                                <!-- Nilai Angka Murni Untuk Disimpan Ke Database -->
                                                <input type="hidden" name="nilai[{{ $k->id }}]" :value="c1Nominal" required />

                                                <!-- Keterangan Terbilang -->
                                                <div class="mt-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center gap-2 text-xs">
                                                    <span class="font-medium text-slate-500 shrink-0">Terbilang:</span>
                                                    <span class="font-bold text-indigo-700 text-xs" x-text="terbilang(c1Nominal)"></span>
                                                </div>
                                            </div>
                                        </div>

                                    @elseif($k->kode_kriteria == 'C2')
                                        <!-- ================= PERTANYAAN 2: JUMLAH TANGGUNGAN ================= -->
                                        <div class="p-4 sm:p-5 rounded-2xl border border-slate-200 bg-white space-y-2.5 shadow-2xs">
                                            <div class="flex items-center justify-between">
                                                <label class="block text-sm font-bold text-slate-900">
                                                    2. Berapa jumlah orang yang ditanggung di rumah Anda? <span
                                                        class="text-rose-500">*</span>
                                                </label>
                                                <span
                                                    class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded">C2</span>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                Termasuk anak, lansia, orang tua, atau anggota keluarga yang belum bekerja:
                                            </p>

                                            <!-- Pilihan Cepat Tombol Jumlah Orang -->
                                            <div class="grid grid-cols-5 gap-2">
                                                @foreach([1, 2, 3, 4, 5] as $jml)
                                                    <button type="button" @click="c2Jumlah = {{ $jml }}"
                                                        :class="c2Jumlah == {{ $jml }} ? 'bg-indigo-600 text-white font-bold shadow-xs' : 'bg-slate-100 text-slate-800 hover:bg-slate-200 font-medium'"
                                                        class="py-2.5 px-2 rounded-xl text-xs sm:text-sm transition text-center">
                                                        {{ $jml }} {{ $jml == 5 ? '+' : '' }} Orang
                                                    </button>
                                                @endforeach
                                            </div>

                                            <input type="hidden" name="nilai[{{ $k->id }}]" :value="c2Jumlah" />
                                        </div>

                                    @elseif($k->kode_kriteria == 'C3')
                                        <!-- ================= PERTANYAAN 3: KONDISI RUMAH ================= -->
                                        <div class="p-4 sm:p-5 rounded-2xl border border-slate-200 bg-white space-y-2.5 shadow-2xs">
                                            <div class="flex items-center justify-between">
                                                <label class="block text-sm font-bold text-slate-900">
                                                    3. Bagaimana kondisi fisik rumah tinggal Anda saat ini? <span
                                                        class="text-rose-500">*</span>
                                                </label>
                                                <span
                                                    class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded">C3</span>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                Pilih salah satu keadaan yang paling mirip dengan rumah Anda:
                                            </p>

                                            <!-- Pilihan Kartu Visual Kondisi Rumah (Ukuran Rapi & Proporsional) -->
                                            <div class="space-y-2">
                                                <!-- Pilihan 1: Sangat Rusak (Skor 5) -->
                                                <button type="button" @click="c3Skor = 5"
                                                    :class="c3Skor == 5 ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-500 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'"
                                                    class="w-full p-3 rounded-xl border text-left transition flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <div class="flex items-center gap-2">
                                                            <span
                                                                class="font-bold text-xs sm:text-sm text-slate-900 block truncate">Sangat
                                                                Rusak / Mendesak</span>
                                                            <span
                                                                class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700">Prioritas
                                                                Utama</span>
                                                        </div>
                                                        <span class="text-xs text-slate-500 block mt-0.5">Dinding papan lapuk, lantai
                                                            tanah, atau atap bocor parah</span>
                                                    </div>
                                                    <div class="shrink-0">
                                                        <div :class="c3Skor == 5 ? 'bg-indigo-600 text-white border-indigo-600' : 'border-slate-300 text-transparent'"
                                                            class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>

                                                <!-- Pilihan 2: Butuh Perbaikan Berat (Skor 4) -->
                                                <button type="button" @click="c3Skor = 4"
                                                    :class="c3Skor == 4 ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-500 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'"
                                                    class="w-full p-3 rounded-xl border text-left transition flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <span
                                                            class="font-bold text-xs sm:text-sm text-slate-900 block truncate">Butuh
                                                            Perbaikan Berat</span>
                                                        <span class="text-xs text-slate-500 block mt-0.5">Dinding retak, atap bocor,
                                                            atau sirkulasi udara minim</span>
                                                    </div>
                                                    <div class="shrink-0">
                                                        <div :class="c3Skor == 4 ? 'bg-indigo-600 text-white border-indigo-600' : 'border-slate-300 text-transparent'"
                                                            class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>

                                                <!-- Pilihan 3: Rumah Sederhana Cukup Layak (Skor 3) -->
                                                <button type="button" @click="c3Skor = 3"
                                                    :class="c3Skor == 3 ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-500 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'"
                                                    class="w-full p-3 rounded-xl border text-left transition flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-xl bg-sky-100 text-sky-600 flex items-center justify-center shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <span
                                                            class="font-bold text-xs sm:text-sm text-slate-900 block truncate">Rumah
                                                            Sederhana Cukup Layak</span>
                                                        <span class="text-xs text-slate-500 block mt-0.5">Bangunan semi permanen
                                                            sederhana, lantai semen rata</span>
                                                    </div>
                                                    <div class="shrink-0">
                                                        <div :class="c3Skor == 3 ? 'bg-indigo-600 text-white border-indigo-600' : 'border-slate-300 text-transparent'"
                                                            class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>

                                                <!-- Pilihan 4: Rumah Layak Huni (Skor 2) -->
                                                <button type="button" @click="c3Skor = 2"
                                                    :class="c3Skor == 2 ? 'border-indigo-600 bg-indigo-50/70 ring-1 ring-indigo-500 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-white'"
                                                    class="w-full p-3 rounded-xl border text-left transition flex items-center gap-3">
                                                    <div
                                                        class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                        </svg>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <span
                                                            class="font-bold text-xs sm:text-sm text-slate-900 block truncate">Rumah
                                                            Layak Huni</span>
                                                        <span class="text-xs text-slate-500 block mt-0.5">Dinding permanen kokoh, lantai
                                                            keramik, sanitasi baik</span>
                                                    </div>
                                                    <div class="shrink-0">
                                                        <div :class="c3Skor == 2 ? 'bg-indigo-600 text-white border-indigo-600' : 'border-slate-300 text-transparent'"
                                                            class="w-4 h-4 rounded-full border-2 flex items-center justify-center transition">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </button>
                                            </div>

                                            <input type="hidden" name="nilai[{{ $k->id }}]" :value="c3Skor" />
                                        </div>

                                    @elseif($k->kode_kriteria == 'C4')
                                        <!-- ================= PERTANYAAN 4: DAYA LISTRIK PLN ================= -->
                                        <div class="p-4 sm:p-5 rounded-2xl border border-slate-200 bg-white space-y-2.5 shadow-2xs">
                                            <div class="flex items-center justify-between">
                                                <label class="block text-sm font-bold text-slate-900">
                                                    4. Berapa kapasitas daya listrik PLN di rumah tinggal? <span
                                                        class="text-rose-500">*</span>
                                                </label>
                                                <span
                                                    class="text-xs font-bold text-indigo-700 bg-indigo-50 px-2 py-0.5 rounded">C4</span>
                                            </div>
                                            <p class="text-xs text-slate-500">
                                                Pilih daya listrik meteran yang terpasang di rumah Anda:
                                            </p>

                                            <div class="grid grid-cols-2 gap-2.5">
                                                <button type="button" @click="c4Daya = 450"
                                                    :class="c4Daya == 450 ? 'border-indigo-600 bg-indigo-50 text-indigo-900 font-bold ring-1 ring-indigo-500' : 'border-slate-200 bg-slate-50 text-slate-800'"
                                                    class="p-2.5 rounded-xl border text-center transition">
                                                    <span class="text-sm font-bold block">450 VA</span>
                                                    <span class="text-[11px] font-medium text-emerald-700 block mt-0.5">Listrik
                                                        Bersubsidi</span>
                                                </button>

                                                <button type="button" @click="c4Daya = 900"
                                                    :class="c4Daya == 900 ? 'border-indigo-600 bg-indigo-50 text-indigo-900 font-bold ring-1 ring-indigo-500' : 'border-slate-200 bg-slate-50 text-slate-800'"
                                                    class="p-2.5 rounded-xl border text-center transition">
                                                    <span class="text-sm font-bold block">900 VA</span>
                                                    <span class="text-[11px] text-slate-500 block mt-0.5">Subsidi / Reguler</span>
                                                </button>

                                                <button type="button" @click="c4Daya = 1300"
                                                    :class="c4Daya == 1300 ? 'border-indigo-600 bg-indigo-50 text-indigo-900 font-bold ring-1 ring-indigo-500' : 'border-slate-200 bg-slate-50 text-slate-800'"
                                                    class="p-2.5 rounded-xl border text-center transition">
                                                    <span class="text-sm font-bold block">1.300 VA</span>
                                                    <span class="text-[11px] text-slate-500 block mt-0.5">Listrik Standar</span>
                                                </button>

                                                <button type="button" @click="c4Daya = 2200"
                                                    :class="c4Daya == 2200 ? 'border-indigo-600 bg-indigo-50 text-indigo-900 font-bold ring-1 ring-indigo-500' : 'border-slate-200 bg-slate-50 text-slate-800'"
                                                    class="p-2.5 rounded-xl border text-center transition">
                                                    <span class="text-sm font-bold block">2.200 VA+</span>
                                                    <span class="text-[11px] text-slate-500 block mt-0.5">Daya Menengah</span>
                                                </button>
                                            </div>

                                            <input type="hidden" name="nilai[{{ $k->id }}]" :value="c4Daya" />
                                        </div>
                                    @endif
                                @endforeach

                            </div>

                            <!-- Tombol Aksi Simpan & Batal (Konsisten Dengan Form Admin) -->
                            <div
                                class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-2.5">
                                <button @click="modalKriteria = false" type="button"
                                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-50 text-sm font-bold transition text-center">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="w-full sm:w-auto px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold transition shadow-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Simpan Jawaban Saya
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        @endif

    </div>
</x-app-layout>