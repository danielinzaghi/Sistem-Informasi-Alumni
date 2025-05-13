<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
                'name'=> 'required|string|max:255',
                'email'=> 'required|email|unique:users,email',
                'role_id' => 'required|exists:roles,id',
            ]);

        //Buat User Baru

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt('password123'),
            ]);

            $user->assignRole(Role::find($validated['role_id'])->name);

            return redirect()->route('admin.user.index')->with('success', 'user berhasil dibuat');

        } catch (\Exception $e) {
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
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
