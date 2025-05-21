<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $jurusan = Jurusan::all();
        $dosens = Dosen::with('user')
                ->whereDoesntHave('programStudi')
                ->whereDoesntHave('jurusan')
                ->get();

        $dosenAll = Dosen::with('user')->get();
        // dd($dosens->first()->user->name);


        return view('jurusan.index', compact('jurusan', 'dosens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        $dosens = Dosen::with('user')->get();

        toast('Jurusan berhasil ditambah.', 'success')->autoClose(2000);
        return view('jurusan.create', compact('jurusan', 'dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jurusan' => 'required|string|max:255|unique:jurusan,nama_jurusan',
            'id_kajur' => 'nullable|exists:dosen,id',
        ]);


        Jurusan::create($validated);

        toast('Jurusan berhasil ditambah.', 'success')->autoClose(2000);
        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jurusan $jurusan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'id_kajur' => 'required',
        ]);

        // Cari jurusan berdasarkan ID
        $jurusan = Jurusan::findOrFail($id);

        // Update data jurusan
        $jurusan->update([
            'nama_jurusan' => $request->nama_jurusan,
            'id_kajur' => $request->id_kajur,
        ]);

        toast('Jurusan berhasil diperbarui.', 'success')->autoClose(2000);
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurusan $jurusan)
    {
        //
        // Cari jurusan berdasarkan ID
        // $jurusan = Jurusan::findOrFail($id);

        // Hapus jurusan
        $jurusan->delete();

        toast('Jurusan berhasil dihapus.', 'success')->autoClose(2000);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Jurusan berhasil dihapus.');
    }


    public function checkNamaJurusan(Request $request)
    {
        $nama = $request->query('nama_jurusan');

        $exists = Jurusan::where('nama_jurusan', $nama)->exists();

        return response()->json(['exists' => $exists]);
    }
}
