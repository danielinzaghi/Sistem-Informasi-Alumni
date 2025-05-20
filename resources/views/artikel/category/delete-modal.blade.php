<!-- Modal Delete untuk setiap item -->
<div id="modalDelete{{ $item->id }}" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold">Hapus Kategori</h2>
        <p>Apakah Anda yakin ingin menghapus kategori <b>{{ $item->nama }}</b>?</p>
        <form action="{{ route('admin.CategoryDelete', $item->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end mt-4">
                <button type="button" class="bg-gray-300 px-4 py-2 rounded mr-2" onclick="toggleModal('modalDelete{{ $item->id }}')">Batal</button>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</button>
            </div>
        </form>
    </div>
</div>