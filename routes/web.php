<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TracerStudyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function () {
    return view('broadcast');
});

// Route::get('/broadcast', [BroadcastController::class, 'showForm'])->name('broadcast.form');
Route::post('/broadcast', [BroadcastController::class, 'handleForm'])->name('broadcast.handle');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    // Route::get('/admin/user/{id}', [UserController::class, 'getUser'])->name('admin.user.get');

    Route::resource('admin/broadcast', BroadcastController::class)->names('admin.broadcast');
    Route::get('admin/broadcast/create', [BroadcastController::class, 'create'])->name('admin.broadcast.create');
    Route::post('admin/broadcast/send', [BroadcastController::class, 'sendMessage'])->name('admin.broadcast.send');
    
    Route::resource('/admin/jurusan', JurusanController::class)->names('admin.jurusan');
    Route::get('/get-program-studi/{id}', [ProgramStudiController::class, 'getByJurusan']);

    // Route::get('/admin/dosen', function() {
    //     return view('dosen.index');
    // })->name('admin.dosen');

    Route::resource('/admin/dosen', DosenController::class)->names('admin.dosen');

    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');
    Route::resource('/admin/alumni', AlumniController::class)->names('admin.alumni');

    // Route::get('/admin/mahasiswa', function() {
    //     return view('mahasiswa.index');
    // })->name('admin.mahasiswa');
    // Route::get('/admin/alumni', function() {
    //     return view('alumni.index');
    // })->name('admin.alumni');
    // Route::get('/admin/broadcast', function() {
        
    //     return view('broadcast.index');
    // })->name('admin.broadcast');
});

// Route untuk Alumni
Route::middleware(['auth', 'role:alumni'])->group(function () {
    // Route::get('/alumni/dashboard', function () {
    //     return view('dashboard');
    // })->name('alumni.dashboard');
    // Route::get('/alumni/dashboard', [DashboardController::class, 'index'])->name('alumni.dashboard');

    // Route::resource('tracer_study', TracerStudyController::class);
});
Route::resource('/tracer-study', TracerStudyController::class)->names('tracer_study');

// Route untuk Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    // Route::get('/dosen/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');
    Route::patch('/dosen/{id}', [ProfileController::class, 'update'])->name('dosen.update');
    // Route::resource('/admin/dosen', DosenController::class)->names('admin.dosen');

});



require __DIR__ . '/auth.php';
