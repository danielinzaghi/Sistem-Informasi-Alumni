<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();

        $userDosen = User::whereHas('roles', function ($query) {
            $query->where('name', 'dosen'); //FIlter hanya user dengan role "dosen"
        })->get();

        return view('dosen.index', compact('dosen', 'userDosen'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        // dd($request);
        $user = User::find($dosen->user_id);
        try {
            $user->update([
                'name' => $request->name,
                // 'email' => $request->email,
            ]);
            $dosen->update([
                'nidn' => $request->nidn,
            ]);

            toast('Data berhasil diubah!', 'success')->autoClose(2000);
            return redirect()->route('admin.dosen.index');
        } catch (\Exception $e) {
            Alert('Error','Terjadi kesalahan saat mengedit data!', 'error')->autoClose(2000);
            return redirect()->route('admin.dosen.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $user = User::where('id', $dosen->user_id)->first();
        $dosen->delete();
        $user->delete();
    
        toast('Dosen berhasil dihapus!', 'success')->autoClose(2000);
        return redirect()->route('admin.dosen.index');
    }
}
