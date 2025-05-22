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
                    <option id="selectedKajur" value="{{ $j->id_kajur }}" selected>{{ $j->kajur->user->name ?? '-' }}</option>
                    @foreach ($dosens as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->user->name }}
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('nama_jurusan'+{{ $j->id }});

        // Cari elemen error jika sudah ada
        let errorContainer = input.parentNode.querySelector('.error-jurusan');

        // Kalau belum ada, buat dan tambahkan
        if (!errorContainer) {
            errorContainer = document.createElement('p');
            errorContainer.className = 'text-red-500 text-sm mt-1 error-jurusan';
            input.parentNode.appendChild(errorContainer);
        }

        input.addEventListener('input', function () {
            const nama = input.value.trim();

            if (!nama) {
                errorContainer.textContent = '';
                input.classList.remove('border-red-500');
                return;
            }

            fetch(`/check-jurusan?nama_jurusan=${encodeURIComponent(nama)}`)
                .then(res => res.json())
                .then(data => {
                    if (data.exists) {
                        errorContainer.textContent = 'Nama jurusan sudah ada.';
                        input.classList.add('border-red-500');
                    } else {
                        errorContainer.textContent = '';
                        input.classList.remove('border-red-500');
                    }
                });
        });

        const form = input.closest('form');
        form.addEventListener('submit', function (e) {
            if (errorContainer.textContent !== '') {
                e.preventDefault();
            }
        });
    });

</script>
