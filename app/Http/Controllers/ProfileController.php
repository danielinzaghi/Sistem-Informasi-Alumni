<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $role = $user->roles->first()->name; // Ambil role pertama
        $dosen = Dosen::where('users_id', $user->id)->first();
        $alumni = Alumni::where('mahasiswa_id', $user->id)->first();
        return view('profile.edit', compact('user', 'role', 'dosen', 'alumni'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Update data users (only username and email)
        $user->fill($request->only(['name', 'email']));

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // If user has alumni role, check if alumni data exists
        if ($user->hasRole('alumni')) {
            $alumni = Mahasiswa::firstOrNew(['mahasiswa_id' => $user->id]);

            // Update only if there's new input, otherwise keep existing data
            $alumni->tahun_lulus = $request->filled('tahun_lulus')
                ? $request->tahun_lulus
                : $alumni->tahun_lulus;

            $alumni->pekerjaan = $request->filled('pekerjaan')
                ? $request->pekerjaan
                : $alumni->pekerjaan;

            $alumni->instansi = $request->filled('instansi')
                ? $request->instansi
                : $alumni->instansi;

            $alumni->npwp = $request->filled('npwp')
                ? $request->npwp
                : $alumni->npwp;

            $alumni->nik = $request->filled('nik')
                ? $request->nik
                : $alumni->nik;

            // Ensure users_id is set
            $alumni->users_id = $user->id;

            $alumni->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updatedosen(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tahun_lulus' => 'required|integer',
            'pekerjaan' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'npwp' => 'required|string|max:20',
        ]);

        $alumni->update($validated);

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
