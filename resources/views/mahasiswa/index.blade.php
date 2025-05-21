@extends('layouts.app')

@section('main_folder', 'Mahasiswa')

@section('content')
{{-- <div class="container mx-auto p-4"> --}}
    <div class="flex justify-between items-center">
        <h1 class="text-md sm:text-2xl font-bold text-gray-700">Data Mahasiswa</h1>
    </div>

    <div class="overflow-x-auto">
        <div class="overflow-x-auto">
            <table class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
                <thead class="bg-gray-50">
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
                            <button id="edit-btn" data-id="{{ $mahasiswa->id }}"
                            class="text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 inline-flex items-center me-2">
                                <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                            <form action="{{ route('admin.mahasiswa.destroy', $mahasiswa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                data-confirm-delete="true"
                                data-title="Hapus Mahasiswa?"
                                data-text="Yakin ingin menghapus data {{ $mahasiswa->user->name }}?"
                                class="text-red-600 border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 inline-flex items-center me-2">
                                    <svg class="w-4 sm:w-6 h-4 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>




        {{-- edit --}}
         <!-- Modal Edit -->
         <div id="editModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg mx-4">
                <h2 class="text-xl font-bold mb-4">Edit Mahasiswa</h2>
                <form id="mahasiswaForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama</label>
                        <input type="text" name="name" id="edit-name" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">NIM</label>
                        <input type="number" name="nim" id="edit-nim" class="w-full border px-3 py-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">No HP</label>
                        <input type="number" name="no_hp" id="edit-no_hp" class="w-full border px-3 py-2 rounded">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Angkatan</label>
                        <input type="number" name="angkatan" id="edit-angkatan" class="w-full border px-3 py-2 rounded">
                    </div>

                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditModal()" class="bg-gray-400 text-white px-4 py-2 rounded mr-2">Batal</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

    </div> <!-- Penutup .overflow-x-auto -->


        {{-- delete --}}
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
            $(document).ready(function() {
                function confirmDelete(url) {
                    document.getElementById('deleteForm').action = url;
                    document.getElementById('deleteModal').classList.remove('hidden');
                }

                function closeModal() {
                    document.getElementById('deleteModal').classList.add('hidden');
                }

                $(document).on('click', '#edit-btn', function() {
                    let mahasiswaId = $(this).data('id');

                    $('#mahasiswaForm').attr('action', `/admin/mahasiswa/${mahasiswaId}`);

                    if ($('#mahasiswaForm').find('input[name="_method"]').length === 0) {
                        $('#mahasiswaForm').append('<input type="hidden" name="_method" value="PUT">');
                    }
                })
            })
        </script>        


        <script>
            function closeEditModal() {
    $('#editModal').addClass('hidden');
}

$(document).on('click', '#edit-btn', function () {
    const mahasiswaId = $(this).data('id');

    // Ambil data via AJAX
    $.ajax({
        url: `/admin/mahasiswa/${mahasiswaId}/edit`,
        method: 'GET',
        success: function (response) {
            // Isi nilai ke dalam form
            $('#edit-name').val(response.user.name);
            $('#edit-nim').val(response.nim);
            $('#edit-no_hp').val(response.no_hp);
            $('#edit-angkatan').val(response.angkatan);

            // Set form action
            $('#mahasiswaForm').attr('action', `/admin/mahasiswa/${mahasiswaId}`);

            // Tampilkan modal
            $('#editModal').removeClass('hidden');
        }
    });
});
        </script>
    </div>
</div>
@endsection
