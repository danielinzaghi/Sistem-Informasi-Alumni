<x-app-layout>
    @section('content')
    <div class="flex justify-between items-center">
        <h1 class="font-semibold text-2xl mb-4">Data Dosen</h1>
        <button
            type="button"
            class="create-dosen-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah</button>
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
            @foreach ($dosen as $data)
            <tr class="bg-white border-b" style="cursor: pointer;">
                <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->user->name }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->user->email }}</td>
                <td class="px-2 text-center py-4 border">{{ $data->nidn }}</td>
                <td class="px-2 text-center py-4 border">
                    <a
                        href="{{ route('admin.dosen.edit', $data->id) }}"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                    <a
                        href="#"
                        data-id="{{ $data->id }}"
                        class="delete-dosen-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                        Hapus
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal Tambah Dosen --}}
    <div
        id="createModal"
        class=" hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-semibold">Tambah Dosen</h2>

            <form method="POST" action="{{ route('admin.dosen.store') }}">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label
                            for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Isikan nama pengguna"
                            required=""></div>
                        <div class="col-span-2 sm:col-span-1">
                            <label
                                for="price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIDN</label>
                            <input
                                type="text"
                                name="nidn"
                                id="nidn"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder=""
                                required=""></div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    for="category"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                                <select
                                    id="role_id"
                                    name="role_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    <option selected="selected" disabled="disabled">Pilih user</option>
                                    @foreach ($userDosen as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
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
        $(".delete-dosen-btn").click(function (e) {
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
                            url: "/admin/dosen/" + userId,
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