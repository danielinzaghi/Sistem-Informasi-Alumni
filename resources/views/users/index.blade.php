<x-app-layout>
    @section('content')
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
            <tr class="bg-white border-b" style="cursor: pointer;">
                <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->name }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->email }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->roles->first()->name }}</td>
                <td class="px-2 text-center py-4 border">

                    <button
                        id="dropdownDefaultButton"
                        data-dropdown-toggle="dropdown"
                        class="text-white  text-sm bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center"
                        type="button">Pilih Aksi
                        <svg
                            class="w-2.5 h-2.5 ms-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 10 6">
                            <path
                                stroke="currentColor"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>

                    <!-- Dropdown menu -->
                    <div
                        id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44">
                        <ul class="py-2 text-sm text-gray-700 " aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                data-id="{{ $data->id }}"
                                data-name="{{ $data->name }}"
                                data-email="{{ $data->email }}"
                                data-role="{{ optional($data->roles->first())->id }}"
                                class=" edit-user-btn block px-4 py-2 hover:bg-gray-100">
                                    Edit
                                </a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Delete</a>
                            </li>
                        </ul>
                    </div>
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
                        $('#dosenFields').addClass('hidden');
                        $('#extraFields').addClass('hidden');
                    } else if (roleSelected === "mahasiswa") {
                        $('#mahasiswaFields').removeClass('hidden');
                        $('#dosenFields').addClass('hidden');
                        $('#extraFields').removeClass('hidden');
                    } else if (roleSelected === "dosen") {
                        $('#mahasiswaFields').addClass('hidden');
                        $('#dosenFields').removeClass('hidden');
                        $('#extraFields').removeClass('hidden');
                    }
                });
                openModal('userModal');
            });

            $(document).on('click', '.edit-user-btn', function() {
                resetModal();
                let userId = $(this).data('id');
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
                        $('#user_id').val(response.user_id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        // $('#role').attr("readonly", true);

                        if (response.roles.length > 0) {
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
                                $('#student_class_id').val(response.student.student_class_id);
                                $('#nim').val(response.student.nim);
                                $('#student_phone_number').val(response.student.student_phone_number);
                                $('#student_address').val(response.student.student_address);
                            } else if (['dosenWali', 'kajur', 'kaprodi'].includes(roleName)) {
                                $('#dosenFields').removeClass('hidden');
                                $('#nidn').val(response.lecturer.nidn);
                                $('#nip').val(response.lecturer.nip);
                                $('#lecturer_phone_number').val(response.lecturer.lecturer_phone_number);
                                $('#lecturer_address').val(response.lecturer.lecturer_address);
                            }
                        }
                        openModal('userModal');
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