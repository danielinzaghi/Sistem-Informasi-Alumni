<!DOCTYPE html>
<html>
<head>
    <title>Tracer Study</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            background-color: #f0f0f0;
            padding: 8px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

    <h2>KUESIONER PENELUSURAN LULUSAN (TRACER STUDY)</h2>

    <table>
        <tr><th>Nama Alumni</th><td>{{ $tracerStudi->alumni->mahasiswa->user->name }}</td></tr>
        <tr><th>Tahun Lulus</th><td>{{ $tracerStudi->alumni->tahun_lulus }}</td></tr>
        <tr><th>Status Saat Ini</th><td>{{ $tracerStudi->status_saat_ini }}</td></tr>
    </table>

    @if($tracerStudi->status_saat_ini == 'Bekerja')
        <div class="section-title">Informasi Pekerjaan</div>
        <table>
            <tr><th>Waktu Dapat Kerja</th><td>{{ $tracerStudi->bekerja->waktu_dapat_kerja ?? '-' }} bulan</td></tr>
            <tr><th>Gaji Bulanan</th><td>{{ $tracerStudi->bekerja->gaji_bulanan ?? '-' }}</td></tr>
            @if ($tracerStudi->bekerja->lokasi_negara)
                <tr><th>Lokasi Negara</th><td>{{ $tracerStudi->bekerja->lokasi_negara }}</td></tr>
            @else
                <tr><th>Provinsi</th><td>{{ $tracerStudi->bekerja->lokasi_provinsi ?? '-' }}</td></tr>
                <tr><th>Kota</th><td>{{ $tracerStudi->bekerja->lokasi_kota ?? '-' }}</td></tr>
            @endif
            <tr><th>Jenis Perusahaan</th><td>{{ $tracerStudi->bekerja->jenis_perusahaan ?? '-' }}</td></tr>
            @if($tracerStudi->bekerja->jenis_perusahaan == 'Lainnya')
                <tr><th>Jenis Lainnya</th><td>{{ $tracerStudi->bekerja->jenis_perusahaan_lainnya ?? '-' }}</td></tr>
            @endif
            <tr><th>Nama Perusahaan</th><td>{{ $tracerStudi->bekerja->nama_perusahaan ?? '-' }}</td></tr>
            <tr><th>Tingkat Perusahaan</th><td>{{ $tracerStudi->bekerja->tingkat_perusahaan ?? '-' }}</td></tr>
            <tr><th>Alasan Ambil Pekerjaan</th><td>{{ $tracerStudi->bekerja->alasan_ambil_pekerjaan ?? '-' }}</td></tr>
            <tr><th>Tingkat Pendidikan Pekerjaan</th><td>{{ $tracerStudi->bekerja->tingkat_pendidikan_pekerjaan ?? '-' }}</td></tr>
        </table>
    @endif

    @if($tracerStudi->status_saat_ini == 'Wiraswasta')
        <div class="section-title">Informasi Wirausaha</div>
        <table>
            <tr><th>Nama Usaha</th><td>{{ $tracerStudi->wirausaha->nama_usaha ?? '-' }}</td></tr>
            <tr><th>Bidang Usaha</th><td>{{ $tracerStudi->wirausaha->bidang_usaha ?? '-' }}</td></tr>
            <tr><th>Tahun Berdiri</th><td>{{ $tracerStudi->wirausaha->tahun_berdiri ?? '-' }}</td></tr>
            <tr><th>Jumlah Karyawan</th><td>{{ $tracerStudi->wirausaha->jumlah_karyawan ?? '-' }}</td></tr>
            <tr><th>Posisi Wirausaha</th><td>{{ $tracerStudi->wirausaha->posisi_wirausaha ?? '-' }}</td></tr>
            <tr><th>Omzet Per Bulan</th><td>{{ $tracerStudi->wirausaha->omzet_per_bulan ?? '-' }}</td></tr>
            <tr><th>Bentuk Usaha</th><td>{{ $tracerStudi->wirausaha->bentuk_usaha ?? '-' }}</td></tr>
            <tr><th>NPWP Usaha</th><td>{{ $tracerStudi->wirausaha->npwp_usaha ?? '-' }}</td></tr>
        </table>
    @endif

    @if($tracerStudi->status_saat_ini == 'Melanjutkan Pendidikan')
        <div class="section-title">Pendidikan Lanjut</div>
        <table>
            <tr><th>Universitas</th><td>{{ $tracerStudi->pendidikanLanjut->universitas_lanjut ?? '-' }}</td></tr>
            <tr><th>Sumber Biaya</th><td>{{ $tracerStudi->pendidikanLanjut->sumber_biaya_studi ?? '-' }}</td></tr>
            <tr><th>Program Studi</th><td>{{ $tracerStudi->pendidikanLanjut->program_studi_lanjut ?? '-' }}</td></tr>
            <tr><th>Tanggal Masuk</th><td>{{ $tracerStudi->pendidikanLanjut->tanggal_masuk_lanjut ?? '-' }}</td></tr>
            <tr><th>Hubungan dengan Pekerjaan</th><td>{{ $tracerStudi->pendidikanLanjut->hubungan_studi_pekerjaan ?? '-' }}</td></tr>
        </table>
    @endif

    @if($tracerStudi->status_saat_ini == 'Belum bekerja')
        <div class="section-title">Belum Bekerja</div>
        <table>
            <tr><th>Alasan Belum Bekerja</th><td>{{ $tracerStudi->belumBekerja->alasan_belum_bekerja ?? '-' }}</td></tr>
            @if($tracerStudi->belumBekerja->alasan_belum_bekerja == 'Lainnya')
                <tr><th>Alasan Lainnya</th><td>{{ $tracerStudi->belumBekerja->alasan_lainnya ?? '-' }}</td></tr>
            @endif
            <tr><th>Kendala Mendapat Pekerjaan</th><td>{{ $tracerStudi->belumBekerja->kendala_mendapat_pekerjaan ?? '-' }}</td></tr>
            @if($tracerStudi->belumBekerja->alasan_belum_bekerja == 'Lainnya')
                <tr><th>Kendala Lainnya</th><td>{{ $tracerStudi->belumBekerja->kendala_lainnya ?? '-' }}</td></tr>
            @endif
            <tr><th>Mengikuti Pelatihan?</th><td>{{ $tracerStudi->belumBekerja->mengikuti_pelatihan ?? '-' }}</td></tr>
            @if($tracerStudi->belumBekerja->mengikuti_pelatihan == 'Ya')
                <tr><th>Nama Pelatihan</th><td>{{ $tracerStudi->belumBekerja->nama_pelatihan ?? '-' }}</td></tr>
                <tr><th>Durasi Pelatihan</th><td>{{ $tracerStudi->belumBekerja->durasi_pelatihan ?? '-' }}</td></tr>
                <tr><th>Sertifikasi Pelatihan</th><td>{{ $tracerStudi->belumBekerja->sertifikasi_pelatihan ?? '-' }}</td></tr>
            @endif
        </table>
    @endif

    @if($tracerStudi->status_saat_ini == 'Mencari kerja')
        <div class="section-title">Mencari Kerja</div>
        <table>
            <tr><th>Aktif Mencari Kerja</th><td>{{ $tracerStudi->pencarianKerja->aktif_mencari_kerja ?? '-' }}</td></tr>
            <tr><th>Melamar Pekerjaan</th><td>{{ $tracerStudi->pencarianKerja->melamar_pekerjaan ?? '-' }}</td></tr>
            <tr><th>Metode Mencari Kerja</th><td>{{ $tracerStudi->pencarianKerja->metode_cari_kerja ?? '-' }}</td></tr>
            <tr><th>Jumlah Lamaran</th><td>{{ $tracerStudi->pencarianKerja->jumlah_lamaran ?? '-' }}</td></tr>
            <tr><th>Jumlah Wawancara</th><td>{{ $tracerStudi->pencarianKerja->jumlah_wawancara ?? '-' }}</td></tr>
        </table>
    @endif

</body>
</html>
