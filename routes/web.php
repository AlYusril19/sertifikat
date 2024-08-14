<?php

use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\FileDokumenController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PublicPesertaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin/dashboard', [App\Http\Controllers\BerandaAdminController::class, 'index'])->name('admin.dashboard');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

// Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    // Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.dasboard');
    Route::get('/admin/dashboard', [BerandaAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pesertas/index', [PesertaController::class, 'index'])->name('pesertas.index');
    Route::delete('admin/pesertas/{id}', [PesertaController::class, 'destroy'])->name('pesertas.destroy');
    Route::get('/admin/pesertas/create', [PesertaController::class, 'create'])->name('pesertas.create');
    Route::get('/admin/pesertas/{id}', [PesertaController::class, 'show'])->name('pesertas.show');
    Route::get('/admin/pesertas/{id}/edit', [PesertaController::class, 'edit'])->name('pesertas.edit');
    Route::put('/admin/pesertas/{id}/edit', [PesertaController::class, 'update'])->name('pesertas.update');
    Route::post('/admin/pesertas', [PesertaController::class, 'store'])->name('pesertas.store');
    Route::get('/admin/upload-sertifikat', [FileDokumenController::class, 'create'])->name('file_dokumen.create');
    Route::post('/admin/upload-sertifikat', [FileDokumenController::class, 'store'])->name('file_dokumen.store');
    Route::get('/admin/list-sertifikat', [FileDokumenController::class, 'index'])->name('file_dokumen.index');
    Route::get('/admin/sertifikats/{id}/edit', [FileDokumenController::class, 'edit'])->name('file_dokumen.edit');
    Route::put('/admin/sertifikats/{id}', [FileDokumenController::class, 'update'])->name('file_dokumen.update');
    Route::delete('/admin/sertifikats/{id}', [FileDokumenController::class, 'destroy'])->name('file_dokumen.destroy');
});

Route::get('/peserta/{id}', [PublicPesertaController::class, 'show'])->name('public.pesertas.show');
Route::get('/peserta/{id}/download', [PublicPesertaController::class, 'download'])->name('public.pesertas.download');

// Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');