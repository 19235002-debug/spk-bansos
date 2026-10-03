<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-xl text-slate-800 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Manajemen Tim Proyek Sistem Informasi
            </h2>

            @if(Auth::user()->isAdmin())
                <button @click="$dispatch('open-modal', 'create-team-modal')" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl transition shadow-md shadow-indigo-200">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Tambah Anggota Tim
                </button>
            @endif
        </div>
    </x-slot>

    <div class="py-2 bg-slate-50 min-h-screen" x-data="{ editMember: null }">
        <div class="max-w-7xl mx-auto space-y-6">

            <!-- Role Distribution Cards for IT Development Team -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                <!-- PM Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-amber-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-amber-700 uppercase tracking-wider">Project Manager</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['Project Manager'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>

                <!-- Analyst Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-indigo-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-indigo-700 uppercase tracking-wider">System Analyst</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['System Analyst'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>

                <!-- Developer Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-emerald-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-emerald-700 uppercase tracking-wider">Programmer/Dev</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['Developer'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>

                <!-- DB Designer Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-purple-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-purple-700 uppercase tracking-wider">DB Designer</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['Database Designer'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>

                <!-- QA Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-rose-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-rose-700 uppercase tracking-wider">Tester / QA</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['Tester / QA'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>

                <!-- Doc & Support Card -->
                <div class="bg-white p-3.5 rounded-2xl border border-cyan-200 shadow-xs flex flex-col justify-between">
                    <p class="text-[10px] font-bold text-cyan-700 uppercase tracking-wider">Doc & Support</p>
                    <h4 class="text-xl font-black text-slate-800 mt-1">{{ $roleCounts['Doc & Support'] ?? 0 }} <span class="text-[10px] font-normal text-slate-500">Orang</span></h4>
                </div>
            </div>

            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @forelse($members as $member)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs hover:shadow-md transition duration-200 overflow-hidden flex flex-col justify-between">
                        <div>
                            <!-- Header Card with role color gradient -->
                            <div class="p-6 border-b border-slate-100 flex items-start justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    @php
                                        $initials = collect(explode(' ', $member->nama))->map(fn($n) => mb_substr($n, 0, 1))->take(2)->join('');
                                        $roleLower = strtolower($member->peran);
                                        $avatarGradient = match(true) {
                                            str_contains($roleLower, 'ketua') => 'from-amber-500 to-orange-600 shadow-amber-200',
                                            str_contains($roleLower, 'analis') => 'from-indigo-600 to-violet-600 shadow-indigo-200',
                                            str_contains($roleLower, 'developer') => 'from-emerald-500 to-teal-600 shadow-emerald-200',
                                            str_contains($roleLower, 'tester') => 'from-rose-500 to-pink-600 shadow-rose-200',
                                            default => 'from-slate-600 to-slate-800 shadow-slate-200',
                                        };
                                    @endphp
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-white font-extrabold text-xl shadow-lg shrink-0">
                                        {{ $initials }}
                                    </div>

                                    <div>
                                        <h3 class="text-lg font-bold text-slate-800 leading-snug">{{ $member->nama }}</h3>
                                        <p class="text-xs text-slate-500 font-medium">NIM: <span class="font-mono text-slate-700 font-semibold">{{ $member->nim }}</span></p>
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $member->badge_class }}">
                                                Peran: {{ $member->peran }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->isAdmin())
                                    <div class="flex items-center gap-1 shrink-0">
                                        <button 
                                            @click="editMember = {{ json_encode($member) }}; $dispatch('open-modal', 'edit-team-modal')"
                                            class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition"
                                            title="Edit Anggota">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        </button>
                                        <form action="{{ route('team.destroy', $member->id) }}" method="POST" onsubmit="confirmDelete(event, this, 'Hapus Anggota Tim?', 'Data anggota tim ini akan dihapus dari sistem secara permanen.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition" title="Hapus Anggota">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>

                            <!-- Body: Tasks & Responsibilities -->
                            <div class="p-6 space-y-4">
                                <div>
                                    <h4 class="text-xs font-semibold uppercase tracking-wider text-slate-400 flex items-center gap-1.5 mb-2">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Deskripsi Tugas & Tanggung Jawab
                                    </h4>
                                    <p class="text-sm text-slate-600 leading-relaxed bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                                        {{ $member->tugas ?? 'Bertanggung jawab dalam mendukung pengerjaan proyek sistem informasi SPK Bansos.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Links -->
                        <div class="px-6 py-3.5 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $member->email ?? 'email@si.ac.id' }}
                            </span>
                            
                            <div class="flex items-center gap-3">
                                @if($member->github_url)
                                    <a href="{{ $member->github_url }}" target="_blank" class="text-slate-400 hover:text-slate-700 transition flex items-center gap-1 font-medium">
                                        GitHub &rarr;
                                    </a>
                                @endif
                                @if($member->linkedin_url)
                                    <a href="{{ $member->linkedin_url }}" target="_blank" class="text-slate-400 hover:text-indigo-600 transition flex items-center gap-1 font-medium">
                                        LinkedIn &rarr;
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 rounded-2xl border border-slate-200 text-center">
                        <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <h4 class="text-base font-bold text-slate-700">Belum Ada Anggota Tim</h4>
                        <p class="text-xs text-slate-500 mt-1">Silakan tambahkan anggota kelompok proyek sistem informasi ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Section: Stakeholders Pengurus RT & Kelembagaan Lingkungan -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden p-6 space-y-5">
                <div class="border-b border-slate-100 pb-4 flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 border border-amber-200 rounded-full text-amber-800 text-xs font-bold mb-1">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 4h4m-4-8h4m-4-4h4"/></svg>
                            Stakeholder Lingkungan & Pengguna Sistem
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900">Susunan Pengurus RT & Kelembagaan Lingkungan</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Pemangku kepentingan (stakeholder) pengguna sistem yang memvalidasi, mengesahkan, dan mengawasi penyaluran bansos di lapangan.</p>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 bg-slate-100 text-slate-700 rounded-lg border border-slate-200 w-fit">
                        Lingkup RT 01
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Stakeholder 1: Ketua RT -->
                    <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2.5 py-0.5 bg-amber-100 text-amber-900 border border-amber-300 rounded-md text-[10px] font-black uppercase">Ketua RT</span>
                                <span class="text-[10px] text-slate-400 font-mono">Pengambil Keputusan</span>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Pak Budi Pratama</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Bertanggung jawab menetapkan kebijakan penyaluran bansos, alokasi kuota, serta mengesahkan laporan akhir hasil SAW.
                            </p>
                        </div>
                        <div class="mt-4 pt-2.5 border-t border-slate-200/80 text-[11px] text-slate-500 font-medium">
                            Peran: Stakeholder Utama & Penanggung Jawab
                        </div>
                    </div>

                    <!-- Stakeholder 2: Sekretaris RT -->
                    <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2.5 py-0.5 bg-indigo-100 text-indigo-900 border border-indigo-300 rounded-md text-[10px] font-black uppercase">Sekretaris RT</span>
                                <span class="text-[10px] text-slate-400 font-mono">Administrasi</span>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Ibu Siti Rahmawati</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Bertanggung jawab mengelola administrasi kependudukan warga, verifikasi NIK, serta pemberkasan syarat bansos.
                            </p>
                        </div>
                        <div class="mt-4 pt-2.5 border-t border-slate-200/80 text-[11px] text-slate-500 font-medium">
                            Peran: Verifikator Berkas & Data Warga
                        </div>
                    </div>

                    <!-- Stakeholder 3: Bendahara RT -->
                    <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-900 border border-emerald-300 rounded-md text-[10px] font-black uppercase">Bendahara RT</span>
                                <span class="text-[10px] text-slate-400 font-mono">Keuangan</span>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Pak Bambang</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Bertanggung jawab mengelola alokasi anggaran bantuan sosial dan pencatatan pertanggungjawaban dana.
                            </p>
                        </div>
                        <div class="mt-4 pt-2.5 border-t border-slate-200/80 text-[11px] text-slate-500 font-medium">
                            Peran: Pengelola Alokasi & Anggaran Bantuan
                        </div>
                    </div>

                    <!-- Stakeholder 4: Keamanan & LMK -->
                    <div class="p-4 bg-slate-50/80 rounded-xl border border-slate-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="px-2.5 py-0.5 bg-rose-100 text-rose-900 border border-rose-300 rounded-md text-[10px] font-black uppercase">Seksi Keamanan & LMK</span>
                                <span class="text-[10px] text-slate-400 font-mono">Pengawasan</span>
                            </div>
                            <h4 class="font-extrabold text-slate-900 text-sm">Pak Hartono (LMK)</h4>
                            <p class="text-xs text-slate-600 mt-1 leading-relaxed">
                                Bertanggung jawab menjaga keteraturan penyaluran bansos di lapangan dan independensi pengawasan publik.
                            </p>
                        </div>
                        <div class="mt-4 pt-2.5 border-t border-slate-200/80 text-[11px] text-slate-500 font-medium">
                            Peran: Pengawas Lapangan & Lembaga Warga
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create Team Member (Admin Only) -->
        @if(Auth::user()->isAdmin())
            <x-modal name="create-team-modal" focusable>
                <form method="POST" action="{{ route('team.store') }}" class="p-6">
                    @csrf
                    <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        Tambah Anggota Tim Proyek
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="nama" value="Nama Lengkap" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" placeholder="Contoh: Budi Santoso" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="nim" value="NIM" />
                                <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full" placeholder="220101001" required />
                            </div>

                            <div>
                                <x-input-label for="peran" value="Peran / Role" />
                                <select id="peran" name="peran" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" required>
                                    <option value="Project Manager">Project Manager (PM)</option>
                                    <option value="System Analyst">System Analyst (Analis Sistem)</option>
                                    <option value="Programmer / Developer">Programmer / Developer (Pengembang Aplikasi)</option>
                                    <option value="Database Designer">Database Designer (Perancang Basis Data)</option>
                                    <option value="Tester / Quality Assurance">Tester / Quality Assurance (QA)</option>
                                    <option value="Documentation & Support">Documentation & Support (Penyusun Dokumentasi)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="email" value="Email (Opsional)" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" placeholder="anggota@si.ac.id" />
                        </div>

                        <div>
                            <x-input-label for="tugas" value="Deskripsi Tugas & Tanggung Jawab" />
                            <textarea id="tugas" name="tugas" rows="3" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Rincian tugas dalam proyek sistem informasi ini..."></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="github_url" value="URL GitHub (Opsional)" />
                                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" placeholder="https://github.com/username" />
                            </div>

                            <div>
                                <x-input-label for="linkedin_url" value="URL LinkedIn (Opsional)" />
                                <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" placeholder="https://linkedin.com/in/username" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Batal
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            Simpan Anggota
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>

            <!-- Modal Edit Team Member (Admin Only) -->
            <x-modal name="edit-team-modal" focusable>
                <form method="POST" :action="'{{ url('/admin/team') }}/' + (editMember ? editMember.id : '')" class="p-6">
                    @csrf
                    @method('PUT')
                    <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Anggota Tim Proyek
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <x-input-label for="edit_nama" value="Nama Lengkap" />
                            <x-text-input id="edit_nama" name="nama" x-model="editMember ? editMember.nama : ''" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="edit_nim" value="NIM" />
                                <x-text-input id="edit_nim" name="nim" x-model="editMember ? editMember.nim : ''" type="text" class="mt-1 block w-full" required />
                            </div>

                            <div>
                                <x-input-label for="edit_peran" value="Peran / Role" />
                                <select id="edit_peran" name="peran" x-model="editMember ? editMember.peran : ''" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" required>
                                    <option value="Project Manager">Project Manager (PM)</option>
                                    <option value="System Analyst">System Analyst (Analis Sistem)</option>
                                    <option value="Programmer / Developer">Programmer / Developer (Pengembang Aplikasi)</option>
                                    <option value="Database Designer">Database Designer (Perancang Basis Data)</option>
                                    <option value="Tester / Quality Assurance">Tester / Quality Assurance (QA)</option>
                                    <option value="Documentation & Support">Documentation & Support (Penyusun Dokumentasi)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="edit_email" value="Email" />
                            <x-text-input id="edit_email" name="email" x-model="editMember ? editMember.email : ''" type="email" class="mt-1 block w-full" />
                        </div>

                        <div>
                            <x-input-label for="edit_tugas" value="Deskripsi Tugas & Tanggung Jawab" />
                            <textarea id="edit_tugas" name="tugas" x-model="editMember ? editMember.tugas : ''" rows="3" class="mt-1 block w-full border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="edit_github_url" value="URL GitHub" />
                                <x-text-input id="edit_github_url" name="github_url" x-model="editMember ? editMember.github_url : ''" type="url" class="mt-1 block w-full" />
                            </div>

                            <div>
                                <x-input-label for="edit_linkedin_url" value="URL LinkedIn" />
                                <x-text-input id="edit_linkedin_url" name="linkedin_url" x-model="editMember ? editMember.linkedin_url : ''" type="url" class="mt-1 block w-full" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Batal
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            Perbarui Data
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        @endif
    </div>
</x-app-layout>
