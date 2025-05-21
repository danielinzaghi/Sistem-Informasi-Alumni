<div
    id="editDosenModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-semibold">Edit Dosen</h2>

        <form id="dosenForm" method="POST" action="{{ route('admin.dosen.store') }}">
            @csrf
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-2">
                    <label
                        for="name"
                        class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input
                        type="text"
                        name="name"
                        id="edit-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder="Isikan nama pengguna"
                        required=""></div>
                <div class="col-span-2 sm:col-span-1">
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium text-gray-900">NIDN</label>
                    <input
                        type="text"
                        name="nidn"
                        id="edit-nidn"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=""
                        required=""></div>
                <div class="col-span-2 sm:col-span-1">
                    <label
                        for="category"
                        class="block mb-2 text-sm font-medium text-gray-900">email</label>
                    <input readonly
                        type="email"
                        name="email"
                        id="edit-email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                        placeholder=""
                        required="">
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button
                    type="button" onclick="closeModal('editDosenModal')"
                    {{-- id="closeCreateModal" --}}
                    class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
