<x-app-layout>
    @section('content')
    @section('main_folder', 'User')
    {{-- @section('main_folder-link', route('admin.user.index')) --}}
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-2xl mb-4">Data Pengguna</h1>
        <button
            type="button"
            class="create-user-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Tambah</button>  
    </div>
    <table
        class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
        <thead class="text-gray-700 bg-white">
            <tr>
                <th class="px-2 text-center py-3 border w-[40px]">NO</th>
                <th class="px-2 text-center py-3 border w-[20%]">Nama</th>
                <th class="px-2 text-center py-3 border w-[20%]">Email</th>
                <th class="px-2 text-center py-3 border w-[20%]">Role</th>
                <th class="px-2 text-center py-3 border w-[20%]">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $data)
            <tr class="bg-white border-b">
                <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->name }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->email }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->roles->first()->name }}</td>
                <td class="px-2 text-center py-4 border">
                    {{-- <a class="cursor-pointer edit-user-btn" data-id ="{{ $data->id }}">Edit</a> --}}
                    <button data-id ="{{ $data->id }}" type="button" class="edit-user-btn text-yellow-400 border border-yellow-400 hover:bg-yellow-400 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center me-2">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352l2.914-3.086Z" clip-rule="evenodd"/>
                            <path fill-rule="evenodd" d="M19.846 4.318a2.148 2.148 0 0 0-.437-.692 2.014 2.014 0 0 0-.654-.463 1.92 1.92 0 0 0-1.544 0 2.014 2.014 0 0 0-.654.463l-.546.578 2.852 3.02.546-.579a2.14 2.14 0 0 0 .437-.692 2.244 2.244 0 0 0 0-1.635ZM17.45 8.721 14.597 5.7 9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.492.492 0 0 0 .255-.145l4.778-5.06Z" clip-rule="evenodd"/>
                        </svg>                                                    
                        <span class="sr-only">Icon description</span>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @include('users.modal.user-form')
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function resetModal() {
                $('#extraFields').addClass('hidden');
                $('#modalTitle, #user_id, #name, #email, #role, #student_class_id, #nim, #student_phone_number, #student_address, #nidn, #nip, #lecturer_phone_number, #lecturer_address').val('');
                // $('#role').prop("readonly", false);
            }

            $('.create-user-btn').click(function() {
                resetModal();
                // $('#roleInput')
                $('#saveUser').text('Simpan');
                $('#modalTitle').text('Tambah User');
                $('#userForm')
                    .attr('action', "{{ route('admin.user.store') }}")
                    .find('input[name="_method"]').remove();
                $('#role').removeClass('hidden');

                $('#role').change(function () {
                    var roleSelected = $(this).val();

                    if (roleSelected === "admin" || roleSelected === "") {
                        $('#mahasiswaFields').addClass('hidden');
                        $('#alumniFields').addClass('hidden');
                        $('#dosenFields').addClass('hidden');
                        $('#extraFields').addClass('hidden');
                    } else if (roleSelected === "mahasiswa") {
                        $('#mahasiswaFields').removeClass('hidden');
                        $('#alumniFields').addClass('hidden');
                        $('#dosenFields').addClass('hidden');
                        $('#status').attr('disabled', false);
                        $('#status').val('');
                        $('#extraFields').removeClass('hidden');
                    } else if (roleSelected === "alumni") {
                        $('#mahasiswaFields').removeClass('hidden');
                        $('#alumniFields').removeClass('hidden');
                        $('#dosenFields').addClass('hidden');
                        $('#status').attr('disabled', true);
                        $('#status').val('lulus');
                        $('#extraFields').removeClass('hidden');
                    } else if (roleSelected === "dosen") {
                        $('#mahasiswaFields').addClass('hidden');
                        $('#alumniFields').addClass('hidden');
                        $('#dosenFields').removeClass('hidden');
                        $('#extraFields').removeClass('hidden');
                    }
                });
                openModal('userModal');
            });

            $(document).on('click', '.edit-user-btn', function() {
                resetModal();
                let userId = $(this).data('id');

                console.log("id user: ", userId);
                $('#saveUser').text('Ubah');
                $('#role').addClass('hidden');
                $('#role-label').addClass('hidden');
                // Pastikan hanya ada satu input _method untuk update
                if ($('#userForm').find('input[name="_method"]').length === 0) {
                    $('#userForm').append('<input type="hidden" name="_method" value="PUT">');
                }

                // Gunakan route update (PUT)
                $('#userForm').attr('action', `/admin/user/${userId}`);

                $.ajax({
                    url: `/admin/user/${userId}/edit`, // route edit
                    type: 'GET',
                    success: function(response) {
                        $('#user_id').val(response.id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        // $('#role').attr("readonly", true);
                        // console.log(response.roles[0].name);
                        
                        console.log("role dari user:", response.roles);
                        // console.log("nidn dari user:", response.dosen.nidn?);
                        if (response && response.roles) {
                            let roleName = response.roles[0].name;
                            
                            // Ubah roleName agar tampil lebih baik
                            let formattedRole = roleName
                                .replace(/([a-z])([A-Z])/g, '$1 $2') // Tambahkan spasi sebelum huruf kapital
                                .replace(/\b\w/g, char => char.toUpperCase()); // Kapitalisasi setiap kata

                            $('#modalTitle').text('Edit ' + formattedRole);

                            $('#role').val(roleName).prop("readonly", true);

                            $('#extraFields').removeClass('hidden');
                            $('#mahasiswaFields, #dosenFields').addClass('hidden');

                            if (roleName === 'mahasiswa') {
                                $('#mahasiswaFields').removeClass('hidden');
                                // $('#student_class_id').val(response.student.student_class_id);
                                $('#nim').val(response.mahasiswa?.nim);
                                $('#no_hp').val(response.mahasiswa?.no_hp);
                                $('#angkatan').val(response.mahasiswa?.angkatan);
                                $('#status').val(response.mahasiswa?.status);
                            } else if (roleName === 'alumni') {
                                $('#mahasiswaFields').removeClass('hidden');
                                $('#alumniFields').removeClass('hidden');
                                $('#nim').val(response.mahasiswa?.nim);
                                $('#angkatan').val(response.mahasiswa?.angkatan);
                                $('#no_hp').val(response.mahasiswa?.no_hp);
                                $('#prodi').val(response.mahasiswa?.id_prodi);
                                $('#status_field').addClass('hidden');
                                $('#tahun_lulus').val(response.alumni?.tahun_lulus);

                                const pekerjaan = response.alumni?.pekerjaan ?? null;
                                const instansi = response.alumni?.instansi ?? null;
                                pekerjaan ?  $('#pekerjaan').val(pekerjaan) : $('#pekerjaan').attr('placeholder', 'Belum diisi');
                                instansi ?  $('#instansi').val(instansi) : $('#instansi').attr('placeholder', 'Belum diisi');

                                $('#npwp').val(response.alumni?.npwp);
                                $('#nik').val(response.alumni?.nik);
                            } else if (roleName === 'dosen') {
                                $('#dosenFields').removeClass('hidden');
                                $('#nidn').val(response.dosen?.nidn);
                            }
                            openModal('userModal');
                        }
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan saat mengambil data user", error);
                    }
                });
            });
        });

    </script>
    @endsection
</x-app-layout>
