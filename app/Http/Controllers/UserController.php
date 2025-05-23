<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\TracerStudy;
use Illuminate\Support\Facades\DB;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with('roles', 'mahasiswa', 'dosen', 'alumni')
        ->latest()
        ->where('id', '!=', Auth::id())
        // ->orderBy('name', 'asc')
        ->get()
        ->sortBy(function ($user) {
            return $user->name ?? '';
        })
        ->sortBy(function ($user) {
            return $user->roles->first()->name ?? '';
        });

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
        // dd($request->prodi);
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
                    'id_prodi' => $request->prodi,
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
        $user->load('roles');
        return response()->json($user);
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

            if($user->roles->first()->name = 'mahasiswa' || $user->roles->first()->name = 'alumni'){
                $user->mahasiswa->update([
                    'no_hp' => $request->no_hp
                ]);
            }
 
            DB::commit();
        
            // Alert::success('Success Title', 'Success Message')->autoClose(2000);
            toast('Pengguna berhasil diubah', 'success')->autoClose(2000);
            return redirect()->route('admin.user.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert('Error', $e->getMessage(), 'error');
            return redirect()->route('admin.user.index');
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
            return redirect()->route('admin.user.index');
        } catch (\Exception $e) {
            toast($e->getMessage(), 'error')->autoClose(2000);
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
