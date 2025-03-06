<x-app-layout>
    @section('content')

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Data Artikel</h1>
        
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <a href="{{ route('admin.ArticleIndex') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Kembali</a>
        
        <form action="{{ route('admin.ArticleUpdate', $article->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="title" class="block font-semibold">Title</label>
                    <input type="text" name="judul" id="title" class="w-full border p-2 rounded" value="{{ old('judul', $article->judul) }}" required>
                </div>
                <div>
                    <label for="category_id" class="block font-semibold">Category</label>
                    <select name="kategori_id" id="category_id" class="w-full border p-2 rounded" required>
                        <option value="" hidden>-- choose --</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ $article->kategori_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label for="desc" class="block font-semibold">Deskripsi</label>
                <textarea name="deskripsi" id="myeditor" class="w-full border p-2 rounded">{{ old('deskripsi', $article->deskripsi ?? '') }}</textarea>
            </div>
            
            <div class="mt-4">
                <label for="img" class="block font-semibold">Image (Max 2MB)</label>
                <input type="file" name="img" id="img" class="w-full border p-2 rounded" accept="image/*" onchange="previewImage(event)">
                <img src="{{ asset('storage/uploads/articles/'.$article->img) }}" alt="Image Preview" class="mt-2 w-64 h-64 object-cover rounded border border-gray-300 shadow-md" id="imagePreview">
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div>
                    <label for="status" class="block font-semibold">Status</label>
                    <select name="status" id="status" class="w-full border p-2 rounded" required>
                        <option value="" hidden>-- choose --</option>
                        <option value="1" {{ $article->status == 1 ? 'selected' : '' }}>Publish</option>
                        <option value="0" {{ $article->status == 0 ? 'selected' : '' }}>Private</option>
                    </select>
                </div>
                <div>
                    <label for="publish_date" class="block font-semibold">Tanggal Publikasi</label>
                    <input type="date" name="tanggal" id="publish_date" class="w-full border p-2 rounded" value="{{ old('tanggal', $article->tanggal) }}" required>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded">Update</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById("imagePreview");
    
            if (input.files && input.files[0]) {
                const reader = new FileReader();
    
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
    
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        ClassicEditor
            .create(document.querySelector('#myeditor'))
            .then(editor => {
                console.log('CKEditor siap!', editor);
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
    </script>



    @endsection

    <script>
        ClassicEditor
            .create(document.querySelector('#myeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</x-app-layout>