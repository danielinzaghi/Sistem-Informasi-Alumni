@extends('layouts.app')

@section('title', 'Edit Data Tracer Study')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Edit Data Tracer Study</h2>

    <form action="{{ route('tracer_study.update', $tracerStudy->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white mb-4">
                    {{$error}}
                </div>
            @endforeach
        @endif

        <div class="mb-5">
            <label for="alumni_id" class="block mb-2 text-sm font-medium text-gray-900">Nama Alumni</label>
            <select name="alumni_id" id="alumni_id" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg w-full p-2.5" required>
                <option value="" disabled>-- Pilih Nama Alumni --</option>
                @foreach ($alumnis as $alumni)
                    <option value="{{ $alumni->id }}" {{ $tracerStudy->alumni_id == $alumni->id ? 'selected' : '' }}>{{ $alumni->nik }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="status_saat_ini" class="block text-gray-700">Status Saat Ini</label>
            <select name="status_saat_ini" id="status_saat_ini" class="w-full p-2 border border-gray-300 rounded-lg" required>
                @foreach(['Bekerja', 'Belum bekerja', 'Wiraswasta', 'Melanjutkan Pendidikan', 'Mencari kerja'] as $status)
                    <option value="{{ $status }}" {{ $tracerStudy->status_saat_ini == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="waktu_dapat_kerja" class="block text-gray-700">Waktu Dapat Kerja (bulan)</label>
            <input type="number" name="waktu_dapat_kerja" id="waktu_dapat_kerja" value="{{ $tracerStudy->waktu_dapat_kerja }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="gaji_bulanan" class="block text-gray-700">Gaji Bulanan</label>
            <input type="number" step="0.01" name="gaji_bulanan" id="gaji_bulanan" value="{{ $tracerStudy->gaji_bulanan }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="lokasi_provinsi" class="block text-gray-700">Provinsi</label>
            <input type="text" name="lokasi_provinsi" id="lokasi_provinsi" value="{{ $tracerStudy->lokasi_provinsi }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="lokasi_kota" class="block text-gray-700">Kota</label>
            <input type="text" name="lokasi_kota" id="lokasi_kota" value="{{ $tracerStudy->lokasi_kota }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="jenis_perusahaan" class="block text-gray-700">Jenis Perusahaan</label>
            <select name="jenis_perusahaan" id="jenis_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                @foreach(['Instansi Pemerintah', 'Organisasi non-profit', 'Perusahaan Swasta', 'Wiraswasta', 'Lainnya'] as $jenis)
                    <option value="{{ $jenis }}" {{ $tracerStudy->jenis_perusahaan == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="nama_perusahaan" class="block text-gray-700">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" id="nama_perusahaan" value="{{ $tracerStudy->nama_perusahaan }}" class="w-full p-2 border border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label for="metode_cari_kerja" class="block text-gray-700">Metode Cari Kerja</label>
            <textarea name="metode_cari_kerja" id="metode_cari_kerja" class="w-full p-2 border border-gray-300 rounded-lg">{{ $tracerStudy->metode_cari_kerja }}</textarea>
        </div>

        <div class="mb-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
        </div>
    </form
</div>
@endsection