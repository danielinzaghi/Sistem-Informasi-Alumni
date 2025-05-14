@extends('layouts.app')

@section('title', 'Detail Tracer Study')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-4 text-center">Detail Tracer Study</h2>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="font-semibold">Alumni:</p>
            <p>{{ $tracerStudy->alumni->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}</p>
        </div>        
        <div>
            <p class="font-semibold">Status Saat Ini:</p>
            <p>{{ $tracerStudy->status_saat_ini }}</p>
        </div>
        @if($tracerStudy->status_saat_ini == 'Bekerja')
        <div>
            <p class="font-semibold">Waktu Dapat Kerja:</p>
            <p>{{ $tracerStudy->bekerja->waktu_dapat_kerja ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Gaji Bulanan:</p>
            <p>{{ $tracerStudy->bekerja->gaji_bulanan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Lokasi Provinsi:</p>
            <p>{{ $tracerStudy->bekerja->lokasi_provinsi ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Lokasi Kota:</p>
            <p>{{ $tracerStudy->bekerja->lokasi_kota ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Jenis Perusahaan:</p>
            <p>{{ $tracerStudy->bekerja->jenis_perusahaan ?? '-' }}</p>
        </div>
        @if($tracerStudy->bekerja->jenis_perusahaan == 'Lainnya')
        <div>
            <p class="font-semibold">Jenis Perusahaan Liannya:</p>
            <p>{{ $tracerStudy->bekerja->jenis_perusahaan_lainnya ?? '-' }}</p>
        </div>
        @endif
        <div>
            <p class="font-semibold">Nama Perusahaan:</p>
            <p>{{ $tracerStudy->bekerja->nama_perusahaan ?? '-' }}</p>
        </div>
        
        <div>
            <p class="font-semibold">Tingkat Perusahaan:</p>
            <p>{{ $tracerStudy->bekerja->tingkat_perusahaan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Alasan Ambil Pekerjaan:</p>
            <p>{{ $tracerStudy->bekerja->alasan_ambil_pekerjaan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Tingkat Pendidikan Pekerjaan:</p>
            <p>{{ $tracerStudy->bekerja->tingkat_pendidikan_pekerjaan ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Melanjutkan Pendidikan')
        <div>
            <p class="font-semibold">Universitas Lanjut:</p>
            <p>{{ $tracerStudy->pendidikanLanjut->universitas_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Sumber Biaya Studi:</p>
            <p>{{ $tracerStudy->pendidikanLanjut->sumber_biaya_studi ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Program Studi Lanjut:</p>
            <p>{{ $tracerStudy->pendidikanLanjut->program_studi_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Tanggal Masuk Lanjut:</p>
            <p>{{ $tracerStudy->pendidikanLanjut->tanggal_masuk_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Hubungan Studi Pekerjaan:</p>
            <p>{{ $tracerStudy->pendidikanLanjut->hubungan_studi_pekerjaan ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Wiraswasta')
        <div>
            <p class="font-semibold">Posisi Wirausaha:</p>
            <p>{{ $tracerStudy->wirausaha->posisi_wirausaha ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Nama Usaha:</p>
            <p>{{ $tracerStudy->wirausaha->nama_usaha ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Bidang Usaha:</p>
            <p>{{ $tracerStudy->wirausaha->bidang_usaha ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Tahun Berdiri:</p>
            <p>{{ $tracerStudy->wirausaha->tahun_berdiri ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Jumlah Karyawan:</p>
            <p>{{ $tracerStudy->wirausaha->jumlah_karyawan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Omset Per Bulan:</p>
            <p>{{ $tracerStudy->wirausaha->omzet_per_bulan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Bentuk Usaha:</p>
            <p>{{ $tracerStudy->wirausaha->bentuk_usaha ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">NPWP Usaha:</p>
            <p>{{ $tracerStudy->wirausaha->npwp_usaha ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Belum bekerja')
            <div>
                <p class="font-semibold">Alasan Belum Bekerja:</p>
                <p>{{ $tracerStudy->belumBekerja->alasan_belum_bekerja ?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->alasan_belum_bekerja == 'Lainnya')
            <div>
                <p class="font-semibold">Alasan Lainnya:</p>
                <p>{{ $tracerStudy->belumBekerja->alasan_lainnya ?? '-' }}</p>
            </div>
            @endif
            <div>
                <p class="font-semibold">Kendala Mendapatkan Pekerjaan:</p>
                <p>{{ $tracerStudy->belumBekerja->kendala_mendapat_pekerjaan ?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->kendala_mendapat_pekerjaan == 'Lainnya')
            <div>
                <p class="font-semibold">Kendala Lainnya:</p>
                <p>{{ $tracerStudy->belumBekerja->kendala_lainnya ?? '-' }}</p>
            </div>
            @endif
            <div>
                <p class="font-semibold">Mengikuti Pelatihan:</p>
                <p>{{ $tracerStudy->belumBekerja->mengikuti_pelatihan ?? '-' }}</p>
            </div>
            @if($tracerStudy->belumBekerja->mengikuti_pelatihan == 'Ya')
            <div>
                <p class="font-semibold">Nama Pelatihan:</p>
                <p>{{ $tracerStudy->belumBekerja->nama_pelatihan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Durasi Pelatihan:</p>
                <p>{{ $tracerStudy->belumBekerja->durasi_pelatihan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Sertifikasi Pelatihan:</p>
                <p>{{ $tracerStudy->belumBekerja->sertifikasi_pelatihan ?? '-' }}</p>
            </div>
            @endif
        @elseif($tracerStudy->status_saat_ini == 'Mencari kerja')
            <div>
                <p class="font-semibold">Apakah Anda aktif dalam mencari pekerjaan saat ini?:</p>
                <p>{{ $tracerStudy->pencarianKerja->aktif_mencari_kerja ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Pernah Melamar Pekerjaan (6 bulan terakhir)?:</p>
                <p>{{ $tracerStudy->pencarianKerja->melamar_pekerjaan ?? '-' }}</p>
            </div>
            @if($tracerStudy->pencarianKerja->melamar_pekerjaan == 'Ya')
            <div>
                <p class="font-semibold">Banyak Lamaran yang dikirimkan:</p>
                <p>{{ $tracerStudy->pencarianKerja->jumlah_lamaran ?? '-' }}</p>
            </div>
            @endif
            <div>
                <p class="font-semibold">Berapa kali ikut wawancara?:</p>
                <p>{{ $tracerStudy->pencarianKerja->jumlah_wawancara ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Metode cari kerja:</p>
                <p>{{ $tracerStudy->pencarianKerja->metode_cari_kerja ?? '-' }}</p>
            </div>
        @endif
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('tracer_study.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>
@endsection
