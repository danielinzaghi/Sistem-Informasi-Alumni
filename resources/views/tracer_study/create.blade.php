@extends('layouts.app')

@section('title', 'Tambah Data Tracer Study')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-4">Tambah Data Tracer Study</h2>

    <form action="{{ route('tracer_study.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                    {{$error}}
                </div>
            @endforeach
        @endif  
        <div class="mb-5">
            <label for="alumni_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Alumni</label>
            <select name="alumni_id" id="alumni_id" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @if(isset($loggedInAlumni))
                    <option value="{{ $loggedInAlumni->id }}" selected>
                        {{ $loggedInAlumni->mahasiswa->user->name ?? $loggedInAlumni->nik }}
                    </option>
                @else
                    <option value="" disabled selected>Data tidak ditemukan</option>
                @endif
            </select>
        </div>                  
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                $('#alumni_id').select2({
                placeholder: "Cari Nama Alumni",
                allowClear: true // Untuk menambahkan tombol clear (opsional)
                });
            });
        </script>
        <div class="mb-4">
            <label for="status_saat_ini" class="block text-gray-700">Status Saat Ini</label>
            <select name="status_saat_ini" id="status_saat_ini" class="w-full p-2 border border-gray-300 rounded-lg">
                <option value="" disabled selected>-- Pilih status saat ini --</option>
                <option value="Bekerja">Bekerja</option>
                <option value="Belum Bekerja">Belum Bekerja</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Melanjutkan Pendidikan">Melanjutkan Pendidikan</option>
                <option value="Mencari Kerja">Mencari Kerja</option>
            </select>
        </div>
        
        <div id="bekerja_field" style="display: none;">
            <div class="mb-4">
                <label for="waktu_dapat_kerja" class="block text-gray-700">Waktu Dapat Kerja (bulan)</label>
                <input type="number" name="waktu_dapat_kerja" id="waktu_dapat_kerja" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
        
            <div class="mb-4">
                <label for="gaji_bulanan" class="block text-gray-700">Gaji Bulanan</label>
                <input type="number" name="gaji_bulanan" id="gaji_bulanan" class="w-full p-2 border border-gray-300 rounded-lg" min="0">
            </div>            
        
            <div class="mb-4">
                <label for="lokasi_provinsi" class="block text-gray-700">Lokasi Provinsi</label>
                <input type="text" name="lokasi_provinsi" id="lokasi_provinsi" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="lokasi_kota" class="block text-gray-700">Lokasi Kota</label>
                <input type="text" name="lokasi_kota" id="lokasi_kota" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
        
            <div class="mb-4">
                <label for="jenis_perusahaan" class="block text-gray-700">Jenis Perusahaan</label>
                <select name="jenis_perusahaan" id="jenis_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Jenis Perusahaan --</option>
                    <option value="Instansi Pemerintah">Instansi Pemerintah</option>
                    <option value="Organisasi non-profit">Organisasi non-profit</option>
                    <option value="Perusahaan Swasta">Perusahaan Swasta</option>
                    <option value="Wiraswasta">Wiraswasta</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        
            <div id="jenis_perusahaan_lainnya_field" style="display: none;">
                <div class="mb-4">
                    <label for="jenis_perusahaan_lainnya" class="block text-gray-700">Jenis Perusahaan Lainnya</label>
                    <input type="text" name="jenis_perusahaan_lainnya" id="jenis_perusahaan_lainnya" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
            </div>
        
            <div class="mb-4">
                <label for="nama_perusahaan" class="block text-gray-700">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="tingkat_perusahaan" class="block text-gray-700">Tingkat Perusahaan</label>
                <select name="tingkat_perusahaan" id="tingkat_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" selected disabled>-- Pilih Tingkat Perusahaan --</option>
                    <option value="Lokal">Lokal</option>
                    <option value="Nasional">Nasional</option>
                    <option value="Multinasional">Multinasional</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="metode_cari_kerja" class="block text-gray-700">Metode Cari Kerja</label>
                <textarea name="metode_cari_kerja" id="metode_cari_kerja" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
            </div>
            <div class="mb-4">
                <label for="jumlah_lamaran" class="block text-gray-700">Jumlah Lamaran</label>
                <input type="number" name="jumlah_lamaran" id="jumlah_lamaran" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="jumlah_wawancara" class="block text-gray-700">Jumlah Wawancara</label>
                <input type="number" name="jumlah_wawancara" id="jumlah_wawancara" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="alasan_ambil_pekerjaan" class="block text-gray-700">Alasan Ambil Pekerjaan</label>
                <input type="text" name="alasan_ambil_pekerjaan" id="alasan_ambil_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="tingkat_pendidikan_perusahaan" class="block text-gray-700">Tingkat Pendidikan Perusahaan</label>
                <select name="tingkat_pendidikan_perusahaan" id="tingkat_pendidikan_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" selected disabled>-- Pilih Tingkat Pendidikan Perusahaan --</option>
                    <option value="Setingkat Lebih Tinggi">Setingkat Lebih Tinggi</option>
                    <option value="Tingkat Yang Sama">Tingkat Yang Sama</option>
                    <option value="Setingkat Lebih Rendah">Setingkat Lebih Rendah</option>
                    <option value="Tidak Perlu Pendidikan Tinggi">Tidak Perlu Pendidikan Tinggi</option>
                </select>        
            </div>
        </div>
        
        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const statusSelect = document.getElementById('status_saat_ini');
            const bekerjaField = document.getElementById('bekerja_field');
            const jenisPerusahaan = document.getElementById('jenis_perusahaan');
            const jenisPerusahaanLainnyaField = document.getElementById('jenis_perusahaan_lainnya_field');
            const jenisPerusahaanLainnya = document.getElementById('jenis_perusahaan_lainnya');
        
            function toggleBekerjaField() {
                if (statusSelect.value === "Bekerja") {
                    bekerjaField.style.display = "block";
                    bekerjaField.querySelectorAll("input, select").forEach(el => {
                        el.required = true;
                    });
                } else {
                    bekerjaField.style.display = "none";
                    bekerjaField.querySelectorAll("input, select").forEach(el => {
                        el.required = false;
                        el.value = ""; // Reset nilai input
                    });
                }
                toggleJenisPerusahaanLainnya(); // Panggil untuk reset field lainnya
            }
        
            function toggleJenisPerusahaanLainnya() {
                if (jenisPerusahaan.value === "Lainnya") {
                    jenisPerusahaanLainnyaField.style.display = "block";
                    jenisPerusahaanLainnya.required = true;
                } else {
                    jenisPerusahaanLainnyaField.style.display = "none";
                    jenisPerusahaanLainnya.required = false;
                    jenisPerusahaanLainnya.value = ""; // Reset nilai input
                }
            }
        
            // Event listener saat halaman dimuat
            toggleBekerjaField();
        
            // Event saat dropdown status berubah
            statusSelect.addEventListener('change', toggleBekerjaField);
        
            // Event saat dropdown jenis perusahaan berubah
            jenisPerusahaan.addEventListener('change', toggleJenisPerusahaanLainnya);
        });
        </script>
        

        <div id="posisi_wirausaha_field" style="display: none;">
            <div class="mb-4">
                <label for="posisi_wirausaha" class="block text-gray-700">Posisi Wirausaha</label>
                <select name="posisi_wirausaha" id="posisi_wirausaha" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" selected disabled>-- Pilih Posisi --</option>
                    <option value="Founder">Founder</option>
                    <option value="Co-Founder">Co-Founder</option>
                    <option value="Staff">Staff</option>
                    <option value="Freelancer">Freelancer</option>
                </select>
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let statusSelect = document.getElementById('status_saat_ini');
                let posisiField = document.getElementById('posisi_wirausaha_field');
        
                function togglePosisiWirausaha() {
                    if (statusSelect.value === "Wiraswasta") {
                        posisiField.style.display = "block";
                    } else {
                        posisiField.style.display = "none";
                        document.getElementById('posisi_wirausaha').value = ""; // Reset value saat disembunyikan
                    }
                }
        
                // Panggil saat halaman dimuat
                togglePosisiWirausaha();
        
                // Event listener saat ada perubahan di dropdown
                statusSelect.addEventListener('change', togglePosisiWirausaha);
            });
        </script>

            <div id="lanjut_pendidikan_field" style="display: none;">
                <div class="mb-4">
                    <label for="sumber_biaya_studi" class="block text-gray-700">Sumber Biaya Studi</label>
                    <select name="sumber_biaya_studi" id="sumber_biaya_studi" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="" selected disabled>-- Pilih Sumber Biaya Studi --</option>
                        <option value="Biaya Sendiri">Biaya Sendiri</option>
                        <option value="Beasiswa">Beasiswa</option>
                    </select>
                </div>
            
                <div class="mb-4">
                    <label for="universitas_lanjut" class="block text-gray-700">Universitas Lanjut</label>
                    <input type="text" name="universitas_lanjut" id="universitas_lanjut" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="program_studi_lanjut" class="block text-gray-700">Program Studi Lanjut</label>
                    <input type="text" name="program_studi_lanjut" id="program_studi_lanjut" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="tanggal_masuk_lanjut" class="block text-gray-700">Tanggal Masuk Lanjut</label>
                    <input type="date" name="tanggal_masuk_lanjut" id="tanggal_masuk_lanjut" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="hubungan_studi_pekerjaan" class="block text-gray-700">Hubungan Studi Pekerjaan</label>
                    <select name="hubungan_studi_pekerjaan" id="hubungan_studi_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="" selected disabled>-- Pilih Sumber Biaya Studi --</option>
                        <option value="Sangat Erat">Sangat Erat</option>
                        <option value="Erat">Erat</option>
                        <option value="Cukup Erat">Cukup Erat</option>
                        <option value="Tidak Sama Sekali">Tidak Sama Sekali</option>
                    </select>
                </div>
            </div>
            
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let statusSelect = document.getElementById('status_saat_ini');
                    let lanjutField = document.getElementById('lanjut_pendidikan_field');
            
                    function toggleLanjutPendidikan() {
                        if (statusSelect.value === "Melanjutkan Pendidikan") {
                            lanjutField.style.display = "block";
                            document.querySelectorAll("#lanjut_pendidikan_field input, #lanjut_pendidikan_field select").forEach(function (el) {
                                el.required = true;
                            });
                        } else {
                            lanjutField.style.display = "none";
                            document.querySelectorAll("#lanjut_pendidikan_field input, #lanjut_pendidikan_field select").forEach(function (el) {
                                el.required = false;
                                el.value = "";
                            });
                        }
                    }
            
                    // Panggil saat halaman dimuat
                    toggleLanjutPendidikan();
            
                    // Event listener
                    statusSelect.addEventListener('change', toggleLanjutPendidikan);
                });
            </script>
        {{-- jika memilih belum bekerja dan mencari pekerjaan --}}
        <div id="belum_bekerja_fields" style="display: none;">
            <div>
                <label for="alasan_belum_bekerja" class="block font-semibold">Alasan Belum Bekerja:</label>
                <select name="alasan_belum_bekerja" id="alasan_belum_bekerja" class="w-full p-2 border rounded">
                    <option value="">Pilih Alasan</option>
                    <option value="Masih mencari pekerjaan yang sesuai">Masih mencari pekerjaan yang sesuai</option>
                    <option value="Tidak ada lowongan yang cocok">Tidak ada lowongan yang cocok</option>
                    <option value="Masalah kesehatan">Masalah kesehatan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div id="alasan_lainnya_container" style="display: none;">
                <label for="alasan_lainnya" class="block font-semibold">Alasan Lainnya:</label>
                <input type="text" name="alasan_lainnya" id="alasan_lainnya" class="w-full p-2 border rounded" placeholder="Tulis alasan lainnya">
            </div>
            <script>
                document.getElementById('alasan_belum_bekerja').addEventListener('change', function () {
                    var lainnyaContainer = document.getElementById('alasan_lainnya_container');
                    if (this.value === 'Lainnya') {
                        lainnyaContainer.style.display = 'block';
                    } else {
                        lainnyaContainer.style.display = 'none';
                    }
                });
            </script>
            <div class="mb-4">
                <label for="melamar_pekerjaan" class="block text-gray-700">Apakah Anda pernah melamar pekerjaan dalam 6 bulan terakhir?</label>
                <select name="melamar_pekerjaan" id="melamar_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="mb-4" id="jumlah_lamaran_field" style="display: none;">
                <label for="jumlah_lamaran" class="block text-gray-700">Jumlah Lamaran Kerja yang Telah Dikirimkan</label>
                <input type="number" name="jumlah_lamaran" id="jumlah_lamaran" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
            <div class="mb-4">
                <label for="kendala_mendapat_pekerjaan" class="block text-gray-700">Kendala Mendapat Pekerjaan</label>
                <select name="kendala_mendapat_pekerjaan" id="kendala_mendapat_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Tidak Ada Lowongan yang Sesuai">Tidak Ada Lowongan yang Sesuai</option>
                    <option value="Kurangnya Pengalaman Kerja">Kurangnya Pengalaman Kerja</option>
                    <option value="Persyaratan yang Tinggi">Persyaratan yang Tinggi</option>
                    <option value="Lokasi yang Terbatas">Lokasi yang Terbatas</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        
            <div class="mb-4" id="kendala_lainnya_field" style="display: none;">
                <label for="kendala_lainnya" class="block text-gray-700">Kendala Lainnya</label>
                <input type="text" name="kendala_lainnya" id="kendala_lainnya" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>
        
            <div class="mb-4">
                <label for="aktif_mencari_kerja" class="block text-gray-700">Apakah Anda aktif mencari kerja saat ini?</label>
                <select name="aktif_mencari_kerja" id="aktif_mencari_kerja" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="bekerja_di_luar_bidang" class="block text-gray-700">Apakah Anda bersedia bekerja di luar bidang studi?</label>
                <select name="bekerja_di_luar_bidang" id="bekerja_di_luar_bidang" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="mengikuti_pelatihan" class="block text-gray-700">Apakah Anda pernah mengikuti pelatihan atau kursus selama masa tunggu kerja?</label>
                <select name="mengikuti_pelatihan" id="mengikuti_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya">Ya</option>
                    <option value="Tidak">Tidak</option>
                </select>
            </div>
        
            <div id="pelatihan_fields" style="display: none;">
                <div class="mb-4">
                    <label for="nama_pelatihan" class="block text-gray-700">Nama Pelatihan</label>
                    <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="durasi_pelatihan" class="block text-gray-700">Durasi Pelatihan</label>
                    <input type="text" name="durasi_pelatihan" id="durasi_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="sertifikasi_pelatihan" class="block text-gray-700">Sertifikasi Pelatihan</label>
                    <input type="text" name="sertifikasi_pelatihan" id="sertifikasi_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let statusSelect = document.getElementById('status_saat_ini');
                let belumBekerjaFields = document.getElementById('belum_bekerja_fields');
                let melamarPekerjaan = document.getElementById('melamar_pekerjaan');
                let jumlahLamaranField = document.getElementById('jumlah_lamaran_field');
                let kendalaPekerjaan = document.getElementById('kendala_mendapat_pekerjaan');
                let kendalaLainnyaField = document.getElementById('kendala_lainnya_field');
                let mengikutiPelatihan = document.getElementById('mengikuti_pelatihan');
                let pelatihanFields = document.getElementById('pelatihan_fields');
        
                function toggleBelumBekerjaFields() {
                    if (statusSelect.value === 'Belum Bekerja' || statusSelect.value === 'Mencari Kerja') {
                        belumBekerjaFields.style.display = "block";
                    } else {
                        belumBekerjaFields.style.display = "none";
                    }
                }
        
                function toggleJumlahLamaran() {
                    jumlahLamaranField.style.display = melamarPekerjaan.value === 'Ya' ? 'block' : 'none';
                }
        
                function toggleKendalaLainnya() {
                    kendalaLainnyaField.style.display = kendalaPekerjaan.value === 'Lainnya' ? 'block' : 'none';
                }
        
                function togglePelatihanFields() {
                    pelatihanFields.style.display = mengikutiPelatihan.value === 'Ya' ? 'block' : 'none';
                }
        
                statusSelect.addEventListener('change', toggleBelumBekerjaFields);
                melamarPekerjaan.addEventListener('change', toggleJumlahLamaran);
                kendalaPekerjaan.addEventListener('change', toggleKendalaLainnya);
                mengikutiPelatihan.addEventListener('change', togglePelatihanFields);
        
                toggleBelumBekerjaFields();
                toggleJumlahLamaran();
                toggleKendalaLainnya();
                togglePelatihanFields();
            });
        </script>
        
        

        <div class="mb-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Simpan</button>
        </div>
    </form>
        

</div>
@endsection
