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
    <div class="flex justify-between items-center mb-4 mt-4">
        <h1 class="text-2xl font-bold">Broadcast History</h1>
        <a href="{{ route('admin.broadcast.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Tambah Broadcast
        </a>
    </div>
        {{-- <a href="{{ route('broadcast.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"> --}}

        <table class="min-w-full border border-gray-300 mt-4" id="alumniTable">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Id</th>
                    <th class="border border-gray-300 px-4 py-2">Nama Mahasiswa</th> <!-- Menambahkan kolom untuk nama mahasiswa -->
                    <th class="border border-gray-300 px-4 py-2">Target</th>
                    <th class="border border-gray-300 px-4 py-2">Message</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($broadcasts as $broadcast)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $broadcast->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $broadcast->alumni->mahasiswa->nama ?? 'N/A' }}</td> <!-- Menampilkan nama mahasiswa -->
                        <td class="border border-gray-300 px-4 py-2">{{ $broadcast->target }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $broadcast->message }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $broadcast->detail }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if (session('success'))
            <script>
                // Hide the success message after 3 seconds
                setTimeout(function() {
                    var message = document.getElementById('success-message');
                    if (message) {
                        message.style.display = 'none';
                    }
                }, 3000); // 3000 milliseconds = 3 seconds
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
                }, 3000); // 3000 milliseconds = 3 seconds
            </script>
        @endif
    @endsection
</x-app-layout>