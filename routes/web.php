<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\FrontArticleController;
use App\Http\Controllers\FrontCategoryController;


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\TracerStudyController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/artikel', [LandingPageController::class, 'berita'])->name('berita');
Route::get('/p/{slug}', [FrontArticleController::class, 'show']);
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::get('/category/{slug}', [FrontCategoryController::class, 'index']);
Route::get('/artikel/search', [LandingPageController::class, 'berita'])->name('search');





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

Route::get('/verify-email', [\App\Http\Controllers\Auth\EmailVerificationPromptController::class, '__invoke']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/user', UserController::class)->names('admin.user');
    // Route::get('/admin/user/{id}', [UserController::class, 'getUser'])->name('admin.user.get');

    Route::resource('admin/broadcast', BroadcastController::class)->names('admin.broadcast');
    Route::get('admin/broadcast/create', [BroadcastController::class, 'create'])->name('admin.broadcast.create');
    Route::post('admin/broadcast/send', [BroadcastController::class, 'sendMessage'])->name('admin.broadcast.send');
    Route::resource('admin/tracer-study', TracerStudyController::class)->names('admin.tracer_study');
    Route::get('admin/tracer-study/{id}/export/pdf', [TracerStudyController::class, 'exportPdf'])->name('admin.tracer-study.export.pdf');
    Route::resource('/admin/jurusan', JurusanController::class)->names('admin.jurusan');
    Route::resource('/admin/prodi', ProgramStudiController::class)->names('admin.prodi');
    Route::get('/get-program-studi/{id}', [ProgramStudiController::class, 'getByJurusan']);

    // Route::get('/admin/dosen', function() {
    //     return view('dosen.index');
    // })->name('admin.dosen');

    Route::resource('/admin/dosen', DosenController::class)->names('admin.dosen');

    Route::resource('/admin/mahasiswa', MahasiswaController::class)->names('admin.mahasiswa');
    // Route::get('/admin/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
    // Route::put('/admin/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
    
    Route::get('/check-jurusan', [JurusanController::class, 'checkNamaJurusan'])->name('check.jurusan');

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
    Route::resource('category', CategoryController::class)->names([
        'index' => 'CategoryIndex',
        'create' => 'CategoryCreate',
        'store' => 'CategoryStore',
        'show' => 'Category.show',
        'edit' => 'CategoryEdit',
        'update' => 'CategoryUpdate',
        'destroy' => 'CategoryDelete',
    ]);
    Route::resource('article', ArticleController::class)->names('admin.article');
});

// Route untuk Alumni
Route::middleware(['auth', 'role:alumni'])->group(function () {
    Route::patch('/alumni/{id}', [ProfileController::class, 'update'])->name('alumni.update');    
    Route::get('/alumni/dashboard', [DashboardController::class, 'index'])->name('alumni.dashboard');

    // Route::resource('tracer_study', TracerStudyController::class);
});
Route::resource('/alumni/tracer-study', TracerStudyController::class)->names('alumni.tracer_study');
Route::resource('/alumni/article', ArticleController::class)->names('alumni.article');

// Route untuk Dosen
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardController::class, 'index'])->name('dosen.dashboard');
    Route::patch('/dosen/{id}', [ProfileController::class, 'updatedosen'])->name('dosen.update');
    Route::resource('/dosen/article', ArticleController::class)->names('dosen.article');
    Route::resource('/dosen/tracer-study', TracerStudyController::class)->names('dosen.tracer_study');
    Route::get('/dosen/tracer-study/{id}/export/pdf', [TracerStudyController::class, 'exportPdf'])->name('dosen.tracer-study.export.pdf');
});

// route kategori article
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {

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
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
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

require __DIR__ . '/auth.php';
