@extends('layouts.app')

@section('title', 'Detail Tracer Study')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold mb-6 text-center text-blue-700">Detail Tracer Study</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="font-semibold text-gray-700">👤 Alumni:</p>
            <p class="text-gray-900">{{ $tracerStudy->alumni->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}</p>
        </div>
        <div>
            <p class="font-semibold text-gray-700">📌 Status Saat Ini:</p>
            <p>
                <span class="inline-block px-3 py-1 text-sm rounded-full 
                    @if($tracerStudy->status_saat_ini == 'Bekerja') bg-green-100 text-green-800 
                    @elseif($tracerStudy->status_saat_ini == 'Melanjutkan Pendidikan') bg-indigo-100 text-indigo-800 
                    @elseif($tracerStudy->status_saat_ini == 'Wiraswasta') bg-yellow-100 text-yellow-800 
                    @else bg-gray-100 text-gray-800 @endif">
                    {{ $tracerStudy->status_saat_ini }}
                </span>
            </p>
        </div>

        @if($tracerStudy->status_saat_ini == 'Bekerja')
            <div class="col-span-2">
                <h3 class="text-xl font-bold mt-4 text-blue-600 border-b pb-2">🧑‍💼 Informasi Pekerjaan</h3>
            </div>
            <div>
                <p class="font-semibold text-gray-700">⏱️ Waktu Dapat Kerja:</p>
                <p>{{ $tracerStudy->bekerja->waktu_dapat_kerja . ' bulan' ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">💰 Gaji Bulanan:</p>
                <p>{{ $tracerStudy->bekerja->gaji_bulanan ?? '-' }}</p>
            </div>
            @if ($tracerStudy->bekerja->lokasi_negara)
                <div>
                    <p class="font-semibold text-gray-700">🌍 Lokasi Negara:</p>
                    <p>{{ $tracerStudy->bekerja->lokasi_negara }}</p>
                </div>
            @else
                <div>
                    <p class="font-semibold text-gray-700">📍 Provinsi:</p>
                    <p>{{ $tracerStudy->bekerja->lokasi_provinsi ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">🏙️ Kota:</p>
                    <p>{{ $tracerStudy->bekerja->lokasi_kota ?? '-' }}</p>
                </div>
            @endif
            <div>
                <p class="font-semibold text-gray-700">🏢 Jenis Perusahaan:</p>
                <p>{{ $tracerStudy->bekerja->jenis_perusahaan ?? '-' }}</p>
            </div>
            @if($tracerStudy->bekerja->jenis_perusahaan == 'Lainnya')
                <div>
                    <p class="font-semibold text-gray-700">📄 Jenis Lainnya:</p>
                    <p>{{ $tracerStudy->bekerja->jenis_perusahaan_lainnya ?? '-' }}</p>
                </div>
            @endif
            <div>
                <p class="font-semibold text-gray-700">🏢 Nama Perusahaan:</p>
                <p>{{ $tracerStudy->bekerja->nama_perusahaan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">⭐ Tingkat Perusahaan:</p>
                <p>{{ $tracerStudy->bekerja->tingkat_perusahaan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🎯 Alasan Ambil Pekerjaan:</p>
                <p>{{ $tracerStudy->bekerja->alasan_ambil_pekerjaan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🎓 Tingkat Pendidikan Pekerjaan:</p>
                <p>{{ $tracerStudy->bekerja->tingkat_pendidikan_pekerjaan ?? '-' }}</p>
            </div>
        @elseif($tracerStudy->status_saat_ini == 'Melanjutkan Pendidikan')
            <div class="col-span-2">
                <h3 class="text-xl font-bold mt-4 text-blue-600 border-b pb-2">🎓 Pendidikan Lanjut</h3>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🏫 Universitas:</p>
                <p>{{ $tracerStudy->pendidikanLanjut->universitas_lanjut ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">💳 Sumber Biaya:</p>
                <p>{{ $tracerStudy->pendidikanLanjut->sumber_biaya_studi ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📘 Program Studi:</p>
                <p>{{ $tracerStudy->pendidikanLanjut->program_studi_lanjut ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📅 Tanggal Masuk:</p>
                <p>{{ $tracerStudy->pendidikanLanjut->tanggal_masuk_lanjut ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 Hubungan dengan Pekerjaan:</p>
                <p>{{ $tracerStudy->pendidikanLanjut->hubungan_studi_pekerjaan ?? '-' }}</p>
            </div>
        @endif

        <!-- Tambahan status lainnya tetap pakai format seperti di atas -->
        
        <div>
            <p class="font-semibold text-gray-700">🕒 Terakhir Diperbarui:</p>
            <p>{{ optional($tracerStudy->bekerja)->updated_at?->format('d-m-Y') ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-8 text-center">
        @role('alumni')
            <a href="{{ route('alumni.tracer_study.edit', $tracerStudy->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-full shadow transition duration-300">
                ✏️ Edit Data
            </a>
        @else
            <a href="{{ route(Auth::user()->roles->first()->name . '.tracer_study.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-6 rounded-full shadow transition duration-300">
                ⬅️ Kembali
            </a>
        @endrole
    </div>
</div>

@endsection
