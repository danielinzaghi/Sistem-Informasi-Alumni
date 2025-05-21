<x-app-layout>
    @section('content') @section('main_folder', 'Dosen')
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-md sm:text-2xl mb-4">Data Dosen</h1>
    </div>
    <div class="overflow-x-auto">
        <table
            class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                    <th class="px-2 text-center py-3 border w-[20%]">Nama</th>
                    <th class="px-2 text-center py-3 border w-[20%]">NIDN</th>
                    <th class="px-2 text-center py-3 border w-[20%]">Email</th>
                    {{-- <th class="px-2 text-center py-3 border w-[20%]">Role</th> --}}
                    <th class="px-2 text-center py-3 border w-[20%]">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosen as $data)
                <tr class="bg-white border-b" style="cursor: pointer;">
                    <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                    <td class="px-2 text-center py-4 border">{{ $data->user->name }}</td>
                    <td class="px-2 text-center py-4 border">{{ $data->nidn }}</td>
                    <td class="px-2 text-center py-4 border">{{ $data->user->email }}</td>
                    {{-- <td class="px-2 text-center py-4 border">{{ $data->user->roles->first()->name }}</td> --}}
                    <td class="px-2 text-center py-4 flex justify-center items-center">
                        <button
                                data-id ="{{ $data->id }}"
                                data-name = "{{ $data->user->name }}"
                                data-email = "{{ $data->user->email }}"
                                data-nidn = "{{ $data->nidn }}"
                                data-modal-target="editModal"
                                data-modal-toggle="editModal"
                            type="button" class="btn-edit text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                            <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                            </svg>                                                    
                            {{-- <span class="sr-only">Icon description</span> --}}
                        </button>
                        <form action="{{ route('admin.dosen.destroy', $data->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                            data-confirm-delete="true"
                            data-title="Hapus Dosen?"
                            data-text="Yakin ingin menghapus data {{ $data->user->name }}?"
                            class="text-red-600 border border-red-600 hover:bg-red-600 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                                <svg class="w-4 sm:w-6 h-4 sm:h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                                </svg>          
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('dosen.edit')
            

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function () {
            $(".create-dosen-btn").click(function () {
                $("#createModal").removeClass("hidden");
            });

            $("#closeCreateModal").click(function () {
                $("#createModal").addClass("hidden");
            })
        })
    </script>
    <script>
        document.querySelectorAll('.btn-edit').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const email = button.dataset.email;
                const nidn = button.dataset.nidn;
                console.log(id, name, email, nidn);
                // Set ke form modal
                // document.getElementById('edit-id').value = id;
                $('#dosenForm').attr('action', `/admin/dosen/${id}`);
                // Pastikan hanya ada satu input _method untuk update
                if ($('#dosenForm').find('input[name="_method"]').length === 0) {
                    $('#dosenForm').append('<input type="hidden" name="_method" value="PUT">');
                }
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-email').value = email;
                document.getElementById('edit-nidn').value = nidn;
            });
        });
    </script>
    @endsection
</x-app-layout>