<x-app-layout>
    @section('content')
    @section('main_folder', 'Broadcast') @section('main_folder-link', route('admin.broadcast.index'))
    @section('sub_folder', 'Create')
    <div class="container mx-auto mt-4">
        <h2 class="text-2xl font-bold mb-4">Broadcast Message to Alumni</h2>
        
        <form action="{{ route('admin.broadcast.send') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="message" class="text-lg font-semibold">Masukkan Pesan:</label>
                <p class="text-sm text-gray-500 mt-1">*Tips: Tambahkan {nama} (contoh: Hallo Selamat Siang {nama})</p>
                <textarea class="form-control mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" id="message" name="message"></textarea>
            </div>

            <!-- Flex container for header and filters -->
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-semibold">Pilih Alumni untuk Dikirimi Pesan:</h4>
                <div class="flex items-center space-x-2">
                    <button id="sellectallAllbutton" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        Select All
                    </button>
                    <button id="deselectAllButton" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        Deselect All
                    </button>
                    <button id="statusDropdownButton" data-dropdown-toggle="statusDropdown" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter by Status
                    </button>
                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter by Tahun Lulus
                    </button>
                    <button id="prodiDropdownButton" data-dropdown-toggle="prodiDropdown" class="flex items-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                        </svg>
                        Filter by Prodi
                    </button>
                </div>
            </div>

            <!-- Dropdown for Filter by Status -->
            <div id="statusDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                <h6 class="mb-3 text-sm font-medium text-gray-900">Pilih Status</h6>
                <ul class="space-y-2 text-sm" aria-labelledby="statusDropdownButton">
                    <li class="flex items-center">
                        <input id="status_all" type="checkbox" value="status_all" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                        <label for="status_all" class="ml-2 text-sm font-medium text-gray-900">Semua</label>
                    </li>
                    @foreach ($alumnis as $alumni)
                        @if ($alumni->tracerStudy)
                            <li class="flex items-center">
                                <input id="status_{{ $alumni->tracerStudy->status_saat_ini }}" type="checkbox" value="{{ $alumni->tracerStudy->status_saat_ini }}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                                <label for="status_{{ $alumni->tracerStudy->status_saat_ini }}" class="ml-2 text-sm font-medium text-gray-900">{{ $alumni->tracerStudy->status_saat_ini ?? 'Tidak Diketahui' }}</label>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                <h6 class="mb-3 text-sm font-medium text-gray-900">Pilih Tahun Lulus</h6>
                <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                    <li class="flex items-center">
                        <input id="all_years" type="checkbox" value="all" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                        <label for="all_years" class="ml-2 text-sm font-medium text-gray-900">Semua</label>
                    </li>
                    @foreach ($alumnis as $alumni)
                        <li class="flex items-center">
                            <input id="year_{{ $alumni->tahun_lulus }}" type="checkbox" value="{{ $alumni->tahun_lulus }}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                            <label for="year_{{ $alumni->tahun_lulus }}" class="ml-2 text-sm font-medium text-gray-900">{{ $alumni->tahun_lulus }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Dropdown for Filter by Prodi -->
            <div id="prodiDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow">
                <h6 class="mb-3 text-sm font-medium text-gray-900">Pilih Prodi</h6>
                <ul class="space-y-2 text-sm" aria-labelledby="prodiDropdownButton">
                    <li class="flex items-center">
                        <input id="allProdi" type="checkbox" value="all" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                        <label for="allProdi" class="ml-2 text-sm font-medium text-gray-900">Semua</label>
                    </li>
                    @foreach ($alumnis as $alumni)
                        <li class="flex items-center">
                            <input id="prodi_{{ $alumni->mahasiswa->prodi }}" type="checkbox" value="{{ $alumni->mahasiswa->prodi }}" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 focus:ring-2" checked>
                            <label for="prodi_{{ $alumni->mahasiswa->prodi }}" class="ml-2 text-sm font-medium text-gray-900">{{ $alumni->mahasiswa->prodi->nama_prodi }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <table class="w-full sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
                <thead class="text-gray-700 bg-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Pilih</th>
                        <th class="border border-gray-300 px-4 py-2">Nama</th>
                        <th class="border border-gray-300 px-4 py-2">No HP</th>
                        <th class="border border-gray-300 px-4 py-2">NIM</th>
                        <th class="border border-gray-300 px-4 py-2">Angkatan/Tahun Lulus</th>
                        <th class="border border-gray-300 px-4 py-2">Prodi</th>
                        <th class="border border-gray-300 px-4 py-2">Status</th>
                        <th class="border border-gray-300 px-4 py-2">Pekerjaan</th>
                        <th class="border border-gray-300 px-4 py-2">Instansi</th>
                        <th class="border border-gray-300 px-4 py-2">Status Saat Ini</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnis as $alumni)
                        @if ($alumni->mahasiswa)
                            <tr class="hover:bg-gray-100 alumni-row" data-status="{{ $alumni->tracerStudy->status_saat_ini ?? 'Tidak Diketahui' }}" data-year="{{ $alumni->mahasiswa->angkatan }}" data-prodi="{{ $alumni->mahasiswa->prodi }}">
                                <td class="border border-gray-300 px-4 py-2">
                                    <input type="checkbox" name="targets[]" value="{{ $alumni->id }}|{{ $alumni->mahasiswa->no_hp }}|{{ $alumni->mahasiswa->nama }}" class="individual-checkbox">
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->no_hp }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->nim }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->angkatan }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->prodi->nama_prodi }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->mahasiswa->status }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->pekerjaan ?? '-' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->instansi ?? '-' }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $alumni->tracerStudy->status_saat_ini ?? 'Tidak Diketahui' }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Kirim Pesan</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle the dropdown change for select/deselect all

            document.getElementById('sellectallAllbutton').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.individual-checkbox');
                // Toggle the checked state of all checkboxes
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
                filterAlumni();
            });

            document.getElementById('deselectAllButton').addEventListener('click', function() {
                const checkboxes = document.querySelectorAll('.individual-checkbox');
                checkboxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
                filterAlumni();
            });

            // Add event listeners for filter checkboxes
            const filterCheckboxes = document.querySelectorAll('#statusDropdown input[type="checkbox"], #filterDropdown input[type="checkbox"], #prodiDropdown input[type="checkbox"]');
            filterCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', filterAlumni);
            });

            function filterAlumni() {
                // Get selected statuses, years, and prodis
                const selectedStatuses = Array.from(document.querySelectorAll('#statusDropdown input[type="checkbox"]:checked')).map(cb => cb.value);
                const selectedYears = Array.from(document.querySelectorAll('#filterDropdown input[type="checkbox"]:checked')).map(cb => cb.value);
                const selectedProdis = Array.from(document.querySelectorAll('#prodiDropdown input[type="checkbox"]:checked')).map(cb => cb.value);

                const alumniRows = document.querySelectorAll('.alumni-row');

                alumniRows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    const year = row.getAttribute('data-year');
                    const prodi = row.getAttribute('data-prodi');

                    // Check if the row matches the selected filters
                    const statusMatch = selectedStatuses.length === 0 || selectedStatuses.includes(status) || selectedStatuses.includes('status_all');
                    const yearMatch = selectedYears.length === 0 || selectedYears.includes(year) || selectedYears.includes('all');
                    const prodiMatch = selectedProdis.length === 0 || selectedProdis.includes(prodi) || selectedProdis.includes('allProdi');

                    // Show or hide the row based on the filter matches
                    if (statusMatch && yearMatch && prodiMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
    @endsection
</x-app-layout>