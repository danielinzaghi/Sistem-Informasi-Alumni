<!-- Modal -->
<div id="modalProdiCreate" class="hidden fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg px-2 py-1">
        <div class="modal-content p-6 max-h-[80vh] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            <h2 class="text-xl font-semibold mb-4">Tabah Program Studi</h2>
            <form action="{{ route('admin.prodi.store') }}" method="POST">
                @csrf
                {{-- @method('PUT') --}}
                
                <input type="text" name="jurusan_id" id="jurusanId" hidden>
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Prodi</label>
                    <input type="text" id="nama_prodi" name="nama_prodi" class="mt-1 block w-full border rounded-md p-2" required>
                </div>

                <!-- Role -->
                <div class="mb-4">
                    <label for="kaprodi" id="kaprodi-label" class="block text-sm font-medium text-gray-700">Kaprodi</label>
                    <select id="kaprodi" name="id_kaprodi" class="mt-1 block w-full border rounded-md p-2" required>
                        <option value="" disabled>Pilih Kaprodi</option>
                        {{-- <option id="selectedKaprodi"></option> --}}
                        @foreach ($dosens as $d)
                        <option value="{{ $d->id }}">{{ $d->user->name ?? '-' }}</option>
                        @endforeach
                        {{-- <option value="kaprodi">Kaprodi</option> --}}
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeCreateModal" onclick="closeModal('modalProdiCreate')" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded">Batal</button>
                    <button type="submit" id="saveUser" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
