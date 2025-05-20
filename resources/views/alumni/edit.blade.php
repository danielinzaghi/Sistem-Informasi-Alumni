@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Edit Alumni</h2>
    <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST">
        @csrf
        @method('PUT')
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-2">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ $alumni->mahasiswa->user->name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" />
                <input type="hidden" name="mahasiswa_id" value="{{ $alumni->mahasiswa->id }}" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="tahun_lulus">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" value="{{ $alumni->tahun_lulus }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" value="{{ $alumni->pekerjaan }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="instansi">Instansi</label>
                <input type="text" name="instansi" value="{{ $alumni->instansi }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="npwp">NPWP</label>
                <input type="text" name="npwp" value="{{ $alumni->npwp }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="nik">NIK</label>
                <input type="text" name="nik" value="{{ $alumni->nik }}" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
