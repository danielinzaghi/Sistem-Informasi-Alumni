<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\FrontArticleController;
use App\Http\Controllers\FrontCategoryController;


use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/artikel', [LandingPageController::class, 'berita'])->name('berita');
Route::get('/p/{slug}', [FrontArticleController::class, 'show']);
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::get('/category/{slug}', [FrontCategoryController::class, 'index']);
Route::get('/artikel/search', [LandingPageController::class, 'berita'])->name('search');





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
        return view('dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/user', function() {
        return view('users.index');
    })->name('admin.user');
});

Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::get('/alumni/dashboard', function () {
        return view('dashboard');
    })->name('alumni.dashboard');
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

// route article
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function() {
    Route::resource('article', ArticleController::class)->names([
        'index' => 'ArticleIndex',
        'create' => 'ArticleCreate',
        'store' => 'ArticleStore',
        'show' => 'ArticleShow',  
        'edit' => 'ArticleEdit',
        'update' => 'ArticleUpdate',
        'destroy' => 'ArticleDelete',
    ]);
});


    
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
    })->name('dosen.dashboard');
});
require __DIR__ . '/auth.php';
