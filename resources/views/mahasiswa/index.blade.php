@extends('layouts.app')

@section('title', 'Mahasiswa')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-700">Data Mahasiswa</h1>
        @if(session('success'))
                <div id="alert-border-3" class="flex items-center p-4 mb-4 text-green-800 border-t-4 border-green-300 bg-green-50 dark:text-green-400 dark:bg-gray-800 dark:border-green-800" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        Data mahasiswa telah berhasil dibuat.
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-3" aria-label="Close">
                    <span class="sr-only">Dismiss</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    </button>
                </div>
            @endif
            @if(session('success-edit'))
                <div id="alert-border-4" class="flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 dark:text-yellow-400 dark:bg-gray-800 dark:border-yellow-800" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('success-edit') }}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-yellow-50 text-yellow-500 rounded-lg focus:ring-2 focus:ring-yellow-400 p-1.5 hover:bg-yellow-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"  data-dismiss-target="#alert-border-4" aria-label="Close">
                        <span class="sr-only">Dismiss</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
        <a href="{{ route('admin.mahasiswa.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Tambah Data
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
            <thead class="text-gray-700 bg-white">
                <tr>
                    <th class="px-2 text-center py-3 border">NO</th>
                    <th class="px-2 text-center py-3 border">Nama</th>
                    <th class="px-2 text-center py-3 border">Program Studi</th>
                    <th class="px-2 text-center py-3 border">NIM</th>
                    <th class="px-2 text-center py-3 border">No HP</th>
                    <th class="px-2 text-center py-3 border">Angkatan</th>
                    <th class="px-2 text-center py-3 border">Status</th>
                    <th class="px-2 text-center py-3 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr class="bg-white border-b hover:bg-gray-50" style="cursor: pointer;">
                    <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->user->name }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->prodi->nama_prodi ?? '' }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->nim }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->no_hp }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->angkatan }}</td>
                    <td class="px-2 text-center py-4 border">{{ $mahasiswa->status }}</td>
                    <td class="px-2 text-center py-4 flex justify-center items-center gap-1">
                        @if(auth()->user()->alumni_id === $mahasiswa->alumni_id)
                        <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" 
                        class="text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 inline-flex items-center me-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 inline-flex items-center me-2">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('admin.mahasiswa.show', $mahasiswa->id) }}" class="text-green-600 border border-green-600 hover:bg-green-600 hover:text-white font-medium rounded-md text-sm p-2 inline-flex items-center me-2">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 4.5c-5.523 0-10 5.25-10 7.5s4.477 7.5 10 7.5 10-5.25 10-7.5-4.477-7.5-10-7.5ZM12 6a6 6 0 1 1 0 12 6 6 0 0 1 0-12Zm0 3a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" clip-rule="evenodd"/>
                            </svg>
                        </a>
                        @if($mahasiswa->status == 'lulus' && !$mahasiswa->alumni)
                            <a href="{{ route('admin.alumni.create', ['mahasiswaId' => $mahasiswa->id]) }}" class="bg-yellow-500 text-white px-2 py-2 rounded-md text-xs font-semibold">
                                Jadikan Alumni
                            </a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>



        <div id="deleteModal" tabindex="-1" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-1/3">
                <div class="p-5">
                    <h3 class="text-lg font-semibold text-gray-900">Apakah yakin ingin menghapus data ini?</h3>
                    <div class="mt-4 flex justify-end">
                        <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Batal</button>
                        <form id="deleteForm" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function confirmDelete(url) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        </script>        
    </div>
</div>
@endsection
