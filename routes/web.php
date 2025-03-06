<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProgramStudiController;


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
        return view('admindashboard');
    })->name('admin.dashboard');
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    Route::get('/admin/user/{id}', [UserController::class, 'getUser'])->name('admin.user.get');

    Route::resource('/admin/jurusan', JurusanController::class)->names('admin.jurusan');
    Route::get('/get-program-studi/{id}', [ProgramStudiController::class, 'getByJurusan']);

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
        return view('dashboard');
    })->name('alumni.dashboard');
    Route::patch('/alumni/{id}', [ProfileController::class, 'update'])->name('alumni.update');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dashboard');
    })->name('dosen.dashboard');
    Route::patch('/dosen/{id}', [ProfileController::class, 'updatedosen'])->name('dosen.update');

});


require __DIR__ . '/auth.php';
