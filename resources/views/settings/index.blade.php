<x-app-layout>
    <form id="form-settings-update" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-slot name="header">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-200 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-xl text-slate-900 leading-tight">
                        Pengaturan Sistem
                    </h2>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Kelola identitas, logo, stempel resmi RT,
                        dan informasi kontak sistem.</p>
                </div>
            </div>
        </x-slot>

        <div class="py-6 bg-slate-50/70 min-h-screen">
            <div class="max-w-7xl mx-auto">

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                    <!-- LEFT COLUMN: IDENTITAS & KONTAK (7 cols) -->
                    <div class="lg:col-span-7 xl:col-span-8 space-y-6">

                        <!-- CARD 1: IDENTITAS UTAMA -->
                        <div
                            class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-5 transition hover:shadow-md">
                            <div class="flex items-center gap-3 border-b border-slate-100 pb-3.5">
                                <div
                                    class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-1-5h1.01M9 16h.01M9 12h.01M9 8h.01M15 16h.01M15 12h.01M15 8h.01" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-slate-800">Identitas & Branding Portal</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Atur nama portal, tagline, dan alamat
                                        instansi RT / RW.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Nama Aplikasi / Portal <span class="text-rose-500">*</span>
                                    </label>
                                    <input type="text" name="app_name"
                                        value="{{ old('app_name', $settings['app_name']) }}" required
                                        class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-bold text-slate-900 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                    <p class="text-[11px] text-slate-400 mt-1">Ditampilkan pada judul tab browser,
                                        header navbar, dan dokumen laporan cetak.</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            Tagline / Subtitle Portal
                                        </label>
                                        <input type="text" name="app_tagline"
                                            value="{{ old('app_tagline', $settings['app_tagline']) }}"
                                            class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                        <p class="text-[11px] text-slate-400 mt-1">Sub-judul singkat pada logo portal.
                                        </p>
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            Nama Wilayah / Institusi
                                        </label>
                                        <input type="text" name="institution_name"
                                            value="{{ old('institution_name', $settings['institution_name']) }}"
                                            class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                        <p class="text-[11px] text-slate-400 mt-1">Nama RT/RW atau instansi pengelola.
                                        </p>
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Alamat Lengkap Sekretariat / Kantor
                                    </label>
                                    <input type="text" name="address" value="{{ old('address', $settings['address']) }}"
                                        class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                    <p class="text-[11px] text-slate-400 mt-1">Alamat resmi yang tercetak di Kop Surat
                                        laporan PDF.</p>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 2: FOOTER & HELPDESK KONTAK -->
                        <div
                            class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-5 transition hover:shadow-md">
                            <div class="flex items-center gap-3 border-b border-slate-100 pb-3.5">
                                <div
                                    class="w-9 h-9 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-slate-800">Footer & Kontak Helpdesk</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Teks hak cipta footer dan saluran bantuan
                                        bagi warga.</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                        Teks Copyright Footer
                                    </label>
                                    <input type="text" name="footer_text"
                                        value="{{ old('footer_text', $settings['footer_text']) }}"
                                        class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-medium text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                    <p class="text-[11px] text-slate-400 mt-1">Ditampilkan pada bagian paling bawah
                                        seluruh halaman.</p>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            Email Official Helpdesk
                                        </label>
                                        <input type="email" name="contact_email"
                                            value="{{ old('contact_email', $settings['contact_email']) }}"
                                            class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                    </div>

                                    <div>
                                        <label
                                            class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                            No. Telepon / WhatsApp RT
                                        </label>
                                        <input type="text" name="contact_phone"
                                            value="{{ old('contact_phone', $settings['contact_phone']) }}"
                                            class="w-full px-3.5 py-2.5 bg-slate-50/80 border border-slate-200 rounded-xl text-xs sm:text-sm font-semibold text-slate-800 focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/10 transition shadow-2xs">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- RIGHT COLUMN: MEDIA ASSETS (5 cols) -->
                    <div class="lg:col-span-5 xl:col-span-4 space-y-6">

                        <!-- CARD 3: LOGO & FAVICON -->
                        <div
                            class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4 transition hover:shadow-md">
                            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-base font-bold text-slate-800">Logo Aplikasi & Favicon</h3>
                                    <p class="text-xs text-slate-500 mt-0.5">Aset gambar visual portal</p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <!-- 1. Logo Utama Aplikasi -->
                                <div class="p-3.5 bg-slate-50/70 rounded-xl border border-slate-200/70 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label class="block text-xs font-bold text-slate-800">1. Logo Utama
                                            (Sidebar/Header)</label>
                                        <span class="text-[10px] text-slate-400 font-semibold">PNG / SVG</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-14 h-12 rounded-lg border border-slate-200 bg-slate-900 flex items-center justify-center shrink-0 p-1 overflow-hidden shadow-2xs">
                                            @if(!empty($settings['app_logo']) && file_exists(public_path($settings['app_logo'])))
                                                <img src="{{ asset($settings['app_logo']) }}" alt="Logo"
                                                    class="max-h-8 object-contain">
                                            @else
                                                <span class="text-[10px] font-black text-indigo-400">SPK</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" name="app_logo" accept=".png,.jpg,.jpeg,.svg"
                                                class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Favicon Browser -->
                                <div class="p-3.5 bg-slate-50/70 rounded-xl border border-slate-200/70 space-y-2">
                                    <div class="flex items-center justify-between">
                                        <label class="block text-xs font-bold text-slate-800">2. Favicon Tab
                                            Browser</label>
                                        <span class="text-[10px] text-slate-400 font-semibold">ICO / PNG / SVG</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-14 h-12 rounded-lg border border-slate-200 bg-slate-100 flex items-center justify-center shrink-0 overflow-hidden shadow-2xs">
                                            @if(!empty($settings['favicon']) && file_exists(public_path($settings['favicon'])))
                                                <img src="{{ asset($settings['favicon']) }}" alt="Favicon"
                                                    class="w-7 h-7 object-contain">
                                            @else
                                                <span
                                                    class="w-6 h-6 rounded-md bg-indigo-600 text-white flex items-center justify-center font-black text-xs">S</span>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" name="favicon" accept=".ico,.png,.jpg,.jpeg,.svg"
                                                class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CARD 4: STEMPEL CAP RESMI RT -->
                        <div
                            class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-xs space-y-4 transition hover:shadow-md">
                            <div class="flex items-center gap-2.5 border-b border-slate-100 pb-3">
                                <div
                                    class="w-8 h-8 rounded-lg bg-rose-50 border border-rose-100 text-rose-600 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-slate-800">Stempel Cap Resmi RT</h3>
                                    <p class="text-[11px] text-slate-500">Cap stempel pengesahan PDF</p>
                                </div>
                            </div>

                            <div class="p-3.5 bg-slate-50/70 rounded-xl border border-slate-200/70 space-y-2.5">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-14 h-12 rounded-lg border border-slate-200 bg-white flex items-center justify-center shrink-0 p-1 overflow-hidden shadow-2xs bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:8px_8px]">
                                        @if(!empty($settings['stempel_rt']) && file_exists(public_path($settings['stempel_rt'])))
                                            <img src="{{ asset($settings['stempel_rt']) }}" alt="Stempel RT"
                                                class="max-h-9 max-w-full object-contain filter drop-shadow-2xs">
                                        @else
                                            <span class="text-[9px] font-bold text-slate-400">Belum Ada</span>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <input type="file" name="stempel_rt" accept=".png,.jpg,.jpeg,.svg"
                                            class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2.5 file:rounded-lg file:border-0 file:text-[10px] file:font-semibold file:bg-rose-50 file:text-rose-700 hover:file:bg-rose-100 transition cursor-pointer">
                                    </div>
                                </div>
                                <p class="text-[10px] text-slate-400">PNG transparan disarankan (Maks 2MB)</p>
                            </div>
                        </div>

                        <!-- CARD ACTION: SIMPAN PERUBAHAN (DI BEWAH STEMPEL) -->
                        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs flex items-center justify-between gap-3 transition hover:shadow-md">
                            <span class="text-xs font-semibold text-slate-500">Pastikan data sudah sesuai.</span>
                            <button type="submit" form="form-settings-update"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-extrabold rounded-xl shadow-md transition shrink-0 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </form>

    <!-- Hidden form for reset settings -->
    <form id="form-reset-settings" action="{{ route('settings.reset') }}" method="POST" class="hidden">
        @csrf
    </form>
</x-app-layout>