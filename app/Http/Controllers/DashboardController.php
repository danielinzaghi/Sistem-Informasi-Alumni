<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alumni;
use App\Models\Dosen;
use App\Models\TracerStudy;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(Auth::user());
        $userCount = User::count();
        $alumniCount = Alumni::count();
        $dosenCount = Dosen::count();

        $alumniSudahBekerjaCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where('status_saat_ini', 'Bekerja')
                ->whereHas('bekerja');
        })->count();

        $alumniBelumBekerjaCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where('status_saat_ini', 'Belum bekerja')
                ->whereHas('belumBekerja');
        })->count();

        $alumniWiraswastaCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where('status_saat_ini', 'Wiraswasta')
                ->whereHas('wirausaha');
        })->count();

        $alumniMelanjutkanPendidikanCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where('status_saat_ini', 'Melanjutkan Pendidikan')
                ->whereHas('pendidikanLanjut');
        })->count();

        $alumniMencariKerjaCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where('status_saat_ini', 'Mencari kerja')
                ->whereHas('pencarianKerja');
        })->count();

        // Total alumni dengan data tracer lengkap sesuai status
        $alumniLengkapCount = Alumni::whereHas('tracerStudy', function ($query) {
            $query->where(function ($q) {
                $q->where('status_saat_ini', 'Bekerja')->whereHas('bekerja')
                ->orWhere(function ($q) {
                    $q->where('status_saat_ini', 'Wiraswasta')->whereHas('wirausaha');
                })
                ->orWhere(function ($q) {
                    $q->where('status_saat_ini', 'Melanjutkan Pendidikan')->whereHas('pendidikanLanjut');
                })
                ->orWhere(function ($q) {
                    $q->where('status_saat_ini', 'Mencari kerja')->whereHas('pencarianKerja');
                })
                ->orWhere(function ($q) {
                    $q->where('status_saat_ini', 'Belum bekerja')->whereHas('belumBekerja');
                });
            });
        })->count();
        $alumniCount = Alumni::all()->count();

        // dd($alumniCount);

        return view('dashboard', [
            'userCount' => $userCount,
            'alumniCount' => $alumniCount,
            'dosenCount' => $dosenCount,
            'alumniSudahBekerjaCount' => $alumniSudahBekerjaCount,
            'alumniBelumBekerjaCount' => $alumniBelumBekerjaCount,
            'alumniWiraswastaCount' => $alumniWiraswastaCount,
            'alumniMelanjutkanPendidikanCount' => $alumniMelanjutkanPendidikanCount,
            'alumniMencariKerjaCount' => $alumniMencariKerjaCount,
            'alumniLengkapCount' => $alumniLengkapCount,
            'alumniCount' => $alumniCount
        ]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
