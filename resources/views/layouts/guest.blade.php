<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex flex-col lg:flex-row lg:min-h-screen">

    <!-- Bagian Informasi -->
    <div
        class="flex flex-col items-center justify-center p-4 w-full lg:w-[70%] text-white border-gray-500 bg-[#047857] lg:border-l-[16px] hidden lg:flex">
        <div class="flex flex-col text-center lg:text-left">
            <div class="flex items-center">
                <span class="self-center text-3xl font-bold text-white whitespace-nowrap">E-ALUMNI</span>
            </div>
            <div class="mt-6 text-lg lg:text-2xl font-regular">
                <p>
                    Terkoneksi, Berkarya, dan Berkontribusi <br>
                    e-Alumni untuk Masa Depan yang Lebih Cerah
                </p>
            </div>
        </div>
    </div>

    <!-- Bagian Login -->
    <div class="flex flex-col items-center justify-center min-h-screen w-full lg:w-[30%] px-6 py-8 lg:py-0">
        <div class="max-w-md w-full">
            <div class="text-center mb-6">
                <span class="self-center text-3xl font-bold text-[#047857] whitespace-nowrap">E-ALUMNI</span>
                <p class="text-md text-[#047857]">Jembatan Koneksi Alumni</p>
                <hr class="border-gray-300 my-2 mx-24">
            </div>
            {{ $slot }}
        </div>
    </div>

</body>

</html>
