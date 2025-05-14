<!-- Modal Create -->
<div id="modalCreate" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-96 p-6">
        <!-- Modal Header -->
        <div class="flex justify-between items-center border-b pb-2 mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Tambah Kategori</h3>
            <button class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white" onclick="toggleModal('modalCreate')">
                ✕
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.CategoryStore') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kategori</label>
                <input type="text" name="nama" id="nama" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white">
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600" onclick="toggleModal('modalCreate')">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
