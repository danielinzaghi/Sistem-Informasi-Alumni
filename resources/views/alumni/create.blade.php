@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tambah Alumni</h2>
    <form action="{{ route('admin.alumni.store') }}" method="POST">
        @csrf
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-2">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ $mahasiswas->user->name }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswas->id }}" />
            </div>                       
            <div>
                <label class="block text-sm font-medium text-gray-700" for="tahun_lulus">Tahun Lulus</label>
                <input type="number" name="tahun_lulus" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="Tahun Lulus" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="pekerjaan">Pekerjaan</label>
                <input type="text" name="pekerjaan" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="Pekerjaan">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="instansi">Instansi</label>
                <input type="text" name="instansi" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="Instansi">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="npwp">NPWP</label>
                <input type="text" name="npwp" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="NPWP">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700" for="nik">NIK</label>
                <input type="text" name="nik" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="NIK">
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection