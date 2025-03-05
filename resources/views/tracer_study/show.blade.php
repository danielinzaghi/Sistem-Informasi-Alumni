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
            <p>{{ $tracerStudy->waktu_dapat_kerja ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Gaji Bulanan:</p>
            <p>Rp {{ number_format($tracerStudy->gaji_bulanan, 2) }}</p>
        </div>
        <div>
            <p class="font-semibold">Lokasi Provinsi:</p>
            <p>{{ $tracerStudy->lokasi_provinsi ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Lokasi Kota:</p>
            <p>{{ $tracerStudy->lokasi_kota ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Jenis Perusahaan:</p>
            <p>{{ $tracerStudy->jenis_perusahaan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Nama Perusahaan:</p>
            <p>{{ $tracerStudy->nama_perusahaan ?? '-' }}</p>
        </div>
        @if($tracerStudy->nama_perusahaan == 'Lainnya')
        <div>
            <p class="font-semibold">Nama Perusahaan Liannya:</p>
            <p>{{ $tracerStudy->nama_perusahaan_lainnya ?? '-' }}</p>
        </div>
        @endif
        <div>
            <p class="font-semibold">Tingkat Perusahaan:</p>
            <p>{{ $tracerStudy->tingkat_perusahaan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Metode Cari Kerja:</p>
            <p>{{ $tracerStudy->metode_cari_kerja ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Jumlah Lamaran:</p>
            <p>{{ $tracerStudy->jumlah_lamaran ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Alasan Ambil Pekerjaan:</p>
            <p>{{ $tracerStudy->alasan_ambil_pekerjaan ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Tingkat Pendidikan Perusahaan:</p>
            <p>{{ $tracerStudy->tingkat_pendidikan_perusahaan ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Melanjutkan Pendidikan')
        <div>
            <p class="font-semibold">Universitas Lanjut:</p>
            <p>{{ $tracerStudy->universitas_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Sumber Biaya Studi:</p>
            <p>{{ $tracerStudy->sumber_biaya_studi ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Program Studi Lanjut:</p>
            <p>{{ $tracerStudy->program_studi_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Tanggal Masuk Lanjut:</p>
            <p>{{ $tracerStudy->tanggal_masuk_lanjut ?? '-' }}</p>
        </div>
        <div>
            <p class="font-semibold">Hubungan Studi Pekerjaan:</p>
            <p>{{ $tracerStudy->hubungan_studi_pekerjaan ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Wiraswasta')
        <div>
            <p class="font-semibold">Posisi Wirausaha:</p>
            <p>{{ $tracerStudy->posisi_wirausaha ?? '-' }}</p>
        </div>
        @elseif($tracerStudy->status_saat_ini == 'Belum bekerja'||'Mencari Kerja')
            <div>
                <p class="font-semibold">Alasan Belum Bekerja:</p>
                <p>{{ $tracerStudy->alasan_belum_bekerja ?? '-' }}</p>
            </div>
            @if($tracerStudy->alasan_belum_bekerja == 'Lainnya')
            <div>
                <p class="font-semibold">Alasan Lainnya:</p>
                <p>{{ $tracerStudy->alasan_lainnya ?? '-' }}</p>
            </div>
            @endif
            
            <div>
                <p class="font-semibold">Kendala Mendapatkan Pekerjaan:</p>
                <p>{{ $tracerStudy->kendala_mendapat_pekerjaan ?? '-' }}</p>
            </div>
            @if($tracerStudy->kendala_mendapat_pekerjaan == 'Lainnya')
            <div>
                <p class="font-semibold">Kendala Lainnya:</p>
                <p>{{ $tracerStudy->kendala_lainnya ?? '-' }}</p>
            </div>
            @endif
            <div>
                <p class="font-semibold">Bersedia bekerja di luar bidang studi Anda?</p>
                <p>{{ $tracerStudy->bekerja_di_luar_bidang ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Aktif Mencari Kerja:</p>
                <p>{{ $tracerStudy->aktif_mencari_kerja ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Mengikuti Pelatihan:</p>
                <p>{{ $tracerStudy->mengikuti_pelatihan ?? '-' }}</p>
            </div>
            @if($tracerStudy->mengikuti_pelatihan == 'Ya')
            <div>
                <p class="font-semibold">Nama Pelatihan:</p>
                <p>{{ $tracerStudy->nama_pelatihan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Durasi Pelatihan:</p>
                <p>{{ $tracerStudy->durasi_pelatihan ?? '-' }}</p>
            </div>
            <div>
                <p class="font-semibold">Sertifikasi Pelatihan:</p>
                <p>{{ $tracerStudy->sertifikasi_pelatihan ?? '-' }}</p>
            </div>
            @endif
        @endif
    </div>
    <div class="mt-6 text-center">
        <a href="{{ route('tracer_study.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Kembali
        </a>
    </div>
</div>
@endsection
