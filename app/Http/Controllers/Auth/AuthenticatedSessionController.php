<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
        public function store(LoginRequest $request): RedirectResponse
        {
            $request->authenticate();

            $request->session()->regenerate();
            // Ambil role pertama dari user
            $role = Auth::user()->roles->first()->name; 

            // Pastikan role tidak null agar tidak error
            if ($role) {
                return redirect()->intended(route($role . '.dashboard'));
            }

            // Jika role tidak ditemukan, fallback ke halaman default
            return redirect()->route('dashboard'); // Ganti dengan halaman default jika perlu
        }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
