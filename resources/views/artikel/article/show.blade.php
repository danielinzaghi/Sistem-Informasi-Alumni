<x-app-layout>
    @section('content')

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Detail Artikel</h1>


        <div class="bg-white p-6 rounded-lg shadow-md">
            <table class="w-full border-collapse border border-gray-300">
                <tbody>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 w-1/3 text-left">Judul</th>
                        <td class="p-4">{{ $article->judul }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Kategori</th>
                        <td class="p-4">{{ $article->kategori->nama }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Deskripsi</th>
                        <td class="p-4">{!! $article->deskripsi !!}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Gambar</th>
                        <td class="p-4">
                            <a href="{{ asset('storage/uploads/articles/'.$article->img) }}" target="_blank" rel="noopener noreferrer">
                                <img src="{{ asset('storage/uploads/articles/'.$article->img) }}" 
                                     alt="{{ $article->judul }}" 
                                     class="w-64 h-64 object-cover rounded border border-gray-300 shadow-md">
                            </a>
                            
                        </td>
          
                        
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Views</th>
                        <td class="p-4">{{ $article->views }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Status</th>
                        <td class="p-4">
                            @if ($article->status == 1)
                                <span class="bg-green-500 text-white px-3 py-1 rounded">Published</span>
                            @else
                                <span class="bg-red-500 text-white px-3 py-1 rounded">Private</span>
                            @endif
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="p-4 bg-gray-100 text-left">Tanggal Publikasi</th>
                        <td class="p-4">{{ $article->tanggal }}</td>
                    </tr>
                    <tr>
                        <th class="p-4 bg-gray-100 text-left">Penulis</th>
                        <td class="p-4">{{ $article->user->name }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-6 text-right">
                <a href="{{ route('admin.ArticleIndex') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition">Kembali</a>
            </div>
        </div>
    </div>

    @endsection

    <script>
        function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById("imagePreview");
    
        if (input.files && input.files[0]) {
            const reader = new FileReader();
    
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("hidden");
            };
    
            reader.readAsDataURL(input.files[0]); // Baca file sebagai URL
        } else {
            preview.classList.add("hidden");
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

    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/markdown/ckeditor.js"></script>

</x-app-layout>
