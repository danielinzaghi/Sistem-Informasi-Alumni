<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getByJurusan($jurusan_id)
    {
        $programStudi = ProgramStudi::with('kaprodi.user')
                        ->where('jurusan_id', $jurusan_id)->get();

        return response()->json($programStudi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            ProgramStudi::create([
                'nama_prodi' => $request->nama_prodi,
                'id_kaprodi' => $request->id_kaprodi,
                'jurusan_id' => $request->jurusan_id
            ]);

            toast('Berhasil menambahkan data program studi', 'success');
            return redirect()->route('admin.jurusan.index');
        } catch (\Exception $e) {
            Alert('Error', $e->getMessage(), 'error');
            return redirect()->route('admin.jurusan.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programStudi = ProgramStudi::find($id);
        // dd($request->all(), $programStudi);
        DB::beginTransaction(); 
        try {
            $programStudi->update([
                'nama_prodi' => $request->nama_prodi,
                'id_kaprodi' => $request->kaprodi
            ]);
            DB::commit();
            // Simpan ID jurusan dari prodi yang diedit
            session()->flash('jurusan_id', $programStudi->jurusan_id);

            toast('Berhasil mengubah data program studi', 'success');
            return redirect()->route('admin.jurusan.index');
        } catch (\Exception $e) {
            DB::rollback();
            Alert('Error', $e->getMessage(), 'error');
            return redirect()->route('admin.jurusan.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programStudi = ProgramStudi::find($id);
        // dd($programStudi);
        try {
            $programStudi->delete();

            toast('Berhasil menghapus data program studi', 'success');
            return redirect()->route('admin.jurusan.index');
        } catch (\Exception $e) {
            Alert('Error', $e->getMessage(), 'error');
            return redirect()->route('admin.jurusan.index');
        }
    }
}
