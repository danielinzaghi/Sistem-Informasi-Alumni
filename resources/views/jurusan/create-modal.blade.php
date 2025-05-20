<!-- Modal Tambah Jurusan -->
<div id="modalCreateJurusan" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Tambah Jurusan</h2>

        <form action="{{ route('admin.jurusan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_jurusan" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" id="nama_jurusan" value="{{ old('nama_jurusan') }}"
                    class="mt-1 p-2 w-full border rounded-md @error('nama_jurusan') border-red-500 @enderror">

                @error('nama_jurusan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_kajur" class="block text-sm font-medium text-gray-700">Ketua Jurusan (Kajur)</label>
                <select name="id_kajur" id="id_kajur" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Kajur --</option>
                    @foreach ($dosens as $d)
                    <option value="{{ $d->id }}">{{ $d->user->name ?? '-' }}</option>
                    @endforeach
                </select>


                @error('id_kajur')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded" onclick="toggleModal('modalCreateJurusan')">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>