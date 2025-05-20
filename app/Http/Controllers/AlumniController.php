<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlumniRequest;
use App\Http\Requests\UpdateAlumniRequest;
use App\Models\Alumni;
use App\Models\Mahasiswa;
use App\Models\TracerStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{

    public function index()
    {
        $alumnis1 = Alumni::whereHas('mahasiswa.user', function ($query) {
            $query->where('id', Auth::user()->id);
        })->get();

        $alumnis = Alumni::all();

        // dd($alumnis);
        
        return view('alumni.index', compact('alumnis'));
        
    }    

    public function create(Request $request)
    {
        $mahasiswaId = $request->query('mahasiswaId'); // Mengambil mahasiswaId dari query string
        $mahasiswas = Mahasiswa::with('user')->findOrFail($mahasiswaId); // Mencari mahasiswa dan relasi user
        return view('alumni.create', compact('mahasiswas'));
    }

    public function store(StoreAlumniRequest $request) {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $alumni = new Alumni();
            $alumni->mahasiswa_id = $request->mahasiswa_id;
            $alumni->tahun_lulus = $request->tahun_lulus;
            $alumni->pekerjaan = $request->pekerjaan;
            $alumni->instansi = $request->instansi;
            $alumni->npwp = $request->npwp;
            $alumni->nik = $request->nik;
            $alumni->save();

             // Simpan data ke tabel Tracer Study dengan alumni_id
            $tracerStudy = new TracerStudy();
            $tracerStudy->alumni_id = $alumni->id; // Simpan ID alumni
            $tracerStudy->save();
        });

        

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dibuat.');
    }

    public function edit($id)
    {
        $alumni = Alumni::with('mahasiswa.user')->findOrFail($id); // Mencari data alumni beserta relasi mahasiswa dan user
        return view('alumni.edit', compact('alumni'));
    }

    public function update(UpdateAlumniRequest $request, $id)
    {
        $alumni = Alumni::findOrFail($id);
        DB::transaction(function () use ($request, $alumni) {
            $validated = $request->validated();

            $alumni->update($validated);
        });
        return redirect()->route('admin.alumni.index')->with('success-edit', 'Data alumni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        $alumni = Alumni::findOrFail($id); // Ambil data berdasarkan id
        try {
            $alumni->delete(); // Hapus data
            DB::commit();
            return redirect()->route('admin.alumni.index')->with('success-delete', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.alumni.index')->with('error', 'Gagal menghapus data');
        }
    }


    
}
