

<div id="modalUpdate{{ $item->id }}" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Kategori</h2>

        <form action="{{ route('admin.CategoryUpdate', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name{{ $item->id }}" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                <input type="text" name="nama" id="nama{{ $item->id }}" value="{{ old('nama', $item->nama) }}"
                    class="mt-1 p-2 w-full border rounded-md @error('name') border-red-500 @enderror">
                
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded" onclick="toggleModal('modalUpdate{{ $item->id }}')">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
