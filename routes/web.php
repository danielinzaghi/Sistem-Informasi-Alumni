<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TracerStudyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    Route::get('/admin/jurusan', function() {
        return view('jurusan.index');
    })->name('admin.jurusan');
    Route::get('/admin/dosen', function() {
        return view('dosen.index');
    })->name('admin.dosen');
    Route::get('/admin/mahasiswa', function() {
        return view('mahasiswa.index');
    })->name('admin.mahasiswa');
    Route::get('/admin/alumni', function() {
        return view('alumni.index');
    })->name('admin.alumni');
    Route::get('/admin/broadcast', function() {
        return view('broadcast.index');
    })->name('admin.broadcast');
});

Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/alumni/dashboard', function () {
        return view('alumni.dashboard');
    });
    Route::resource('tracer_study', TracerStudyController::class);     
        return view('dashboard');
    })->name('alumni.dashboard');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dashboard');
    })->name('dosen.dashboard');
});


require __DIR__ . '/auth.php';
