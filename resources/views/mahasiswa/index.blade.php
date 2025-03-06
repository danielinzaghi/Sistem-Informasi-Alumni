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
        <table class="table-auto w-full border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">No</th>
                    <th class="px-4 py-2 text-left">Nama</th>
                    <th class="px-4 py-2 text-left">Program Studi</th>
                    <th class="px-4 py-2 text-left">NIM</th>
                    <th class="px-4 py-2 text-left">No HP</th>
                    <th class="px-4 py-2 text-left">Angkatan</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->user->name}}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->prodi->nama_prodi}}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->nim}}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->no_hp}}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->angkatan}}</td>
                    <td class="px-4 py-2">{{ $mahasiswa->status }}</td>
                    <td class="px-4 py-2 flex items-center gap-2">
                        @if(auth()->user()->alumni_id === $mahasiswa->alumni_id)
                            <a href="{{ route('admin.mahasiswa.edit', $mahasiswa->id) }}" class="text-blue-600 hover:text-blue-800">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <button type="button" onclick="confirmDelete('{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}')" 
                                class="text-red-600 hover:text-red-800">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        @endif
                        <a href="{{ route('admin.mahasiswa.show', $mahasiswa->id) }}" class="text-green-600 hover:text-green-800">
                            <i class="fa-solid fa-eye"></i> Lihat
                        </a>
                        @if($mahasiswa->status == 'lulus' && !$mahasiswa->alumni)
                            <a href="{{ route('admin.alumni.create', ['mahasiswaId' => $mahasiswa->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">
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
