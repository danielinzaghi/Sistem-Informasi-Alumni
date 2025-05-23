<x-app-layout>
    @section('content') @section('main_folder', 'Jurusan & Prodi')
    <div class="flex justify-between items-start flex-col sm:flex-row">
        <!-- Daftar Jurusan -->
        <div class="w-full sm:w-1/3 bg-white py-4 flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <span class="w-full text-md sm:text-2xl text-left font-bold">Daftar Jurusan</span>
                <button onclick="toggleModal('modalCreateJurusan')" class="px-4 text-sm py-1 bg-blue-600 text-white rounded">Tambah</button>
            </div>
            <div class="overflow-x-auto">
                <table class="text-sm text-left text-gray-500 border border-gray-300 shadow-md rounded-lg">
                    <thead class="text-[12px] sm:text-sm text-gray-700 bg-white">
                        <tr class="bg-gray-100">
                            <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                            <th class="px-2 text-center py-3 border">Nama Jurusan</th>
                            <th class="px-2 text-center py-3 border">Ketua Jurusan</th>
                            <th class="px-2 text-center py-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusan as $j)
                        <tr class="bg-white border-b cursor-pointer jurusan-row" data-id="{{ $j->id }}">
                            <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                            <td class="px-2 text-center py-4 border">{{ $j->nama_jurusan }}</td>
                            <td class="px-2 text-center py-4 border">{{ $j->kajur->user->name ?? '-' }}</td>
                            <td class="px-2 text-center py-4 flex justify-center items-center">
                                <button onclick="toggleModal('modalUpdate{{ $j->id }}')" data-id ="{{ $j->id }}" type="button" class="edit-user-btn text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                                    <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                    </svg>                                                    
                                    <span class="sr-only">Icon description</span>
                                </button>
                                <form action="{{ route('admin.jurusan.destroy', $j->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        data-confirm-delete="true"
                                        data-title="Hapus Jurusan?"
                                        data-text="Yakin ingin menghapus data {{ $j->nama_jurusan }}?"
                                        class="text-red-600 border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                                        <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form>
                                {{-- @endif --}}
                                @include('jurusan.update-modal')
                                @include('jurusan.create-modal')
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Daftar Program Studi -->
        <div class="w-full sm:w-2/3 bg-white p-4 flex flex-col gap-4">
            <div class="flex justify-between items-center">
                <span class="w-full text-md sm:text-2xl text-left font-bold">Daftar Program Studi</span>
                <button onclick="toggleModal('modalProdiCreate')" id="createProgramButton" class=" hidden px-4 py-1 text-sm bg-blue-600 text-white rounded">Tambah</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full sm:w-100 sm:min-w-full text-sm text-left text-gray-500 border border-gray-300 shadow-md rounded-lg">
                    <thead class="text-[12px] sm:text-sm text-gray-700 bg-white">
                        <tr class="bg-gray-100">
                            <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                            <th class="px-2 text-center py-3 border">Nama Program Studi</th>
                            <th class="px-2 text-center py-3 border">Kaprodi</th>
                            <th class="px-2 text-center py-3 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="programStudiTable">
                        <tr>
                            <td colspan="4" class="text-center py-4">Pilih jurusan terlebih dahulu</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @include('prodi.edit')
    @include('prodi.create')
    <script>
        $(document).ready(function() {

            $(".jurusan-row").click(function() {
                let jurusanId = $(this).data("id"); // Ambil ID jurusan yang diklik

                $.ajax({
                    url: "/get-program-studi/" + jurusanId, // URL endpoint untuk ambil data
                    type: "GET",
                    success: function(response) {
                        $('#createProgramButton').removeClass('hidden');
                        $('#jurusanId').val(jurusanId);
                        let programTable = $("#programStudiTable");
                        programTable.empty(); // Kosongkan tabel sebelum isi ulang

                        if (response.length === 0) {
                            programTable.append('<tr><td colspan="2" class="text-center py-4">Tidak ada program studi untuk jurusan ini</td></tr>');
                        } else {
                            $.each(response, function(index, program) {
                                programTable.append(`
                                    <tr class="bg-white border-b">
                                        <td class="px-2 text-center py-4 border">${index + 1}</td>
                                        <td class="px-2 text-center py-4 border">${program.nama_prodi}</td>
                                        <td class="px-2 text-center py-4 border">${program.kaprodi && program.kaprodi.user ? program.kaprodi.user.name : '-'}</td>
                                        <td class="px-2 text-center py-4 flex justify-center items-center">
                                            <button data-id ="${program.id}"
                                            <button data-name ="${program.nama_prodi}"
                                            data-kaprodi-id ="${program.kaprodi.id}"
                                            data-kaprodi-name ="${program.kaprodi.user ? program.kaprodi.user.name : '-'}"
                                            type="button" class="edit-prodi-btn text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                                                <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                    <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                                    <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                                                </svg>                                                    
                                                <span class="sr-only">Icon description</span>
                                            </button>
                                            <form action="/admin/prodi/${program.id}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    data-confirm-delete="true"
                                                    data-title="Hapus Jurusan?"
                                                    data-text="Yakin ingin menghapus data ${program.id}?"
                                                    class="text-red-600 border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                                                    <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                                    </svg>          
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                `);
                            });
                        }
                    },
                    error: function() {
                        alert("Gagal mengambil data program studi.");
                    }
                });
            });

            $(document).on('click', '.edit-prodi-btn', function() {
                let programId = $(this).data('id');
                console.log(programId);
                let programName = $(this).data('name');
                let kaprodiId = $(this).data('kaprodi-id');
                let kaprodiName = $(this).data('kaprodi-name');
                console.log('nama prodi : '+ programName);
                $('#selectedKaprodi').val(kaprodiId);
                $('#selectedKaprodi').text(kaprodiName);
                $('#selectedKaprodi').attr('selected', true);
                $('#edit_nama_prodi').val(programName);
                $('#programForm').attr('action', `/admin/prodi/${programId}`);

                $('#modalProdiUpdate').removeClass('hidden');
            })
        });
    </script>

    <script>
        function toggleModal(id) {
            document.getElementById(id).classList.toggle("hidden");
        }
    </script>
    @endsection
</x-app-layout>