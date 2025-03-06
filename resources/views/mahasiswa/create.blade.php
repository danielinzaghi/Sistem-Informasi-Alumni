@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Tambah Mahasiswa</h2>
    <form action="{{ route('admin.mahasiswa.store') }}" method="POST">
        @csrf
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                    {{$error}}
                </div>
            @endforeach
        @endif 
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <select name="users_id" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>            
            </div>    
            <div>
                <label class="block text-sm font-medium text-gray-700">NIM</label>
                <input type="text" name="nim" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="NIM" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="No HP">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Angkatan</label>
                <input type="number" name="angkatan" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm" placeholder="Angkatan" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Prodi</label>
                <select name="id_prodi" class="mt-1 p-2 block w-full border border-gray-300 rounded-lg shadow-sm">
                    @foreach($prodis as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" selected disabled>-- Pilih Tingkat Pendidikan Perusahaan --</option>
                    <option value="aktif">aktif</option>
                    <option value="non-aktif">non-aktif</option>
                    <option value="lulus">lulus</option>
                </select>    
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
