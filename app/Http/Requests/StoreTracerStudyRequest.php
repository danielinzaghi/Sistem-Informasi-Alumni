<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTracerStudyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('alumni');
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'alumni_id' => 'required|exists:alumni,id',
            'status_saat_ini' => 'required|string|max:255',
            'waktu_dapat_kerja' => 'nullable|integer',
            'gaji_bulanan' => 'nullable|integer',
            'lokasi_provinsi' => 'nullable|string|max:255',
            'lokasi_kota' => 'nullable|string|max:255',
            'jenis_perusahaan' => 'nullable|string|max:255',
            'jenis_perusahaan_lainnya' => 'nullable|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'posisi_wirausaha' => 'nullable|string|max:255',
            'tingkat_perusahaan' => 'nullable|string|max:255',
            'sumber_biaya_studi' => 'nullable|string|max:255',
            'universitas_lanjut' => 'nullable|string|max:255',
            'program_studi_lanjut' => 'nullable|string|max:255',
            'tanggal_masuk_lanjut' => 'nullable|date',
            'hubungan_studi_pekerjaan' => 'nullable|string|max:255',
            'tingkat_pendidikan_pekerjaan' => 'nullable|string|max:255',
            'metode_cari_kerja' => 'nullable|string|max:255',
            'jumlah_lamaran' => 'nullable|integer',
            'jumlah_wawancara' => 'nullable|integer',
            'alasan_ambil_pekerjaan' => 'nullable|string|max:255',
            'melamar_pekerjaan' => 'nullable|in:Ya,Tidak',
            'alasan_belum_bekerja' => 'nullable|in:Masih mencari pekerjaan yang sesuai,Melanjutkan pendidikan,Tidak ada lowongan yang cocok,Masalah kesehatan,Lainnya',
            'alasan_lainnya' => 'nullable|string|max:255',
            'kendala_mendapat_pekerjaan' => 'nullable|in:Tidak Ada Lowongan yang Sesuai,Kurangnya Pengalaman Kerja,Persyaratan yang Tinggi,Lokasi yang Terbatas,Lainnya',
            'kendala_lainnya' => 'nullable|string|max:255',
            'bekerja_di_luar_bidang' => 'nullable|in:Ya,Tidak',
            'aktif_mencari_kerja' => 'nullable|in:Ya,Tidak',
            'mengikuti_pelatihan' => 'nullable|in:Ya,Tidak',
            'nama_pelatihan' => 'nullable|string|max:255',
            'durasi_pelatihan' => 'nullable|string|max:255',
            'sertifikasi_pelatihan' => 'nullable|string|max:255',
        ];
    }
}
