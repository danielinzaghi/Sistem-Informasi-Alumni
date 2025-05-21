<!-- Modal Update Jurusan -->
<div id="modalUpdate{{ $j->id }}" class="fixed inset-0 flex items-center justify-center hidden bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white p-6 rounded shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Edit Jurusan</h2>

        <form action="{{ route('admin.jurusan.update', $j->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nama_jurusan{{ $j->id }}" class="block text-sm font-medium text-gray-700">Nama Jurusan</label>
                <input type="text" name="nama_jurusan" id="nama_jurusan{{ $j->id }}" value="{{ old('nama_jurusan', $j->nama_jurusan) }}"
                    class="mt-1 p-2 w-full border rounded-md @error('nama_jurusan') border-red-500 @enderror">
                
                @error('nama_jurusan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_kajur{{ $j->id }}" class="block text-sm font-medium text-gray-700">Ketua Jurusan (Kajur)</label>
                <select name="id_kajur" id="id_kajur{{ $j->id }}" class="mt-1 p-2 w-full border rounded-md @error('id_kajur') border-red-500 @enderror">
                    <option value="">-- Pilih Kajur --</option>
                    @foreach ($dosens as $d)
                        <option value="{{ $d->id }}" {{ (old('id_kajur', $j->id_kajur) == $d->id) ? 'selected' : '' }}>
                            {{ $d->nama }}
                        </option>
                    @endforeach
                </select>

                @error('id_kajur')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" class="px-4 py-2 bg-gray-400 text-white rounded" onclick="toggleModal('modalUpdate{{ $j->id }}')">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>
