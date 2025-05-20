<x-app-layout>
    @section('content')
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-semibold text-blue-800">Dashboard Admin</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card Jumlah Pengguna -->
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                        {{-- <p class="text-2xl font-bold text-green-800">{{ $totalPengguna }}</p> --}}
                    </div>
                    <div class="p-3 bg-green-100 text-green-800 rounded-full">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Card Jumlah Alumni -->
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Alumni</h3>
                        {{-- <p class="text-2xl font-bold text-blue-800">{{ $totalAlumni }}</p> --}}
                    </div>
                    <div class="p-3 bg-blue-100 text-blue-800 rounded-full">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Card Jumlah Dosen -->
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Dosen</h3>
                        {{-- <p class="text-2xl font-bold text-yellow-600">{{ $totalDosen }}</p> --}}
                    </div>
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
