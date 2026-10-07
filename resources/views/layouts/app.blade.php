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
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                @if(session('success'))
                    Toast.fire({
                        icon: 'success',
                        title: "{{ session('success') }}"
                    });
                @endif

                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: "{{ session('error') }}",
                        confirmButtonColor: '#4f46e5'
                    });
                @endif

                @if(session('warning'))
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan Sistem',
                        text: "{{ session('warning') }}",
                        confirmButtonColor: '#4f46e5'
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
                        confirmButtonColor: '#4f46e5'
                    });
                @endif
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
