<x-app-layout>
    @section('content')
    @if (session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Alert for failure message -->
    @if (session('error'))
        <div id="error-message" class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="container mx-auto mt-4">
        <h1 class="text-2xl font-bold mb-4">Fonnte API Information</h1>
        @if ($deviceInfo)
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <strong>Device:</strong> {{ $deviceInfo['device'] }}
                    </div>
                    <div>
                        <strong>Device Status:</strong> {{ $deviceInfo['device_status'] }}
                    </div>
                    <div>
                        <strong>Expired:</strong> {{ $deviceInfo['expired'] }}
                    </div>
                    <div>
                        <strong>Messages:</strong> {{ $deviceInfo['messages'] }}
                    </div>
                    <div>
                        <strong>Name:</strong> {{ $deviceInfo['name'] }}
                    </div>
                    <div>
                        <strong>Package:</strong> {{ $deviceInfo['package'] }}
                    </div>
                    <div>
                        <strong>Quota:</strong> {{ $deviceInfo['quota'] }}
                    </div>
                    <div>
                        <strong>Status:</strong> {{ $deviceInfo['status'] ? 'Active' : 'Inactive' }}
                    </div>
                </div>
            </div>
        @else
            <p class="text-red-500">Failed to retrieve device information.</p>
        @endif
    </div>

    <div class="container mx-auto mt-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Broadcast History</h1>
            <a href="{{ route('admin.broadcast.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Tambah Broadcast
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <table class="w-full sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
                <thead class="text-gray-700 bg-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Id</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Mahasiswa</th>
                        <th class="border border-gray-300 px-4 py-2">Target</th>
                        <th class="border border-gray-300 px-4 py-2">Message</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($broadcasts as $broadcast)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $broadcast->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $broadcast->alumni->mahasiswa->nama ?? 'N/A' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $broadcast->target }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $broadcast->message }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $broadcast->detail }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (session('success'))
        <script>
            // Hide the success message after 3 seconds
            setTimeout(function() {
                var message = document.getElementById('success-message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif

    @if (session('error'))
        <script>
            // Hide the error message after 3 seconds
            setTimeout(function() {
                var message = document.getElementById('error-message');
                if (message) {
                    message.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif
    @endsection
</x-app-layout>

