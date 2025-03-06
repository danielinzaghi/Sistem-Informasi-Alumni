<x-app-layout>
    @section('content')
    @section('main_folder', 'User')
    {{-- @section('main_folder-link', route('admin.user.index')) --}}
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-2xl mb-4">Data Pengguna</h1>
        <button
            type="button"
            class="create-user-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</button>
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
                    <a
                        href="{{ route('admin.user.edit', $data->id) }}"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                    <a
                        href="#" data-id="{{ $data->id }}"
                        class="delete-user-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                        @if ($data->roles->first()->name == 'admin')
                            hidden
                        @endif>
                        Hapus
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal Tambah User --}}
    <div
        id="createModal"
        class=" hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-semibold">Tambah User</h2>

            <form method="POST" action="{{ route('admin.user.store') }}">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Isikan nama pengguna"
                            required=""></div>
                        <div class="col-span-2 sm:col-span-1">
                            <label
                                for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="jake@gmail.com"
                                required=""></div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                <select
                                    id="role_id"
                                    name="role_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="selected" disabled="disabled">Pilih role</option>
                                    @foreach ($role as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button
                                type="button"
                                id="closeCreateModal"
                                class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded ml-2">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Edit -->
            <div
                id="editModal"
                class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg w-1/3">
                    <h2 class="text-xl font-semibold">Edit User</h2>

                    <form id="editUserForm" method="POST">
                        @csrf @method('PUT')

                        <input type="hidden" name="user_id" id="userIdInput">

                            <label class="block mt-2">Nama</label>
                            <input type="text" name="name" id="userName" class="w-full border p-2 rounded">

                                <label class="block mt-2">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="userEmail"
                                    class="w-full border p-2 rounded">

                                    <label class="block mt-2">Role</label>
                                    <input type="text" name="role" id="userRole" class="w-full border p-2 rounded">
                                        {{-- <label class="block mt-2">Role</label>
                <select id="userRole" name="role_id" class="w-full border p-2 rounded">
                    @foreach ($role as $r)
                        <option value="{{ $r->id }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                                --}}

                                <div class="flex justify-end mt-4">
                                    <button
                                        type="button"
                                        id="closeEditModal"
                                        class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded ml-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
                    <script>
                        $(document).ready(function () {
                            $(".create-user-btn").click(function () {
                                $("#createModal").removeClass("hidden");
                            });

                            $("#closeCreateModal").click(function () {
                                $("#createModal").addClass("hidden");
                            })

                            $(".edit-user-btn").click(function () {
                                let userId = $(this).data("id"); // Ambil ID user

                                $.ajax({
                                    url: "/admin/user/" + userId, // Endpoint backend untuk ambil data user
                                    type: "GET",
                                    success: function (response) {
                                        $("#userIdInput").val(response.id);
                                        $("#userName").val(response.name);
                                        $("#userEmail").val(response.email);
                                        $("#userRole")
                                            .val(response.role_id)
                                            .change(); // Pilih role sesuai ID

                                        // Set action form sesuai dengan route update
                                        let updateUrl = "{{ route('admin.user.update', ':id') }}".replace(
                                            ':id',
                                            response.id
                                        );
                                        $("#editUserForm").attr("action", updateUrl);

                                        // Tampilkan modal
                                        $("#editModal").removeClass("hidden");
                                    }
                                });
                            });

                            $("#closeEditModal").click(function () {
                                $("#editModal").addClass("hidden");
                            });
                        })
                    </script>
                    <script>
                        $(".delete-user-btn").click(function (e) {
                            e.preventDefault(); // Mencegah default action

                            let userId = $(this).data("id"); // Ambil ID user dari tombol

                            Swal
                                .fire({
                                    title: "Apakah Anda yakin?",
                                    text: "User yang dihapus tidak bisa dikembalikan!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#d33",
                                    cancelButtonColor: "#3085d6",
                                    confirmButtonText: "Ya, hapus!",
                                    cancelButtonText: "Batal"
                                })
                                .then((result) => {
                                    if (result.isConfirmed) {
                                        $.ajax({
                                            url: "/admin/user/" + userId,
                                            type: "DELETE",
                                            data: {
                                                _token: "{{ csrf_token() }}"
                                            },
                                            success: function (response) {
                                                Swal
                                                    .fire("Terhapus!", "User berhasil dihapus.", "success")
                                                    .then(() => {
                                                        location.reload(); // Reload halaman setelah sukses
                                                    });
                                            },
                                            error: function () {
                                                Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus.", "error");
                                            }
                                        });
                                    }
                                });
                        });
                    </script>
                    @endsection
                </x-app-layout>