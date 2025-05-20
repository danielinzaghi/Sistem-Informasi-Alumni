<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTracerStudyRequest;
use App\Http\Requests\UpdateTracerStudyRequest;
use App\Models\Alumni;
use App\Models\Bekerja;
use App\Models\BelumBekerja;
use App\Models\PencarianKerja;
use App\Models\PendidikanLanjut;
use App\Models\TracerStudy;
use App\Models\Wirausaha;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerStudyController extends Controller
{
   public function index()
{
    $user = Auth::user();

    // Jika user punya role admin atau dosen
    if ($user->hasRole('admin') || $user->hasRole('dosen')) {
        // Tampilkan semua data tracer study
        $tracerStudies = TracerStudy::with('alumni.mahasiswa.user')->get();
    } else {
        // Untuk alumni, hanya tampilkan data miliknya
        $tracerStudies = TracerStudy::with('alumni.mahasiswa.user')
            ->whereHas('alumni.mahasiswa.user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->get();
    }

    return view('tracer_study.index', compact('tracerStudies'));
}


    public function create()
    {
        $user = Auth::user();

        // Ambil data alumni yang hanya milik user yang sedang login
        $loggedInAlumni = Alumni::whereHas('mahasiswa.user', function ($query) use ($user) {
            $query->where('id', $user->id);
        })->first();

        return view('tracer_study.create', compact('loggedInAlumni'));
    }
    public function store(StoreTracerStudyRequest $request) {

        DB::transaction(function () use ($request) {
            $validated = $request->validated();
           // Simpan status utama ke tracer_study
        $tracerStudy = TracerStudy::create([
            'alumni_id' => $request->alumni_id,
            'status_saat_ini' => $request->status_saat_ini
        ]);

        // Simpan data tambahan berdasarkan status alumni
        if ($request->status_saat_ini == 'Bekerja') {
            Bekerja::create([
                'tracer_study_id' => $tracerStudy->id,
                'waktu_dapat_kerja' => $request->waktu_dapat_kerja,
                'gaji_bulanan' => $request->gaji_bulanan,
                'lokasi_provinsi' => $request->lokasi_provinsi,
                'lokasi_kota' => $request->lokasi_kota,
                'jenis_perusahaan' => $request->jenis_perusahaan,
                'nama_perusahaan' => $request->nama_perusahaan,
                'tingkat_perusahaan' => $request->tingkat_perusahaan,
                'tingkat_pendidikan_pekerjaan' => $request->tingkat_pendidikan_pekerjaan,
                'alasan_ambil_pekerjaan' => $request->alasan_ambil_pekerjaan,
                'bekerja_di_luar_bidang' => $request->bekerja_di_luar_bidang
            ]);
        }

        if ($request->status_saat_ini == 'Wiraswasta') {
            Wirausaha::create([
                'tracer_study_id' => $tracerStudy->id,
                'posisi_wirausaha' => $request->posisi_wirausaha,
                'nama_usaha' => $request->nama_usaha,
                'bidang_usaha' => $request->bidang_usaha,
                'tahun_berdiri' => $request->tahun_berdiri,
                'jumlah_karyawan' => $request->jumlah_karyawan,
                'posisi_wirausaha' => $request->posisi_wirausaha,
                'omzet_per_bulan' => $request->omzet_per_bulan,
                'bentuk_usaha' => $request->bentuk_usaha,
                'npwp_usaha' => $request->npwp_usaha,
            ]);
        }

        if ($request->status_saat_ini == 'Melanjutkan Pendidikan') {
            PendidikanLanjut::create([
                'tracer_study_id' => $tracerStudy->id,
                'sumber_biaya_studi' => $request->sumber_biaya_studi,
                'universitas_lanjut' => $request->universitas_lanjut,
                'program_studi_lanjut' => $request->program_studi_lanjut,
                'tanggal_masuk_lanjut' => $request->tanggal_masuk_lanjut,
                'hubungan_studi_pekerjaan' => $request->hubungan_studi_pekerjaan
            ]);
        }

        if ($request->status_saat_ini == 'Mencari kerja') {
            PencarianKerja::create([
                'tracer_study_id' => $tracerStudy->id,
                'melamar_pekerjaan' => $request->melamar_pekerjaan,
                'metode_cari_kerja' => $request->metode_cari_kerja,
                'jumlah_lamaran' => $request->jumlah_lamaran,
                'jumlah_wawancara' => $request->jumlah_wawancara,
                'aktif_mencari_kerja' => $request->aktif_mencari_kerja
            ]);
        }

        if ($request->status_saat_ini == 'Belum bekerja') {
            BelumBekerja::create([
                'tracer_study_id' => $tracerStudy->id,
                'alasan_belum_bekerja' => $request->alasan_belum_bekerja,
                'alasan_lainnya' => $request->alasan_lainnya,
                'kendala_mendapat_pekerjaan' => $request->kendala_mendapat_pekerjaan,
                'kendala_lainnya' => $request->kendala_lainnya,
                'mengikuti_pelatihan' => $request->mengikuti_pelatihan,
                'nama_pelatihan' => $request->nama_pelatihan,
                'durasi_pelatihan' => $request->durasi_pelatihan,
                'sertifikasi_pelatihan' => $request->sertifikasi_pelatihan,
            ]);
        }
    });

        return redirect()->route('tracer_study.index')->with('success', 'tracer study berhasil dibuat.');
        
    }

    public function show(TracerStudy $tracerStudy)
    {
        $tracerStudy->load([
            'alumni.mahasiswa.user',
            'bekerja',
            'wirausaha',
            'pendidikanLanjut',
            'pencarianKerja',
            'belumBekerja',
        ]);
        return view('tracer_study.show', compact('tracerStudy'));
    }
    

    public function edit(TracerStudy $tracerStudy) {
        $alumnis = Alumni::all();
        $tracerStudy->load([
            'bekerja',
            'wirausaha',
            'pendidikanLanjut',
            'pencarianKerja',
            'belumBekerja',
        ]);
        return view('tracer_study.edit', compact('tracerStudy', 'alumnis'));
    }


    public function update(UpdateTracerStudyRequest $request, TracerStudy $tracerStudy)
    {
        DB::transaction(function () use ($request, $tracerStudy) {
            $validated = $request->validated();
    
            // Update tracer_study utama
            $tracerStudy->update([
                'status_saat_ini' => $request->status_saat_ini
            ]);
    
            // Hapus data terkait lama (optional tapi direkomendasikan)
            $tracerStudy->bekerja()?->delete();
            $tracerStudy->wirausaha()?->delete();
            $tracerStudy->pendidikanLanjut()?->delete();
            $tracerStudy->pencarianKerja()?->delete();
            $tracerStudy->belumBekerja()?->delete();
    
            // Simpan ulang sesuai status
            if ($request->status_saat_ini == 'Bekerja') {
                $tracerStudy->bekerja()->create([
                    'waktu_dapat_kerja' => $request->waktu_dapat_kerja,
                    'gaji_bulanan' => $request->gaji_bulanan,
                    'lokasi_provinsi' => $request->lokasi_provinsi,
                    'lokasi_kota' => $request->lokasi_kota,
                    'jenis_perusahaan' => $request->jenis_perusahaan,
                    'nama_perusahaan' => $request->nama_perusahaan,
                    'tingkat_perusahaan' => $request->tingkat_perusahaan,
                    'tingkat_pendidikan_pekerjaan' => $request->tingkat_pendidikan_pekerjaan,
                    'alasan_ambil_pekerjaan' => $request->alasan_ambil_pekerjaan,
                    'bekerja_di_luar_bidang' => $request->bekerja_di_luar_bidang
                ]);
            }
    
            if ($request->status_saat_ini == 'Wiraswasta') {
                $tracerStudy->wirausaha()->create([
                    'posisi_wirausaha' => $request->posisi_wirausaha,
                    'nama_usaha' => $request->nama_usaha,
                    'bidang_usaha' => $request->bidang_usaha,
                    'tahun_berdiri' => $request->tahun_berdiri,
                    'jumlah_karyawan' => $request->jumlah_karyawan,
                    'omzet_per_bulan' => $request->omzet_per_bulan,
                    'bentuk_usaha' => $request->bentuk_usaha,
                    'npwp_usaha' => $request->npwp_usaha,
                ]);
            }
    
            if ($request->status_saat_ini == 'Melanjutkan Pendidikan') {
                $tracerStudy->pendidikanLanjut()->create([
                    'sumber_biaya_studi' => $request->sumber_biaya_studi,
                    'universitas_lanjut' => $request->universitas_lanjut,
                    'program_studi_lanjut' => $request->program_studi_lanjut,
                    'tanggal_masuk_lanjut' => $request->tanggal_masuk_lanjut,
                    'hubungan_studi_pekerjaan' => $request->hubungan_studi_pekerjaan
                ]);
            }
    
            if ($request->status_saat_ini == 'Mencari kerja') {
                $tracerStudy->pencarianKerja()->create([
                    'melamar_pekerjaan' => $request->melamar_pekerjaan,
                    'metode_cari_kerja' => $request->metode_cari_kerja,
                    'jumlah_lamaran' => $request->jumlah_lamaran,
                    'jumlah_wawancara' => $request->jumlah_wawancara,
                    'aktif_mencari_kerja' => $request->aktif_mencari_kerja
                ]);
            }
    
            if ($request->status_saat_ini == 'Belum bekerja') {
                $tracerStudy->belumBekerja()->create([
                    'alasan_belum_bekerja' => $request->alasan_belum_bekerja,
                    'alasan_lainnya' => $request->alasan_lainnya,
                    'kendala_mendapat_pekerjaan' => $request->kendala_mendapat_pekerjaan,
                    'kendala_lainnya' => $request->kendala_lainnya,
                    'mengikuti_pelatihan' => $request->mengikuti_pelatihan,
                    'nama_pelatihan' => $request->nama_pelatihan,
                    'durasi_pelatihan' => $request->durasi_pelatihan,
                    'sertifikasi_pelatihan' => $request->sertifikasi_pelatihan,
                ]);
            }
        });
    
        return redirect()->route('tracer_study.index')->with('success-edit', 'Data tracer study anda berhasil diperbarui.');
    }
    
    

    public function destroy(TracerStudy $tracerStudy)
    {
        DB::beginTransaction();

        try{
            $tracerStudy->delete();
            DB::commit();
            return redirect()->route('tracer_study.index');
        }
        catch (\Exception $e){
            DB::rollBack();
            return redirect()->route('tracer_study.index');
        }
    }
}
