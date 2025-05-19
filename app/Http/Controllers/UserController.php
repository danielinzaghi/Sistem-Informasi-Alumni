<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\TracerStudy;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $role = Role::all();
        $prodi = ProgramStudi::all();
        // dd($role);

        return view('users.index', compact('user', 'role', 'prodi'));
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
        //dd($request);
        try {
            $validated = $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email',
                'role'      => 'required|in:admin,mahasiswa,dosen,alumni',
                'password'  => 'nullable|string|min:6',
            ]);

            // Default password jika tidak diisi
            $password = $request->input('password') ?? 'password123';

            // Buat user
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => bcrypt($password),
            ]);

            $user->assignRole($validated['role']);

            // Tambahan berdasarkan role
            if ($validated['role'] === 'mahasiswa' || $validated['role'] === 'alumni') {
                $mahasiswa = $user->mahasiswa()->create([
                    'prodi_id' => $request->prodi,
                    'nim'      => $request->nim,
                    'angkatan' => $request->angkatan,
                    'no_hp'    => $request->no_hp,
                    'status'   => $validated['role'] === 'alumni' ? 'lulus' : $request->status,
                ]);

                // Jika role adalah alumni, buat data alumni terpisah
                if ($validated['role'] === 'alumni') {
                    $alumni = $mahasiswa->alumni()->create([
                        'tahun_lulus' => $request->tahun_lulus,
                        'pekerjaan'   => $request->pekerjaan,
                        'instansi'    => $request->instansi,
                        'npwp'        => $request->npwp,
                        'nik'         => $request->nik,
                    ]);
                    
                    $tracerStudy = new TracerStudy();
                    $tracerStudy->alumni_id = $alumni->id; // Simpan ID alumni
                    $tracerStudy->save();
                }
            } elseif ($validated['role'] === 'dosen') {
                $user->dosen()->create([
                    'nidn' => $request->nidn,
                ]);
            }

            toast('Pengguna berhasil dibuat', 'success')->autoClose(2000);
            return redirect()->route('admin.user.index');
        } catch (\Exception $e) {
            alert('Error', $e->getMessage(), 'error');
            return redirect()->back()->withErrors('User gagal dibuat : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::with('mahasiswa', 'dosen', 'alumni')->findOrFail($id);
        // $roles = Role::all();
        // $user->role = $user->roles->first()->name ?? null; // Ambil nama role pertama
        $user->load('roles');
        // $dosen = $user->dosen;
        // $mahasiswa = $user->mahasiswa;
        return response()->json($user);
        // return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email',
            // 'role' => 'required|exists:roles,id',
        ]);
    
        DB::beginTransaction();
        try {
            // $user = User::findOrFail();
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
 
            DB::commit();
        
            // Alert::success('Success Title', 'Success Message')->autoClose(2000);
            toast('Pengguna berhasil diubah', 'success')->autoClose(2000);
            return redirect()->route('admin.user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert('Error', $e->getMessage(), 'error');
            return redirect()->back()->withErrors('User gagal diperbarui : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            toast('Berhasil menghapus user!', 'success')->autoClose(2000);
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            toast('Gagal menghapus user!', 'error')->autoClose(2000);
            return back();
        }
    }

    // public function getUser($id)
    // {
    //     $user = User::with('roles')->findOrFail($id);

    //     return response()->json([
    //         'id' => $user->id,
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'role_id' => optional($user->roles->first())->id, // Ambil ID role pertama (jika ada)
    //     ]);
    // }

}
