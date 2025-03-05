<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CategoryController;

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

Route::get('/verify-email', [\App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/alumni/dashboard', function () {
        return view('alumni.dashboard');
    });
});




// route kategori article
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function() {
    Route::resource('category', CategoryController::class)->names([
        'index' => 'CategoryIndex',
        'create' => 'CategoryCreate',
        'store' => 'CategoryStore',
        'show' => 'Category.show',  
        'edit' => 'CategoryEdit',
        'update' => 'CategoryUpdate',
        'destroy' => 'CategoryDelete',
    ]);
    
});
require __DIR__ . '/auth.php';
