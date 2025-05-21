<x-app-layout>
    @section('content') @section('main_folder', 'Article')

    <x-slot name="header">
        <h2 class="font-semibold text-md sm:text-2xl text-gray-800  leading-tight">
            Artikel
        </h2>
    </x-slot>

    {{-- <div class="py-12 px-6"> --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl sm:text-2xl font-semibold">Artikel</h3>
                    <a
                        href="{{ route($user->roles->first()->name . '.article.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs sm:text-sm px-3 sm:px-5 py-1.5 sm:py-2.5 me-2 focus:outline-none">
                        Tambah Artikel
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-2 text-center py-4 border">No</th>
                                <th class="px-2 text-center py-4 border">Judul</th>
                                <th class="px-2 text-center py-4 border">Kategori</th>
                                <th class="px-2 text-center py-4 border">Tanggal</th>
                                <th class="px-2 text-center py-4 border">Status</th>
                                <th class="px-2 text-center py-4 border">Penulis</th>
                                <th class="px-2 text-center py-4 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritas as $index => $berita)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-2 text-center py-4 border">{{ $index + 1 }}</td>
                                <td class="px-2 text-center py-4 border">{{ $berita->judul }}</td>
                                <td class="px-2 text-center py-4 border">{{ $berita->kategori->nama }}</td>
                                <td class="px-2 text-center py-4 border">{{ $berita->tanggal }}</td>
                                <td class="px-2 text-center py-4 border">
                                    <span
                                        class="px-3 py-1 text-white text-sm font-semibold rounded-lg
                                            {{ $berita->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                        {{ $berita->status == 1 ? 'Published' : 'Private' }}
                                    </span>
                                </td>
                                <td class="px-2 text-center py-4 border">
                                    {{ $berita->user->name }}</td>
                                <td class="px-2 text-center py-4 flex justify-center items-center flex-col sm:flex-row gap-0.5 sm:gap-2">
                                    <a
                                        href="{{ route($user->roles->first()->name . '.article.show', $berita->id) }}"
                                        class="bg-orange-400 hover:bg-orange-600 text-white px-3 py-1 rounded transition duration-200">Detail</a>
                                    <a
                                        href="{{ route($user->roles->first()->name . '.article.edit', $berita->id) }}"
                                        class="bg-yellow-500 hover:bg-yellow-200 text-white px-3 py-1 rounded transition duration-200">Edit</a>
                                    <form
                                        action="{{ route($user->roles->first()->name . '.article.destroy', $berita->id) }}"
                                        method="POST"
                                        class="inline"
                                        {{-- onsubmit="return confirm('Yakin ingin menghapus artikel ini?')" --}}>
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            data-confirm-delete="true"
                                            data-title="Hapus Artikel?"
                                            data-text="Yakin ingin menghapus data {{ $berita->judul }}?"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition duration-200">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    {{-- </div> --}}

    @endsection
</x-app-layout>