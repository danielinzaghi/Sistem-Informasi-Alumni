<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index() {
        $users = User::all();
        $mahasiswas = Mahasiswa::with('alumni')
                    ->orderBy('angkatan', 'desc')
                    ->get(); // Tambahkan eager loading alumni
        
        return view('mahasiswa.index', compact('mahasiswas', 'users'));
    }
    

    public function create() {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', 'alumni');
        })->get();
        $prodis = ProgramStudi::all();
        return view('mahasiswa.create', compact('prodis', 'users'));
    }

    public function store(StoreMahasiswaRequest $request) {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();
            $mahasiswa = new Mahasiswa();
            $mahasiswa->users_id = $request->users_id;
            $mahasiswa->id_prodi = $request->id_prodi;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->no_hp = $request->no_hp;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->status = $request->status;
            $mahasiswa->save();
        });

        return redirect()->route('admin.mahasiswa.index')->with('success', 'mahasiswa berhasil dibuat.');
    }

    public function edit2(Mahasiswa $mahasiswa) {
        $users = User::all();
        $prodis = ProgramStudi::all();
        return view('mahasiswa.edit', compact('prodis', 'users', 'mahasiswa'));
    }

    public function update2(UpdateMahasiswaRequest $request , Mahasiswa $mahasiswa ) {
        DB::transaction(function () use ($request, $mahasiswa) {
            $validated = $request->validated();

            $mahasiswa->update($validated);
        });

        return redirect()->route('admin.mahasiswa.index')->with('success-edit', 'Data mahasiswa telah berhasil diperbarui.');

    }

    public function edit($id)
{
    $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
    return response()->json($mahasiswa);
}

public function update(Request $request, $id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->nim = $request->nim;
    $mahasiswa->no_hp = $request->no_hp;
    $mahasiswa->angkatan = $request->angkatan;
    $mahasiswa->save();

    $mahasiswa->user->name = $request->name;
    $mahasiswa->user->save();

    toast('Data berhasil disimpan!', 'success')->autoClose(2000);
    return redirect()->route('admin.mahasiswa.index');
}



public function destroy(Mahasiswa $mahasiswa)
{
    DB::beginTransaction();

    try {
        // Simpan user sebelum hapus mahasiswa
        $user = $mahasiswa->user;

        // Hapus mahasiswa
        $mahasiswa->delete();

        // Hapus user jika ada
        if ($user) {
            $user->delete();
        }

        DB::commit();
        return redirect()->route('admin.mahasiswa.index')->with('success-edit', 'Mahasiswa dan User berhasil dihapus.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->route('admin.mahasiswa.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}

}
