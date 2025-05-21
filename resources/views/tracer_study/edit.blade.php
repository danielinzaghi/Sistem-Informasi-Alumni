@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit tracerStudy</h2>

    <form method="POST" action="{{ route('alumni.tracer_study.update', $tracerStudy->id) }}">
        @csrf
        @method('PUT')
        
        {{-- Status Saat Ini --}}
        <div class="mb-4">
            <label for="status_saat_ini" class="block text-gray-700">Status Saat Ini</label>
            <select name="status_saat_ini" id="status_saat_ini" class="w-full p-2 border border-gray-300 rounded-lg">
                <option value="">-- Pilih Status --</option>
                <option value="Bekerja" {{ $tracerStudy->status_saat_ini == 'Bekerja' ? 'selected' : '' }}>Bekerja</option>
                <option value="Wiraswasta" {{ $tracerStudy->status_saat_ini == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                <option value="Melanjutkan Pendidikan" {{ $tracerStudy->status_saat_ini == 'Melanjutkan Pendidikan' ? 'selected' : '' }}>Melanjutkan Pendidikan</option>
                <option value="Belum bekerja" {{ $tracerStudy->status_saat_ini == 'Belum bekerja' ? 'selected' : '' }}>Belum Bekerja</option>
                <option value="Mencari kerja" {{ $tracerStudy->status_saat_ini == 'Mencari kerja' ? 'selected' : '' }}>Mencari kerja</option>
            </select>
        </div>

        {{-- posisi bekerja --}}
        <div id="bekerja_field" style="display: none;">

            <!-- 1. Nama Perusahaan -->
            <div class="mb-4">
                <label for="nama_perusahaan" class="block text-gray-700">Nama Perusahaan</label>
                <input type="text" name="nama_perusahaan" id="nama_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('nama_perusahaan', optional($tracerStudy->bekerja)->nama_perusahaan) }}">
            </div>

            <!-- 2. Jenis Perusahaan -->
            <div class="mb-4">
                <label for="jenis_perusahaan" class="block text-gray-700">Jenis Perusahaan</label>
                <select name="jenis_perusahaan" id="jenis_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Jenis Perusahaan --</option>
                    @foreach (["Instansi Pemerintah", "Organisasi non-profit", "Perusahaan Swasta", "Wiraswasta", "Lainnya"] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_perusahaan', optional($tracerStudy->bekerja)->jenis_perusahaan) == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 3. Jenis Perusahaan Lainnya -->
            <div id="jenis_perusahaan_lainnya_field" style="display: none;">
                <div class="mb-4">
                    <label for="jenis_perusahaan_lainnya" class="block text-gray-700">Jenis Perusahaan Lainnya</label>
                    <input type="text" name="jenis_perusahaan_lainnya" id="jenis_perusahaan_lainnya" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="{{ old('jenis_perusahaan_lainnya', optional($tracerStudy->bekerja)->jenis_perusahaan_lainnya) }}">
                </div>
            </div>

            <!-- 4. Tingkat Perusahaan -->
            <div class="mb-4">
                <label for="tingkat_perusahaan" class="block text-gray-700">Tingkat Perusahaan</label>
                <select name="tingkat_perusahaan" id="tingkat_perusahaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option disabled>-- Pilih Tingkat Perusahaan --</option>
                    @foreach (["Lokal", "Nasional", "Multinasional"] as $tingkat)
                        <option value="{{ $tingkat }}" {{ old('tingkat_perusahaan', optional($tracerStudy->bekerja)->tingkat_perusahaan) == $tingkat ? 'selected' : '' }}>
                            {{ $tingkat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="lokasi_luar_negeri" style="display:none">
                <!-- 5. Lokasi Luar Negeri -->
                <div class="mb-4">
                    <label for="negara" class="block text-gray-700">Lokasi Negara</label>
                    <select name="lokasi_negara" id="lokasi_negara" class="w-full p-2 border border-gray-300 rounded-lg"></select>
                </div>
                <input type="text" hidden name="" id="old_lokasi_negara" value="{{ optional($tracerStudy->bekerja)->lokasi_negara }}">
            </div>

            <!-- Lokasi Indonesia -->
            <div id="lokasi_indonesia" style="display:none">
                <!-- 5. Lokasi Provinsi -->
                <div class="mb-4">
                    <label for="lokasi_provinsi" class="block text-gray-700">Lokasi Provinsi</label>
                    <select name="lokasi_provinsi" id="provinsi" class="w-full p-2 border border-gray-300 rounded-lg"></select>
                </div>
                <input type="text" hidden name="" id="old_lokasi_provinsi" value="{{ optional($tracerStudy->bekerja)->lokasi_provinsi }}">

                <!-- 6. Lokasi Kota -->
                <div class="mb-4">
                    <label for="lokasi_kota" class="block text-gray-700">Lokasi Kota</label>
                    <select name="lokasi_kota" id="kota" class="w-full p-2 border border-gray-300 rounded-lg"></select>
                </div>
                <input type="text" hidden name="" id="old_lokasi_kota" value="{{ optional($tracerStudy->bekerja)->lokasi_kota }}">
            </div>

            <!-- 7. Waktu Dapat Kerja -->
            <div class="mb-4">
                <label for="waktu_dapat_kerja" class="block text-gray-700">Waktu Dapat Kerja (bulan)</label>
                <input type="number" name="waktu_dapat_kerja" id="waktu_dapat_kerja" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('waktu_dapat_kerja', optional($tracerStudy->bekerja)->waktu_dapat_kerja) }}">
            </div>

            <!-- 8. Gaji Bulanan -->
            <div class="mb-4">
                <label for="gaji_bulanan" class="block text-gray-700">Gaji Bulanan</label>
                <select name="gaji_bulanan" id="gaji_bulanan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Range Gaji --</option>
                    <option value="< 1 juta" {{ old('gaji_bulanan', optional($tracerStudy->bekerja)->gaji_bulanan) == '< 1 juta' ? 'selected' : '' }}>
                        &lt; 1 juta
                    </option>
                    <option value="1 - 3 juta" {{ old('gaji_bulanan', optional($tracerStudy->bekerja)->gaji_bulanan) == '1 - 3 juta' ? 'selected' : '' }}>
                        1 - 3 juta
                    </option>
                    <option value="3 - 5 juta" {{ old('gaji_bulanan', optional($tracerStudy->bekerja)->gaji_bulanan) == '3 - 5 juta' ? 'selected' : '' }}>
                        3 - 5 juta
                    </option>
                    <option value="5 - 10 juta" {{ old('gaji_bulanan', optional($tracerStudy->bekerja)->gaji_bulanan) == '5 - 10 juta' ? 'selected' : '' }}>
                        5 - 10 juta
                    </option>
                    <option value="> 10 juta" {{ old('gaji_bulanan', optional($tracerStudy->bekerja)->gaji_bulanan) == '> 10 juta' ? 'selected' : '' }}>
                        &gt; 10 juta
                    </option>
                </select>
            </div>

            <!-- 9. Alasan Ambil Pekerjaan -->
            <div class="mb-4">
                <label for="alasan_ambil_pekerjaan" class="block text-gray-700">Alasan Ambil Pekerjaan</label>
                <input type="text" name="alasan_ambil_pekerjaan" id="alasan_ambil_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('alasan_ambil_pekerjaan', optional($tracerStudy->bekerja)->alasan_ambil_pekerjaan) }}">
            </div>

            <!-- 10. Tingkat Pendidikan Pekerjaan -->
            <div class="mb-4">
                <label for="tingkat_pendidikan_pekerjaan" class="block text-gray-700">Tingkat Pendidikan Pekerjaan</label>
                <select name="tingkat_pendidikan_pekerjaan" id="tingkat_pendidikan_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option disabled>-- Pilih Tingkat Pendidikan pekerjaan --</option>
                    @foreach (["Setingkat Lebih Tinggi", "Tingkat Yang Sama", "Setingkat Lebih Rendah", "Tidak Perlu Pendidikan Tinggi"] as $tingkat)
                        <option value="{{ $tingkat }}" {{ old('tingkat_pendidikan_pekerjaan', optional($tracerStudy->bekerja)->tingkat_pendidikan_pekerjaan) == $tingkat ? 'selected' : '' }}>
                            {{ $tingkat }}
                        </option>
                    @endforeach
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
                    if (statusSelect && statusSelect.value === "Bekerja") {
                        bekerjaField.style.display = "block";
                    } else {
                        bekerjaField.style.display = "none";
                    }
                }

                // Saat halaman dimuat, pastikan field 'jenis_perusahaan_lainnya' tidak required jika disembunyikan
                if (jenisPerusahaan.value !== "Lainnya") {
                    jenisPerusahaanLainnya.required = false;
                }
            
                function toggleJenisPerusahaanLainnya() {
                    if (jenisPerusahaan.value === "Lainnya") {
                        jenisPerusahaanLainnyaField.style.display = "block";
                        jenisPerusahaanLainnya.required = true;
                    } else {
                        jenisPerusahaanLainnyaField.style.display = "none";
                        jenisPerusahaanLainnya.required = false;
                    }
                }
                
                // Saat halaman dimuat, pastikan field 'jenis_perusahaan_lainnya' tidak required jika disembunyikan
                if (jenisPerusahaan.value !== "Lainnya") {
                    jenisPerusahaanLainnya.required = false;
                }
            
                toggleBekerjaField();
                toggleJenisPerusahaanLainnya();
            
                if (statusSelect) {
                    statusSelect.addEventListener('change', toggleBekerjaField);
                }
                jenisPerusahaan.addEventListener('change', toggleJenisPerusahaanLainnya);

                //untuk lokasi perusahaan
                const tingkatPerusahaan = document.getElementById('tingkat_perusahaan');
                const lokasiIndonesia = document.getElementById('lokasi_indonesia');
                const lokasiLuarNegeri = document.getElementById('lokasi_luar_negeri');
                const provinsiSelect = document.getElementById('provinsi');
                const kotaSelect = document.getElementById('kota');
                const negaraSelect = document.getElementById('lokasi_negara');
                const oldNegara = document.getElementById('old_lokasi_negara');
                const oldProvinsi = document.getElementById('old_lokasi_provinsi');
                const oldKota = document.getElementById('old_lokasi_kota');

                console.log(oldNegara.value);

                function showHideFields(tingkat) {
                    if (tingkat === 'Multinasional') {
                        lokasiIndonesia.style.display = 'none';
                        lokasiLuarNegeri.style.display = 'block';
                        loadNegara();
                    } else if (tingkat === 'Lokal' || tingkat === 'Nasional') {
                        lokasiIndonesia.style.display = 'block';
                        lokasiLuarNegeri.style.display = 'none';
                        loadProvinsi();
                    } else {
                        lokasiIndonesia.style.display = 'none';
                        lokasiLuarNegeri.style.display = 'none';
                    }
                }

                tingkatPerusahaan.addEventListener('change', function () {
                    showHideFields(this.value);
                });

                showHideFields(this.value);
                
                // Tambahkan event listener saat provinsi dipilih untuk load kota
                provinsiSelect.addEventListener('change', function () {
                    const selected = this.options[this.selectedIndex];
                    const provId = selected.getAttribute('data-id');
                    if (provId) {
                        loadKota(provId);
                    }
                });
                function loadProvinsi() {
                    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                        .then(res => res.json())
                        .then(data => {
                            provinsiSelect.innerHTML = '<option value="">-- Pilih Provinsi --</option>';
                            data.forEach(prov => {
                                provinsiSelect.innerHTML += `<option value="${prov.name}" data-id="${prov.id}" ${prov.name === oldProvinsi.value ? 'selected' : ''}>${prov.name}</option>`;
                            });

                            // Panggil loadKota jika ada provinsi lama (untuk edit)
                            if (oldProvinsi.value) {
                                const selected = Array.from(provinsiSelect.options).find(opt => opt.value === oldProvinsi.value);
                                if (selected) {
                                    const provId = selected.getAttribute('data-id');
                                    loadKota(provId);
                                }
                            }
                        });
                }
                

                function loadKota(provId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provId}.json`)
                        .then(res => res.json())
                        .then(data => {
                            kotaSelect.innerHTML = '<option value="">-- Pilih Kota --</option>';
                            data.forEach(kota => {
                                kotaSelect.innerHTML += `<option value="${kota.name}" ${kota.name === oldKota.value ? 'selected' : ''}>${kota.name}</option>`;
                            });
                        });
                }

                function loadNegara() {
                    fetch('https://restcountries.com/v3.1/all')
                        .then(res => res.json())
                        .then(data => {
                            negaraSelect.innerHTML = '<option value="">-- Pilih Negara --</option>';
                            data.sort((a, b) => a.name.common.localeCompare(b.name.common)).forEach(neg => {
                                negaraSelect.innerHTML += `<option value="${neg.name.common}" ${neg.name.common === oldNegara.value ? 'selected' : ''}>${neg.name.common}</option>`;
                            });
                        });
                }

                // Trigger otomatis saat halaman pertama kali dibuka
                if (tingkatPerusahaan.value) {
                    showHideFields(tingkatPerusahaan.value);
                }
            });
        </script>
        
        {{-- end --}}

        {{-- wirausaha --}}
        <div id="posisi_wirausaha_field" style="{{ $tracerStudy->status_saat_ini === 'Wiraswasta' ? '' : 'display: none;' }}">
            {{-- Posisi Wirausaha --}}
            <div class="mb-4">
                <label for="posisi_wirausaha" class="block text-gray-700">Posisi Wirausaha</label>
                <select name="posisi_wirausaha" id="posisi_wirausaha" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" disabled {{ is_null(optional($tracerStudy->wirausaha)->posisi_wirausaha) ? 'selected' : '' }}>-- Pilih Posisi --</option>
                    <option value="Founder" {{ optional($tracerStudy->wirausaha)->posisi_wirausaha === 'Founder' ? 'selected' : '' }}>Founder</option>
                    <option value="Co-Founder" {{ optional($tracerStudy->wirausaha)->posisi_wirausaha === 'Co-Founder' ? 'selected' : '' }}>Co-Founder</option>
                    <option value="Staff" {{ optional($tracerStudy->wirausaha)->posisi_wirausaha === 'Staff' ? 'selected' : '' }}>Staff</option>
                    <option value="Freelancer" {{ optional($tracerStudy->wirausaha)->posisi_wirausaha === 'Freelancer' ? 'selected' : '' }}>Freelancer</option>
                </select>
            </div>
        
            {{-- Nama Usaha --}}
            <div class="mb-4">
                <label for="nama_usaha" class="block text-gray-700">Nama Usaha</label>
                <input type="text" name="nama_usaha" id="nama_usaha" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('nama_usaha', optional($tracerStudy->wirausaha)->nama_usaha) }}">
            </div>
        
            {{-- Bidang Usaha --}}
            <div class="mb-4">
                <label for="bidang_usaha" class="block text-gray-700">Bidang Usaha</label>
                <input type="text" name="bidang_usaha" id="bidang_usaha" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('bidang_usaha', optional($tracerStudy->wirausaha)->bidang_usaha) }}">
            </div>
        
            {{-- Tahun Berdiri --}}
            <div class="mb-4">
                <label for="tahun_berdiri" class="block text-gray-700">Tahun Berdiri</label>
                <input type="number" name="tahun_berdiri" id="tahun_berdiri" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('tahun_berdiri', optional($tracerStudy->wirausaha)->tahun_berdiri) }}">
            </div>
        
            {{-- Jumlah Karyawan --}}
            <div class="mb-4">
                <label for="jumlah_karyawan" class="block text-gray-700">Jumlah Karyawan</label>
                <input type="number" name="jumlah_karyawan" id="jumlah_karyawan" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('jumlah_karyawan', optional($tracerStudy->wirausaha)->jumlah_karyawan) }}">
            </div>
        
            {{-- Omzet per Bulan --}}
            <div class="mb-4">
                <label for="omzet_per_bulan" class="block text-gray-700">Omzet per Bulan (dalam rupiah)</label>
                <select name="omzet_per_bulan" id="omzet_per_bulan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Range Omzet --</option>
                    <option value="< 1 juta" {{ old('omzet_per_bulan', optional($tracerStudy->wirausaha)->omzet_per_bulan) == '< 1 juta' ? 'selected' : '' }}>
                        &lt; 1 juta
                    </option>
                    <option value="1 - 5 juta" {{ old('omzet_per_bulan', optional($tracerStudy->wirausaha)->omzet_per_bulan) == '1 - 5 juta' ? 'selected' : '' }}>
                        1 - 5 juta
                    </option>
                    <option value="5 - 10 juta" {{ old('omzet_per_bulan', optional($tracerStudy->wirausaha)->omzet_per_bulan) == '5 - 10 juta' ? 'selected' : '' }}>
                        5 - 10 juta
                    </option>
                    <option value="10 - 20 juta" {{ old('omzet_per_bulan', optional($tracerStudy->wirausaha)->omzet_per_bulan) == '10 - 20 juta' ? 'selected' : '' }}>
                        10 - 20 juta
                    </option>
                    <option value="> 20 juta" {{ old('omzet_per_bulan', optional($tracerStudy->wirausaha)->omzet_per_bulan) == '> 20 juta' ? 'selected' : '' }}>
                        &gt; 20 juta
                    </option>
                </select>
            </div>

        
            {{-- Bentuk Usaha --}}
            <div class="mb-4">
                <label for="bentuk_usaha" class="block text-gray-700">Bentuk Usaha</label>
                <select name="bentuk_usaha" id="bentuk_usaha" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Bentuk Usaha --</option>
                    <option value="PT" {{ old('bentuk_usaha', optional($tracerStudy->wirausaha)->bentuk_usaha) == 'PT' ? 'selected' : '' }}>PT</option>
                    <option value="CV" {{ old('bentuk_usaha', optional($tracerStudy->wirausaha)->bentuk_usaha) == 'CV' ? 'selected' : '' }}>CV</option>
                    <option value="Firma" {{ old('bentuk_usaha', optional($tracerStudy->wirausaha)->bentuk_usaha) == 'Firma' ? 'selected' : '' }}>Firma</option>
                    <option value="Perorangan" {{ old('bentuk_usaha', optional($tracerStudy->wirausaha)->bentuk_usaha) == 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                    <option value="Lainnya" {{ old('bentuk_usaha', optional($tracerStudy->wirausaha)->bentuk_usaha) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>                
            </div>
        
            {{-- NPWP Usaha --}}
            <div class="mb-4">
                <label for="npwp_usaha" class="block text-gray-700">NPWP Usaha</label>
                <input type="text" name="npwp_usaha" id="npwp_usaha" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('npwp_usaha', optional($tracerStudy->wirausaha)->npwp_usaha) }}">
            </div>
        </div>
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const statusSelect = document.getElementById('status_saat_ini');
                const posisiField = document.getElementById('posisi_wirausaha_field');
        
                function togglePosisiWirausaha() {
                    if (statusSelect.value === "Wiraswasta") {
                        posisiField.style.display = "block";
                    } else {
                        posisiField.style.display = "none";
                    }
                }
        
                togglePosisiWirausaha();
                statusSelect.addEventListener('change', togglePosisiWirausaha);
            });
        </script>        
        {{-- end --}}

        {{-- melanjutkan pendidikan --}}
        <div id="lanjut_pendidikan_field" style="{{ $tracerStudy->status_saat_ini === 'Melanjutkan Pendidikan' ? '' : 'display: none;' }}">
            <div class="mb-4">
                <label for="sumber_biaya_studi" class="block text-gray-700">Sumber Biaya Studi</label>
                <select name="sumber_biaya_studi" id="sumber_biaya_studi" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" disabled {{ is_null(optional($tracerStudy->pendidikanLanjut)->sumber_biaya_studi) ? 'selected' : '' }}>-- Pilih Sumber Biaya Studi --</option>
                    <option value="Biaya Sendiri" {{ optional($tracerStudy->pendidikanLanjut)->sumber_biaya_studi === 'Biaya Sendiri' ? 'selected' : '' }}>Biaya Sendiri</option>
                    <option value="Beasiswa" {{ optional($tracerStudy->pendidikanLanjut)->sumber_biaya_studi === 'Beasiswa' ? 'selected' : '' }}>Beasiswa</option>
                </select>
            </div>
        
            <div class="mb-4">
                <label for="universitas_lanjut" class="block text-gray-700">Universitas Lanjut</label>
                <input type="text" name="universitas_lanjut" id="universitas_lanjut" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('universitas_lanjut', optional($tracerStudy->pendidikanLanjut)->universitas_lanjut) }}">
            </div>
        
            <div class="mb-4">
                <label for="program_studi_lanjut" class="block text-gray-700">Program Studi Lanjut</label>
                <input type="text" name="program_studi_lanjut" id="program_studi_lanjut" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('program_studi_lanjut', optional($tracerStudy->pendidikanLanjut)->program_studi_lanjut) }}">
            </div>
        
            <div class="mb-4">
                <label for="tanggal_masuk_lanjut" class="block text-gray-700">Tanggal Masuk Lanjut</label>
                <input type="date" name="tanggal_masuk_lanjut" id="tanggal_masuk_lanjut" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('tanggal_masuk_lanjut', optional($tracerStudy->pendidikanLanjut)->tanggal_masuk_lanjut) }}">
            </div>
        
            <div class="mb-4">
                <label for="hubungan_studi_pekerjaan" class="block text-gray-700">Hubungan Studi Pekerjaan</label>
                <select name="hubungan_studi_pekerjaan" id="hubungan_studi_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" disabled {{ is_null(optional($tracerStudy->pendidikanLanjut)->hubungan_studi_pekerjaan) ? 'selected' : '' }}>-- Pilih Hubungan Studi Pekerjaan --</option>
                    @foreach (['Sangat Erat', 'Erat', 'Cukup Erat', 'Tidak Sama Sekali'] as $value)
                        <option value="{{ $value }}" {{ optional($tracerStudy->pendidikanLanjut)->hubungan_studi_pekerjaan === $value ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>        
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const statusSelect = document.getElementById('status_saat_ini');
                const lanjutField = document.getElementById('lanjut_pendidikan_field');
        
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
        
                toggleLanjutPendidikan();
                statusSelect.addEventListener('change', toggleLanjutPendidikan);
            });
        </script>
        {{-- end --}}
    
        {{-- belum bekerja --}}
        <div id="belum_bekerja_fields" style="{{ $tracerStudy->status_saat_ini === 'Belum bekerja' ? '' : 'display: none;' }}">
            <div class="mb-4">
                <label for="alasan_belum_bekerja" class="block font-semibold">Alasan Belum Bekerja:</label>
                <select name="alasan_belum_bekerja" id="alasan_belum_bekerja" class="w-full p-2 border rounded">
                    <option value="">Pilih Alasan</option>
                    @foreach (['Masih mencari pekerjaan yang sesuai', 'Tidak ada lowongan yang cocok', 'Masalah kesehatan', 'Lainnya'] as $value)
                        <option value="{{ $value }}" {{ old('alasan_belum_bekerja', optional($tracerStudy->belumBekerja)->alasan_belum_bekerja) == $value ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        
            <div id="alasan_lainnya_container" style="display: {{ optional($tracerStudy->belumBekerja)->alasan_belum_bekerja == 'Lainnya' ? 'block' : 'none' }};">
                <label for="alasan_lainnya" class="block font-semibold">Alasan Lainnya:</label>
                <input type="text" name="alasan_lainnya" id="alasan_lainnya" class="w-full p-2 border rounded"
                    value="{{ old('alasan_lainnya', optional($tracerStudy->belumBekerja)->alasan_lainnya) }}">
            </div>

            <div class="mb-4">
                <label for="kendala_mendapat_pekerjaan" class="block text-gray-700">Kendala Mendapat Pekerjaan</label>
                <select name="kendala_mendapat_pekerjaan" id="kendala_mendapat_pekerjaan" class="w-full p-2 border border-gray-300 rounded-lg">
                    @php
                        $options = ['Tidak Ada Lowongan yang Sesuai', 'Kurangnya Pengalaman Kerja', 'Persyaratan yang Tinggi', 'Lokasi yang Terbatas', 'Lainnya'];
                    @endphp
                    
                    @foreach ($options as $option)
                        <option value="{{ $option }}" {{ old('kendala_mendapat_pekerjaan', optional($tracerStudy->belumBekerja)->kendala_mendapat_pekerjaan) == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="mb-4" id="kendala_lainnya_field" style="display: {{ optional($tracerStudy->belumBekerja)->kendala_mendapat_pekerjaan == 'Lainnya' ? 'block' : 'none' }};">
                <label for="kendala_lainnya" class="block text-gray-700">Kendala Lainnya</label>
                <input type="text" name="kendala_lainnya" id="kendala_lainnya" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('kendala_lainnya', optional($tracerStudy->belumBekerja)->kendala_lainnya) }}">
            </div>
        
            <div class="mb-4">
                <label for="mengikuti_pelatihan" class="block text-gray-700">Pernah Mengikuti Pelatihan?</label>
                <select name="mengikuti_pelatihan" id="mengikuti_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="" {{ old('mengikuti_pelatihan', optional($tracerStudy->belumBekerja)->mengikuti_pelatihan) === null ? 'selected' : '' }}>-- Pilih --</option>
                    @foreach (['Ya', 'Tidak'] as $value)
                        <option value="{{ $value }}" {{ old('mengikuti_pelatihan', optional($tracerStudy->belumBekerja)->mengikuti_pelatihan) == $value ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>            
        
            <div id="pelatihan_fields" style="display: {{ optional($tracerStudy->belumBekerja)->mengikuti_pelatihan == 'Ya' ? 'block' : 'none' }};">
                <div class="mb-4">
                    <label for="nama_pelatihan" class="block text-gray-700">Nama Pelatihan</label>
                    <input type="text" name="nama_pelatihan" id="nama_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="{{ old('nama_pelatihan', optional($tracerStudy->belumBekerja)->nama_pelatihan) }}">
                </div>
                <div class="mb-4">
                    <label for="durasi_pelatihan" class="block text-gray-700">Durasi Pelatihan</label>
                    <input type="text" name="durasi_pelatihan" id="durasi_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="{{ old('durasi_pelatihan', optional($tracerStudy->belumBekerja)->durasi_pelatihan) }}">
                </div>
                <div class="mb-4">
                    <label for="sertifikasi_pelatihan" class="block text-gray-700">Sertifikasi Pelatihan</label>
                    <input type="text" name="sertifikasi_pelatihan" id="sertifikasi_pelatihan" class="w-full p-2 border border-gray-300 rounded-lg"
                        value="{{ old('sertifikasi_pelatihan', optional($tracerStudy->belumBekerja)->sertifikasi_pelatihan) }}">
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
                let alasanBelumBekerja = document.getElementById('alasan_belum_bekerja');
                let alasanLainnyaContainer = document.getElementById('alasan_lainnya_container');
        
                function toggleBelumBekerjaFields() {
                    belumBekerjaFields.style.display = statusSelect.value === 'Belum bekerja' ? 'block' : 'none';
                }
        
                function toggleJumlahLamaran() {
                    if (melamarPekerjaan) {
                        jumlahLamaranField.style.display = melamarPekerjaan.value === 'Ya' ? 'block' : 'none';
                    }
                }
        
                function toggleKendalaLainnya() {
                    if (kendalaPekerjaan) {
                        kendalaLainnyaField.style.display = kendalaPekerjaan.value === 'Lainnya' ? 'block' : 'none';
                    }
                }
        
                function togglePelatihanFields() {
                    if (mengikutiPelatihan) {
                        pelatihanFields.style.display = mengikutiPelatihan.value === 'Ya' ? 'block' : 'none';
                    }
                }
        
                function toggleAlasanLainnya() {
                    if (alasanBelumBekerja) {
                        alasanLainnyaContainer.style.display = alasanBelumBekerja.value === 'Lainnya' ? 'block' : 'none';
                    }
                }
        
                statusSelect.addEventListener('change', toggleBelumBekerjaFields);
                if (melamarPekerjaan) melamarPekerjaan.addEventListener('change', toggleJumlahLamaran);
                if (kendalaPekerjaan) kendalaPekerjaan.addEventListener('change', toggleKendalaLainnya);
                if (mengikutiPelatihan) mengikutiPelatihan.addEventListener('change', togglePelatihanFields);
                if (alasanBelumBekerja) alasanBelumBekerja.addEventListener('change', toggleAlasanLainnya);
        
                // Panggil fungsi toggle hanya jika field terkait tersedia
                toggleBelumBekerjaFields();
                toggleJumlahLamaran();
                toggleKendalaLainnya();
                togglePelatihanFields();
                toggleAlasanLainnya();
            });
        </script>
        
        {{-- end --}}
        
        {{-- mencari kerja --}}
        <div id="mencari_kerja_fields" style="display: {{ $tracerStudy->status_saat_ini == 'Mencari kerja' ? 'block' : 'none' }};">
            {{-- Aktif Mencari Kerja --}}
            <div class="mb-4">
                <label for="aktif_mencari_kerja" class="block text-gray-700 font-semibold">Apakah Anda aktif dalam mencari pekerjaan saat ini?</label>
                <select name="aktif_mencari_kerja" id="aktif_mencari_kerja" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya" {{ optional($tracerStudy->pencarianKerja)->aktif_mencari_kerja == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ optional($tracerStudy->pencarianKerja)->aktif_mencari_kerja == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        
            {{-- Melamar Pekerjaan --}}
            <div class="mb-4">
                <label for="melamar_pekerjaan" class="block text-gray-700 font-semibold">Pernah Melamar Pekerjaan (6 bulan terakhir)?</label>
                <select name="melamar_pekerjaan" id="melamar_pekerjaan_mk" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih --</option>
                    <option value="Ya" {{ optional($tracerStudy->pencarianKerja)->melamar_pekerjaan == 'Ya' ? 'selected' : '' }}>Ya</option>
                    <option value="Tidak" {{ optional($tracerStudy->pencarianKerja)->melamar_pekerjaan == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                </select>
            </div>
        
            {{-- Jumlah Lamaran (Muncul hanya jika melamar == "Ya") --}}
            <div class="mb-4" id="jumlah_lamaran_mk_field" style="{{ optional($tracerStudy->pencarianKerja)->melamar_pekerjaan == 'Ya' ? '' : 'display:none;' }}">
                <label for="jumlah_lamaran" class="block text-gray-700 font-semibold">Berapa banyak lamaran kerja yang sudah Anda kirimkan?</label>
                <input type="number" name="jumlah_lamaran" id="jumlah_lamaran" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('jumlah_lamaran', optional($tracerStudy->pencarianKerja)->jumlah_lamaran) }}">
            </div>
        
            {{-- Metode Mencari Kerja --}}
            <div class="mb-4">
                <label for="metode_cari_kerja" class="block text-gray-700 font-semibold">Apa saja metode yang Anda gunakan dalam mencari pekerjaan?</label>
                <input type="text" name="metode_cari_kerja" id="metode_cari_kerja" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('metode_cari_kerja', optional($tracerStudy->pencarianKerja)->metode_cari_kerja) }}">
            </div>
        
            {{-- Jumlah Wawancara --}}
            <div class="mb-4">
                <label for="jumlah_wawancara" class="block text-gray-700 font-semibold">Berapa kali Anda sudah mengikuti wawancara kerja?</label>
                <input type="number" name="jumlah_wawancara" id="jumlah_wawancara" class="w-full p-2 border border-gray-300 rounded-lg"
                    value="{{ old('jumlah_wawancara', optional($tracerStudy->pencarianKerja)->jumlah_wawancara) }}">
            </div>
        </div>        
        
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const statusSelect = document.getElementById('status_saat_ini');
                const mencariKerjaFields = document.getElementById('mencari_kerja_fields');
                const melamarPekerjaanSelect = document.getElementById('melamar_pekerjaan_mk');
                const jumlahLamaranField = document.getElementById('jumlah_lamaran_mk_field');
            
                function toggleMencariKerjaFields() {
                    mencariKerjaFields.style.display = (statusSelect.value === 'Mencari kerja') ? 'block' : 'none';
                    toggleJumlahLamaran();
                }
            
                function toggleJumlahLamaran() {
                    jumlahLamaranField.style.display = (melamarPekerjaanSelect.value === 'Ya') ? 'block' : 'none';
                }
            
                statusSelect.addEventListener('change', toggleMencariKerjaFields);
                melamarPekerjaanSelect.addEventListener('change', toggleJumlahLamaran);
            
                // Jalankan saat awal halaman dimuat
                toggleMencariKerjaFields();
            });
            </script>
            
        {{-- end --}}


        {{-- Submit --}}
        <div class="mb-6">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Update</button>
        </div>         
    </form>
</div>
@endsection
