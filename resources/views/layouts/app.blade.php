<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"/>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Select2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

        <!-- jQuery (Wajib, sebelum DataTables) -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <!-- DataTables CSS -->
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
        <!-- Tambahkan Bootstrap & Date Range Picker -->
        <!-- jQuery harus dipanggil dulu -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.1/daterangepicker.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script
            src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.3/flowbite.min.js"></script>
    </head>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <body class="font-sans antialiased">

        <div class="flex flex-col">
            <!-- Page Content -->
            @include('layouts.navigation') @include('layouts.sidebar')
            <main class="p-2 sm:ml-40">
                <div class="p-4 mt-12">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center w-full gap-2 sm:gap-4">
                    {{-- Breadcrumb --}}
                    @if (!Route::is('profile.edit'))
                        <nav class="flex-1" aria-label="Breadcrumb">
                            <ol class="flex flex-wrap items-center gap-2 md:gap-3 text-xs sm:text-sm md:text-md">
                                <li class="flex items-center">
                                    <a href="{{ route(Auth::user()->roles->first()->name . '.dashboard') }}"
                                    class="font-regular text-gray-700 hover:text-blue-600">
                                        Dashboard
                                    </a>
                                </li>
                                <li class="text-gray-400">/</li>
                                @if (View::hasSection('main_folder'))
                                    <li class="flex items-center">
                                        <a href="@yield('main_folder-link')" class="font-regular text-gray-700 hover:text-blue-600">
                                            @yield('main_folder')
                                        </a>
                                    </li>
                                @endif
                                @if (View::hasSection('sub_folder'))
                                    <li class="text-gray-400">/</li>
                                    <li aria-current="page">
                                        <span class="font-regular text-gray-500">@yield('sub_folder')</span>
                                    </li>
                                @endif
                            </ol>
                        </nav>

                        {{-- Tanggal --}}
                        <div class="text-right text-[10px] sm:text-[12px] text-gray-700 whitespace-nowrap">
                            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                        </div>
                    @endif
                </div>

                    <!-- Container Biru di Belakang -->
                    <div class="mt-4">
                        <!-- Container Putih di Depan -->
                        <div class="bg-white shadow-lg rounded-lg border-t-4 p-4 border-[#1e40af]">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
        {{-- <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script> --}}
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable({
                    "responsive": true, // Aktifkan fitur responsif
                    "autoWidth": false, // Hindari lebar otomatis agar lebih fleksibel
                    "language": {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Indonesian.json"
                    },
                    "paging": true,
                    "searching": true,
                    "info": true,
                    "lengthMenu": [
                        5, 10, 25, 50, 100
                    ],
                    "pageLength": 5,
                    "ordering": false
                });
            });

            function openModal(modalId) {
                const modal = $("#" + modalId);
                modal.removeClass('hidden');
                modal.find('.modal-content').scrollTop(0);
            }

            // Fungsi untuk menutup modal berdasarkan ID modal yang dikirim
            function closeModal(modalId) {
                $("#" + modalId).addClass("hidden");

                // Tutup modal
                // modal.addClass("hidden");

                // Reset semua input, select, textarea di dalam modal
                // modal.find('input, select, textarea').each(function () {
                //     var type = $(this).attr('type');

                //     if (type === 'checkbox' || type === 'radio') {
                //         $(this).prop('checked', false);
                //     } else if (type === 'file') {
                //         $(this).val(''); // Untuk file input
                //     } else {
                //         $(this).val(''); // Untuk text, email, number, etc
                //     }
                // });

                // // Reset semua elemen dengan class .modal-title (kalau kamu pakai title modal)
                // modal.find('.modalTitle').text('');

                // Kalau mau sekalian bersihkan validation error, bisa tambahkan ini:
                // modal.find('.error-message').text('');
            }
        </script>
        @include('sweetalert::alert')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.addEventListener('click', function (e) {
                    // Cek apakah yang diklik adalah tombol dengan atribut [data-confirm-delete]
                    if (e.target.closest('button[data-confirm-delete]')) {
                        e.preventDefault();

                        const button = e.target.closest('button[data-confirm-delete]');
                        const form = button.closest('form');
                        const title = button.getAttribute('data-title') || 'Yakin ingin menghapus?';
                        const text = button.getAttribute('data-text') || 'Data akan dihapus secara permanen.';

                        Swal.fire({
                            title: title,
                            text: text,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>