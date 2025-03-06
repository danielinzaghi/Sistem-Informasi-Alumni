<?php

namespace App\Http\Controllers;

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
        $user = User::with('roles')->get(); // Pastikan user mengambil data role
        $role = Role::all(); // Amb
        

        if ($role->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada role yang tersedia.');
        }

        return view('users.index', compact('user', 'role'));
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
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);
    
        // $user = User::findOrFail();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Update role
        $role = Role::findOrFail($request->role_id);
        $user->syncRoles([$role->name]);
    
        return redirect()->route('admin.user.index')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // dd($user);

        $user->delete();
    
        return response()->json(['success' => 'User berhasil dihapus!']);
    }

    public function getUser($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role_id' => optional($user->roles->first())->id, // Ambil ID role pertama (jika ada)
        ]);
    }

}
