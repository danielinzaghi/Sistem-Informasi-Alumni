<x-app-layout>
    @section('main_folder', 'Tracer Study') @section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class=" text-md sm:text-2xl font-bold text-gray-700">Data Tracer Study</h1>
    </div>

    <div class="overflow-x-auto">
        <table
            class="w-100 sm:min-w-full text-[9px] sm:text-[15px] text-gray-500 border border-gray-300 shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 text-center py-4 border">No</th>
                    <th class="px-2 text-center py-4 border">Nama Alumni</th>
                    <th class="px-2 text-center py-4 border">Status</th>
                    <th class="px-2 text-center py-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tracerStudies as $tracer)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-2 text-center py-4 border">{{ $loop->iteration }}</td>
                    <td class="px-2 text-center py-4 border">{{ $tracer->alumni->mahasiswa->user->name }}</td>
                    <td class="px-2 text-center py-4 border">{{ $tracer->status_saat_ini }}</td>
                    <td
                        class="px-2 text-center py-4 flex justify-center items-center flex-col sm:flex-row gap-0.5 sm:gap-2">
                        @role('alumni') @if (!$tracer->sudahLengkap())
                        {{-- Tombol Lengkapi Data --}}
                        <a
                            href="{{ route('alumni.tracer_study.edit', $tracer->id) }}"
                            class="inline-flex items-center sm:px-3 py-1 bg-yellow-500 text-white text-sm font-medium rounded hover:bg-yellow-600 transition">
                            📝 Isi Data Tracer Studi
                        </a>
                        @else
                        {{-- Tombol Edit --}}
                        <a
                            href="{{ route('alumni.tracer_study.edit', $tracer->id) }}"
                            class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-sm font-medium rounded hover:bg-blue-600 transition">
                            ✏️ Edit
                        </a>
                        @endif @endrole

                        {{-- Tombol Show --}}
                        <a
                            href="{{ route(Auth::user()->roles->first()->name . '.tracer_study.show', $tracer->id) }}"
                            class="inline-flex items-center px-3 py-1 bg-green-500 text-white text-[9px] sm:text-sm font-medium rounded hover:bg-green-600 transition">
                            Show
                        </a>
                        <a
                            href="{{ route('admin.tracer-study.export.pdf', $tracer->id) }}"
                            target="_blank"
                            class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-[9px] sm:text-sm font-medium rounded hover:bg-red-700 transition">
                            Export
                        </a>

                        @role('alumni')
                        {{-- Tombol Hapus --}}
                        <button
                            type="button"
                            data-confirm-delete="true"
                            data-title="Hapus Tracer Study?"
                            data-text="Yakin ingin menghapus tracer study {{ $tracer->alumni->mahasiswa->user->name }}?"
                            class="inline-flex items-center px-3 py-1 bg-red-500 text-white text-sm font-medium rounded hover:bg-red-600 transition">
                            🗑️ Hapus
                        </button>
                        @endrole
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endsection
</x-app-layout>