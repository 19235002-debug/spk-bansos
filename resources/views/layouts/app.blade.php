<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ setting('app_name', 'SPK Bansos RT/RW') }} - {{ setting('institution_name', 'Pengurus RT/RW Bansos') }}</title>
        @if(setting('favicon') && file_exists(public_path(setting('favicon'))))
            <link rel="icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- SweetAlert2 CDN -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased h-full text-slate-800" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex bg-slate-100">

            <!-- Desktop Sidebar Navigation (TailwindAdmin Theme) -->
            <div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0 z-50">
                @include('layouts.sidebar')
            </div>

            <!-- Mobile Off-canvas Overlay Drawer -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-slate-900/80 backdrop-blur-xs z-50 md:hidden"
                 @click="sidebarOpen = false"
                 style="display: none;"></div>

            <!-- Mobile Sidebar Panel -->
            <div x-show="sidebarOpen"
                 x-transition:enter="transition ease-in-out duration-300 transform"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in-out duration-300 transform"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="fixed inset-y-0 left-0 w-64 bg-slate-900 z-50 md:hidden flex flex-col shadow-2xl"
                 style="display: none;">
                @include('layouts.sidebar')
            </div>

            <!-- Main Content Container -->
            <div class="md:pl-64 flex flex-col flex-1 min-w-0">
                <!-- Top Navbar -->
                @include('layouts.navigation')

                <!-- Optional Page Header -->
                @isset($header)
                    <header class="bg-white border-b border-slate-200 py-4 px-6 sm:px-8 shadow-2xs">
                        <div class="max-w-7xl mx-auto">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Main Content -->
                <main class="flex-1 py-6 px-4 sm:px-6 lg:px-8 max-w-7xl w-full mx-auto">
                    <!-- Flash Notification Banners (Success, Error, Warning) -->
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-transition 
                             class="mb-6 p-4 sm:p-5 rounded-2xl bg-emerald-50 border-2 border-emerald-300 text-emerald-950 shadow-sm flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-sm sm:text-base text-emerald-950">Berhasil Disimpan!</h4>
                                    <p class="text-xs sm:text-sm text-emerald-900 mt-0.5 leading-relaxed">{{ session('success') }}</p>
                                </div>
                            </div>
                            <button @click="show = false" type="button" class="text-emerald-700 hover:text-emerald-950 p-1.5 rounded-lg hover:bg-emerald-100 transition shrink-0" title="Tutup">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-transition 
                             class="mb-6 p-4 sm:p-5 rounded-2xl bg-rose-50 border-2 border-rose-300 text-rose-950 shadow-sm flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-sm sm:text-base text-rose-950">Perhatian / Gagal!</h4>
                                    <p class="text-xs sm:text-sm text-rose-900 mt-0.5 leading-relaxed">{{ session('error') }}</p>
                                </div>
                            </div>
                            <button @click="show = false" type="button" class="text-rose-700 hover:text-rose-950 p-1.5 rounded-lg hover:bg-rose-100 transition shrink-0" title="Tutup">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div x-data="{ show: true }" x-show="show" x-transition 
                             class="mb-6 p-4 sm:p-5 rounded-2xl bg-amber-50 border-2 border-amber-300 text-amber-950 shadow-sm flex items-start justify-between gap-3">
                            <div class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-black text-sm sm:text-base text-amber-950">Pemberitahuan Sistem</h4>
                                    <p class="text-xs sm:text-sm text-amber-900 mt-0.5 leading-relaxed">{{ session('warning') }}</p>
                                </div>
                            </div>
                            <button @click="show = false" type="button" class="text-amber-700 hover:text-amber-950 p-1.5 rounded-lg hover:bg-amber-100 transition shrink-0" title="Tutup">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif

                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-500">
                    {{ str_replace('{year}', date('Y'), setting('footer_text', '© ' . date('Y') . ' ' . setting('app_name', 'SPK Bansos RT') . '. Hak Cipta Dilindungi Undang-Undang.')) }}
                </footer>
            </div>
        </div>

        <!-- SweetAlert2 Scripts & Global Notifications -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                if (typeof Swal !== 'undefined') {
                    @if(session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil Disimpan!',
                            text: "{{ session('success') }}",
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'Selesai &rarr;',
                            customClass: {
                                popup: 'rounded-3xl font-sans p-6 shadow-2xl'
                            }
                        });
                    @endif

                    @if(session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: 'Perhatian',
                            text: "{{ session('error') }}",
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'Tutup',
                            customClass: {
                                popup: 'rounded-3xl font-sans p-6 shadow-2xl'
                            }
                        });
                    @endif

                    @if(session('warning'))
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan Sistem',
                            text: "{{ session('warning') }}",
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'Tutup',
                            customClass: {
                                popup: 'rounded-3xl font-sans p-6 shadow-2xl'
                            }
                        });
                    @endif

                    @if($errors->any())
                        let errorMessages = '<ul class="text-left text-xs space-y-1 mt-2 text-rose-600 font-medium">';
                        @foreach($errors->all() as $error)
                            errorMessages += '<li>&bull; {{ $error }}</li>';
                        @endforeach
                        errorMessages += '</ul>';

                        Swal.fire({
                            icon: 'error',
                            title: 'Validasi Gagal',
                            html: 'Silakan periksa kembali inputan Anda:' + errorMessages,
                            confirmButtonColor: '#4f46e5',
                            customClass: {
                                popup: 'rounded-3xl font-sans p-6 shadow-2xl'
                            }
                        });
                    @endif
                }
            });

            // Global SweetAlert2 Confirm Delete Helper
            function confirmDelete(event, formElement, titleText = "Apakah Anda Yakin?", bodyText = "Data yang dihapus tidak dapat dikembalikan!") {
                event.preventDefault();
                Swal.fire({
                    title: titleText,
                    text: bodyText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e11d48',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Hapus Data',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl font-sans'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        formElement.submit();
                    }
                });
            }

            // Global SweetAlert2 Confirm Action Helper
            function confirmAction(event, formElement, titleText = "Konfirmasi Tindakan", bodyText = "Apakah Anda yakin ingin melanjutkan?") {
                event.preventDefault();
                Swal.fire({
                    title: titleText,
                    text: bodyText,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#4f46e5',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: 'Ya, Lanjutkan',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-2xl font-sans'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        formElement.submit();
                    }
                });
            }
        </script>
    </body>
</html>
