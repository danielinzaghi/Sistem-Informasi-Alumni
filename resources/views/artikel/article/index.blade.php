<x-app-layout>
    @section('content')

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800  leading-tight">
            Artikel
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-semibold">Artikel</h3>
                    <a
                        href="{{ route($user->roles->first()->name . '.article.create') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow-lg transition duration-200">
                        Tambah Artikel
                    </a>
                </div>

                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="w-full bg-gray-200">
                            <th class="py-3 px-4 border-b text-left">No</th>
                            <th class="py-3 px-4 border-b text-left">Judul</th>
                            <th class="py-3 px-4 border-b text-left">Kategori</th>
                            <th class="py-3 px-4 border-b text-left">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left">Status</th>
                            <th class="py-3 px-4 border-b text-left">Penulis</th>
                            <th class="py-3 px-4 border-b text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $index => $berita)
                        <tr class="hover:bg-gray-100 transition duration-150">
                            <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b">{{ $berita->judul }}</td>
                            <td class="py-2 px-4 border-b">{{ $berita->kategori->nama }}</td>
                            <td class="py-2 px-4 border-b">{{ $berita->tanggal }}</td>
                            <td class="py-2 px-4 border-b">
                                <span
                                    class="px-3 py-1 text-white text-sm font-semibold rounded-lg
                                        {{ $berita->status == 1 ? 'bg-green-500' : 'bg-red-500' }}">
                                    {{ $berita->status == 1 ? 'Published' : 'Private' }}
                                </span>
                            </td>

                            <td class="py-2 px-4 border-b">
                                {{ $berita->user->name }}</td>
                            <td class="py-2 px-4 border-b">
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

    @endsection
</x-app-layout>