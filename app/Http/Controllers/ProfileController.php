<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Alumni;
use App\Models\Mahasiswa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

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

    // public function updateAlumni(Request $request): RedirectResponse
    // {
    //     $user = $request->user();

    //     if (!$user->hasRole('alumni')) {
    //         return Redirect::route('profile.edit')->with('error', 'Anda bukan alumni.');
    //     }

    //     $request->validate([
    //         'tahun_lulus' => 'nullable|integer',
    //         'pekerjaan' => 'nullable|string|max:255',
    //         'instansi' => 'nullable|string|max:255',
    //         'npwp' => 'nullable|string|max:20',
    //         'nik' => 'nullable|string|max:16',
    //     ]);

    //     $alumni = Mahasiswa::firstOrNew(['mahasiswa_id' => $user->id]);

    //     $alumni->tahun_lulus = $request->input('tahun_lulus', $alumni->tahun_lulus);
    //     $alumni->pekerjaan = $request->input('pekerjaan', $alumni->pekerjaan);
    //     $alumni->instansi = $request->input('instansi', $alumni->instansi);
    //     $alumni->npwp = $request->input('npwp', $alumni->npwp);
    //     $alumni->nik = $request->input('nik', $alumni->nik);
    //     $alumni->users_id = $user->id;

    //     $alumni->save();

    //     return Redirect::route('profile.edit')->with('status', 'alumni-profile-updated');
    // }

    public function updatedosen(Request $request, $id)
    {
        // Ambil dosen dengan ID yang diberikan
        $dosen = Dosen::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nidn' => [
                'required',
                'string',
                'max:255',
                Rule::unique('dosen', 'nidn')->ignore($dosen->id),
            ],
        ]);

        // Update user terkait jika ada
        if ($dosen->user) {
            $userUpdateResult = $dosen->user->update([
                'name' => $validated['name'],
            ]);
        }

        // Update dosen dengan query builder
        $updateResult = DB::table('dosen')
            ->where('id', $dosen->id)
            ->update([
                'nama' => $validated['name'],
                'nidn' => $validated['nidn']
            ]);

        if ($updateResult) {
            return redirect()->route('profile.edit')->with('status', 'profile-updated');
        } else {
            return back()->withErrors(['update' => 'Gagal menyimpan data dosen'])->withInput();
        }
    }
}

    // /**
    //  * Delete the user's account.
    //  */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
