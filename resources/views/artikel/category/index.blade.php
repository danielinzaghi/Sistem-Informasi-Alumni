<x-app-layout>
    @section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Data Kategori Artikel
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">

                <!-- Header & Button -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-semibold">Data Kategori Artikel</h3>
                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow" onclick="toggleModal('modalCreate')">
                        Tambah Data
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto bg-white shadow rounded">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="p-4 border">No</th>
                                <th class="p-4 border">Nama</th>
                                <th class="p-4 border">Slug</th>
                                <th class="p-4 border">Created At</th>
                                <th class="p-4 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 border">{{ $loop->iteration }}</td>
                                    <td class="p-4 border">{{ $item->nama }}</td>
                                    <td class="p-4 border">{{ $item->slug }}</td>
                                    <td class="p-4 border">{{ $item->created_at }}</td>
                                    <td class="p-4 border relative">
                                        <div x-data="{ open: false }" class="relative">
                                            <!-- Tombol Actions -->
                                            <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                                                Actions ▼
                                            </button>
                                    
                                            <!-- Dropdown Menu -->
                                            <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-32 bg-white border rounded shadow-md z-10">
                                                <button class="block w-full text-left px-4 py-2 text-blue-500 hover:bg-yellow-200" 
                                                    onclick="toggleModal('modalUpdate{{ $item->id }}')">
                                                    Edit
                                                </button>
                                                <button class="block w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100" 
                                                    onclick="toggleModal('modalDelete{{ $item->id }}')">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    
                                </tr>
                                @include('artikel.category.update-modal')
                                @include('artikel.category.delete-modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal Create tetap satu kali -->
                @include('artikel.category.create-modal')
            </div>
        </div>
    </div>

    <!-- Modal Function -->
    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle("hidden");
        }
    </script>

    @endsection
</x-app-layout>