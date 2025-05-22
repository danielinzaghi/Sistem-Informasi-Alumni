<x-app-layout>
    @section('content')
    @section('main_folder', 'Category')
    <x-slot name="header">
        <h2 class="font-semibold text-md sm:text-xl text-gray-800 leading-tight">
            Data Kategori Artikel
        </h2>
    </x-slot>

    {{-- <div class="py-12 px-6"> --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
            <div class="p-6 text-gray-900">

                <!-- Header & Button -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-md sm:text-2xl font-semibold">Data Kategori Artikel</h3>
                    <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs sm:text-sm px-3 sm:px-5 py-1.5 sm:py-2.5 me-2 focus:outline-none" onclick="toggleModal('modalCreate')">
                        Tambah
                    </button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto bg-white shadow rounded">
                    <table class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 text-center py-4 border">No</th>
                                <th class="px-2 text-center py-4 border">Nama</th>
                                <th class="px-2 text-center py-4 border">Slug</th>
                                <th class="px-2 text-center py-4 border">Created At</th>
                                <th class="px-2 text-center py-4 border">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $item)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                                    <td class="px-2 text-center py-4 border">{{ $item->nama }}</td>
                                    <td class="px-2 text-center py-4 border">{{ $item->slug }}</td>
                                    <td class="px-2 text-center py-4 border">{{ $item->created_at }}</td>
                                    <td class="px-2 text-center py-4 flex justify-center items-center gap-2">
                                        <button onclick="toggleModal('modalUpdate{{ $item->id }}')" class="inline-flex items-center px-2 sm:px-3 py-1 bg-blue-500 text-white text-xs sm:text-sm font-medium rounded hover:bg-blue-600 transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.CategoryDelete', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                data-confirm-delete="true"
                                                data-title="Hapus Kategori?"
                                                data-text="Yakin ingin menghapus data {{ $item->nama }}?"
                                                class="inline-flex items-center px-2 sm:px-3 py-1 bg-red-500 text-white text-xs sm:text-sm font-medium rounded hover:bg-red-600 transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @include('artikel.category.update-modal')
                                @include('artikel.category.delete-modal')
                            @empty
                                <tr class="hover:bg-gray-50">
                                    <td class="p-4 border text-center" colspan="5">Tidak ada kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Modal Create tetap satu kali -->
                @include('artikel.category.create-modal')
            </div>
        </div>
    {{-- </div> --}}

    <!-- Modal Function -->
    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle("hidden");
        }
    </script>

    @endsection
</x-app-layout>