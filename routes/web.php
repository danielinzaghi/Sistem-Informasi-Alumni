<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;

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

require __DIR__.'/auth.php';
