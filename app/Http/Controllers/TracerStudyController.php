<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTracerStudyRequest;
use App\Http\Requests\UpdateTracerStudyRequest;
use App\Models\Alumni;
use App\Models\TracerStudy;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracerStudyController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tracerStudies = TracerStudy::with('alumni.mahasiswa.user')
            ->whereHas('alumni.mahasiswa.user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->get();

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
            $tracerStudy = new TracerStudy();
            $tracerStudy->alumni_id = $request->alumni_id;
            $tracerStudy->status_saat_ini = $request->status_saat_ini;
            $tracerStudy->waktu_dapat_kerja = $request->waktu_dapat_kerja;
            $tracerStudy->gaji_bulanan = $request->gaji_bulanan;
            $tracerStudy->lokasi_provinsi = $request->lokasi_provinsi;
            $tracerStudy->lokasi_kota = $request->lokasi_kota;
            $tracerStudy->jenis_perusahaan = $request->jenis_perusahaan;
            $tracerStudy->jenis_perusahaan_lainnya = $request->jenis_perusahaan_lainnya;
            $tracerStudy->nama_perusahaan = $request->nama_perusahaan;
            $tracerStudy->posisi_wirausaha = $request->posisi_wirausaha;
            $tracerStudy->tingkat_perusahaan = $request->tingkat_perusahaan;
            $tracerStudy->sumber_biaya_studi = $request->sumber_biaya_studi;
            $tracerStudy->universitas_lanjut = $request->universitas_lanjut;
            $tracerStudy->program_studi_lanjut = $request->program_studi_lanjut;
            $tracerStudy->tanggal_masuk_lanjut = $request->tanggal_masuk_lanjut;
            $tracerStudy->hubungan_studi_pekerjaan = $request->hubungan_studi_pekerjaan;
            $tracerStudy->tingkat_pendidikan_pekerjaan = $request->tingkat_pendidikan_pekerjaan;
            $tracerStudy->metode_cari_kerja = $request->metode_cari_kerja;
            $tracerStudy->jumlah_lamaran = $request->jumlah_lamaran;
            $tracerStudy->jumlah_wawancara = $request->jumlah_wawancara;
            $tracerStudy->alasan_ambil_pekerjaan = $request->alasan_ambil_pekerjaan;
            $tracerStudy->melamar_pekerjaan = $request->melamar_pekerjaan;
            $tracerStudy->alasan_belum_bekerja = $request->alasan_belum_bekerja;
            $tracerStudy->alasan_lainnya = $request->alasan_lainnya;
            $tracerStudy->kendala_mendapat_pekerjaan = $request->kendala_mendapat_pekerjaan;
            $tracerStudy->kendala_lainnya = $request->kendala_lainnya;
            $tracerStudy->bekerja_di_luar_bidang = $request->bekerja_di_luar_bidang;
            $tracerStudy->aktif_mencari_kerja = $request->aktif_mencari_kerja;
            $tracerStudy->mengikuti_pelatihan = $request->mengikuti_pelatihan;
            $tracerStudy->nama_pelatihan = $request->nama_pelatihan;
            $tracerStudy->durasi_pelatihan = $request->durasi_pelatihan;
            $tracerStudy->sertifikasi_pelatihan = $request->sertifikasi_pelatihan;
            $tracerStudy->save();
        });

        return redirect()->route('tracer_study.index')->with('success', 'tracer study berhasil dibuat.');
        
    }

    public function show(TracerStudy $tracerStudy)
    {
        $tracerStudy->load('alumni.mahasiswa.user');
        return view('tracer_study.show', compact('tracerStudy'));
    }
    

    public function edit(TracerStudy $tracerStudy) {
        $alumnis = Alumni::all();
        return view('tracer_study.edit', compact('tracerStudy', 'alumnis'));
    }


    public function update(UpdateTracerStudyRequest $request, TracerStudy $tracerStudy)
    {
        DB::transaction(function () use ($request, $tracerStudy) {
            $validated = $request->validated();

            $tracerStudy->update($validated);
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
