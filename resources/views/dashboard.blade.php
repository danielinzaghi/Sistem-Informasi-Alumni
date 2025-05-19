<x-app-layout>
    @section('content')
        @role('admin')
        <div class="container mx-auto p-6">
            <h2 class="text-2xl font-semibold text-blue-800">Dashboard Admin</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card Jumlah Pengguna -->
                <div class="bg-white shadow-lg rounded-xl p-6 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Pengguna</h3>
                        <p class="text-2xl font-bold text-green-800">{{ $userCount }}</p>
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
                        <p class="text-2xl font-bold text-blue-800">{{ $alumniCount }}</p>
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
                        <p class="text-2xl font-bold text-yellow-600">{{ $dosenCount }}</p>
                    </div>
                    <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a5 5 0 100 10 5 5 0 000-10zM2 18a8 8 0 0116 0H2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
            <!-- Grafik Statistik Pekerjaan -->
            <div class="mt-8 {{-- bg-white shadow-lg rounded-xl --}} p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4">Status Pekerjaan Alumni</h3>
                <canvas id="jobStatisticsChart"></canvas>
            </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('jobStatisticsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Bekerja', 'Belum Bekerja', 'Wiraswasta'],
                datasets: [{
                    label: 'Jumlah',
                    data: [{{ '40' }}, {{ '20' }}, {{ '2' }}],
                    backgroundColor: ['#10B981', '#EF4444', '#3B82F6'],
                    borderColor: ['#047857', '#B91C1C', '#1E40AF'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
        @endrole
    @endsection
</x-app-layout>