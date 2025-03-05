<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Data Kategori Artikel
        </h2>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 min-h-screen bg-gray-200 dark:bg-gray-900 p-4">
            <ul>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Dashboard</a></li>
                <li class="mb-2"><a href="{{ route('admin.CategoryIndex') }}" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Kategori</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Artikel</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Tracer Studi</a></li>
                <li class="mb-2"><a href="#" class="block p-2 text-gray-800 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-700 rounded">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 py-12 px-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
        <td class="p-4 border">
            <button class="text-blue-500 hover:underline" onclick="toggleModal('modalUpdate{{ $item->id }}')">Edit</button>
            <button class="text-red-500 hover:underline ml-4" onclick="toggleModal('modalDelete{{ $item->id }}')">Delete</button>
        </td>
    </tr>

    
    @include('artikel.category.update-modal')
    @include('artikel.category.delete-modal')
@endforeach

<!-- Modal Create tetap satu kali -->
@include('artikel.category.create-modal')
 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Function -->
    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle("hidden");
        }
    </script>

</x-app-layout>
