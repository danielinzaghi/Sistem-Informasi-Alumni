<x-app-layout>
    @section('content') @role(['admin', 'dosen'])
    <div class="container mx-auto p-6">
        <h2 class="text-md sm:text-2xl font-semibold text-blue-800">Dashboard Admin</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-md sm:text-xl">
            <!-- Card Jumlah Pengguna -->
            <div
                class="bg-white shadow-lg rounded-xl p-4 sm:p-6 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-700">Total Pengguna</h3>
                    <p class="text-xl sm:text-2xl font-bold text-green-800">{{ $userCount }}</p>
                </div>
                <div class="p-3 bg-green-100 text-green-800 rounded-full">
                    <svg class="w-4 sm:w-8 h-4 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                            clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Card Jumlah Alumni -->
            <div
                class="bg-white shadow-lg rounded-xl p-4 sm:p-6 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-700">Total Alumni</h3>
                    <p class="text-xl sm:text-2xl font-bold text-blue-800">{{ $alumniCount }}</p>
                </div>
                <div class="p-3 bg-blue-100 text-blue-800 rounded-full">
                    <svg class="w-4 sm:w-8 h-4 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                            clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>

            <!-- Card Jumlah Dosen -->
            <div
                class="bg-white shadow-lg rounded-xl p-4 sm:p-6 flex items-center justify-between">
                <div>
                    <h3 class="font-semibold text-gray-700">Total Dosen</h3>
                    <p class="text-xl sm:text-2xl font-bold text-yellow-600">{{ $dosenCount }}</p>
                </div>
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                    <svg class="w-4 sm:w-8 h-4 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            fill-rule="evenodd"
                            d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                            clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Grafik Statistik Pekerjaan -->
        <div class="mt-8 overflow-x-auto">
            <h3 class="text-md sm:text-xl font-semibold text-gray-700 mb-4">Status Pekerjaan Alumni</h3>
            <canvas id="jobStatisticsChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document
            .getElementById('jobStatisticsChart')
            .getContext('2d');

        const maxValue = Math.max({{ $alumniSudahBekerjaCount }}, {{ $alumniBelumBekerjaCount }}, {{ $alumniWiraswastaCount }}, {{ $alumniMelanjutkanPendidikanCount }}, {{ $alumniMencariKerjaCount }});
        const yMax = maxValue < 5 ? 5 : Math.ceil(maxValue + maxValue * 0.2); // atur minimal tinggi
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Bekerja', 'Belum Bekerja', 'Wiraswasta', 'Melanjutkan Pendidikan', 'Mencari Kerja'
                ],
                datasets: [
                    {
                        label: 'Jumlah',
                        data: [
                            {{ $alumniSudahBekerjaCount }}, {{ $alumniBelumBekerjaCount }}, {{ $alumniWiraswastaCount }}, {{ $alumniMelanjutkanPendidikanCount }}, {{ $alumniMencariKerjaCount }}
                        ],
                        backgroundColor: [
                            '#10B981', '#EF4444', '#F59E0B', '#3B82F6', '#8B5CF6'
                        ],
                        borderColor: [
                            '#047857', '#B91C1C', '#B45309', '#1E40AF', '#6D28D9'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        // ticks: {
                        //     precision: 0
                        // }
                        max : maxValue + 3
                    }
                }
            }
        });
    </script>
    @endrole 
    @endsection
</x-app-layout>