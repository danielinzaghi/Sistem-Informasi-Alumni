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
                    @elseif($tracerStudy->status_saat_ini == 'Mencari kerja') bg-yellow-100 text-yellow-800 
                    @elseif($tracerStudy->status_saat_ini == 'Belum bekerja') bg-yellow-100 text-yellow-800 
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
             <div>
            <p class="font-semibold text-gray-700">🕒 Terakhir Diperbarui:</p>
            <p>{{ optional($tracerStudy->bekerja)->updated_at?->format('d-m-Y') ?? '-' }}</p>
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
        @elseif($tracerStudy->status_saat_ini == 'Wiraswasta')
            <div class="col-span-2">
                <h3 class="text-xl font-bold mt-4 text-blue-600 border-b pb-2">🎓 Wiraswasta</h3>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🏫 Nama Usaha:</p>
                <p>{{ $tracerStudy->wirausaha->nama_usaha?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">💳 Bidang Usaha:</p>
                <p>{{ $tracerStudy->wirausaha->bidang_usaha ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📘 Tahun Berdiri:</p>
                <p>{{ $tracerStudy->wirausaha->tahun_berdiri ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📅 Jumlah Karyawan:</p>
                <p>{{ $tracerStudy->wirausaha->jumlah_karyawan?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 Posisi Wirausaha:</p>
                <p>{{ $tracerStudy->wirausaha->posisi_wirausaha ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 Omset Per Bulan:</p>
                <p>{{ $tracerStudy->wirausaha->omzet_per_bulan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 Bentuk Usaha:</p>
                <p>{{ $tracerStudy->wirausaha->bentuk_usaha ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 NPWP Usaha:</p>
                <p>{{ $tracerStudy->wirausaha->npwp_usaha ?? '-' }}</p>
            </div>
             <div>
            <p class="font-semibold text-gray-700">🕒 Terakhir Diperbarui:</p>
            <p>{{ optional($tracerStudy->wirausaha)->updated_at?->format('d-m-Y') ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Mencari kerja')
            <div class="col-span-2">
                <h3 class="text-xl font-bold mt-4 text-blue-600 border-b pb-2">🎓 Mencari Pekerjaan</h3>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🏫 Aktif Mencari Kerja?:</p>
                <p>{{ $tracerStudy->pencarianKerja->aktif_mencari_kerja?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">💳 Pernah Melamar Pekerjaan (6 bulan terakhir):</p>
                <p>{{ $tracerStudy->pencarianKerja->melamar_pekerjaan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📘 Metode yang digunakan dalam mencari pekerjaan:</p>
                <p>{{ $tracerStudy->pencarianKerja->metode_cari_kerja ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">📅 Berapa banyak lamaran yang dikirimkan:</p>
                <p>{{ $tracerStudy->pencarianKerja->jumlah_lamaran?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🔗 Berapa kali mengikuti wawancara:</p>
                <p>{{ $tracerStudy->pencarianKerja->jumlah_wawancara ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🕒 Terakhir Diperbarui:</p>
                <p>{{ optional($tracerStudy->pencarianKerja)->updated_at?->format('d-m-Y') ?? '-' }}</p>
            </div>
        @elseif($tracerStudy->status_saat_ini == 'Belum bekerja')
            <div class="col-span-2">
                <h3 class="text-xl font-bold mt-4 text-blue-600 border-b pb-2">🎓 Mencari Pekerjaan</h3>
            </div>
            <div>
                <p class="font-semibold text-gray-700">🏫 Alasan Belum Bekerja:</p>
                <p>{{ $tracerStudy->belumBekerja->alasan_belum_bekerja?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->alasan_belum_bekerja == 'Lainnya')
                <div>
                    <p class="font-semibold text-gray-700">📄 Alasan Belum Bekerja Lainnya:</p>
                    <p>{{ $tracerStudy->belumBekerja->alasan_lainnya ?? '-' }}</p>
                </div>
            @endif
            <div>
                <p class="font-semibold text-gray-700">💳 Kendala Mendapat Pekerjaan:</p>
                <p>{{ $tracerStudy->belumBekerja->kendala_mendapat_pekerjaan ?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->alasan_belum_bekerja == 'Lainnya')
                <div>
                    <p class="font-semibold text-gray-700">📄 Kendala  Lainnya:</p>
                    <p>{{ $tracerStudy->belumBekerja->kendala_lainnya ?? '-' }}</p>
                </div>
            @endif
            <div>
                <p class="font-semibold text-gray-700">📘 Mengikuti Pelatihan?:</p>
                <p>{{ $tracerStudy->belumBekerja->mengikuti_pelatihan ?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->mengikuti_pelatihan == 'Ya')
                <div>
                    <p class="font-semibold text-gray-700">📄 Nama Pelatihan:</p>
                    <p>{{ $tracerStudy->belumBekerja->nama_pelatihan ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">📄 Durasi Pelatihan:</p>
                    <p>{{ $tracerStudy->belumBekerja->durasi_pelatihan ?? '-' }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-700">📄 Sertifikasi Pelatihan:</p>
                    <p>{{ $tracerStudy->belumBekerja->sertifikasi_pelatihan ?? '-' }}</p>
                </div>
                <div>
                <p class="font-semibold text-gray-700">🕒 Terakhir Diperbarui:</p>
                <p>{{ optional($tracerStudy->belumBekerja)->updated_at?->format('d-m-Y') ?? '-' }}</p>
            </div>
            @endif
        </div>


        @endif
       
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
