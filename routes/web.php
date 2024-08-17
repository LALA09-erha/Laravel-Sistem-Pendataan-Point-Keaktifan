<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeaktifanMahasiswaController;
use App\Http\Controllers\KedudukanController;
use App\Http\Controllers\KegiatanController;


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
// Auth routes

// View login page
Route::get('/login', [AuthController::class, 'index'])->name('login');

// process login
Route::post('/prosesLogin', [AuthController::class, 'proseslogin']);

// logout
Route::post('/logout', [AuthController::class, 'destroy']);


// Homepages routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// view jenis kedudukan
Route::get('/kedudukan', [KedudukanController::class, 'index'])->name('jenis-kedudukan');

// proses tambah jenis kedudukan
Route::post('/tambahkedudukan', [KedudukanController::class, 'store'])->name('tambah-kedudukan');

// proses edit jenis kedudukan
Route::post('/editkedudukan', [KedudukanController::class, 'update'])->name('edit-kedudukan');

// proses hapus jenis kedudukan
Route::post('/deletekedudukan', [KedudukanController::class, 'destroy'])->name('hapus-kedudukan');

// view jenis kegiatan
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('jenis-kegiatan');

// proses tambah jenis kegiatan
Route::post('/tambahkegiatan', [KegiatanController::class, 'store'])->name('tambah-kegiatan');

// proses edit jenis kegiatan
Route::post('/editkegiatan', [KegiatanController::class, 'update'])->name('edit-kegiatan');

// proses hapus jenis kegiatan
Route::post('/deletekegiatan', [KegiatanController::class, 'destroy'])->name('hapus-kegiatan');

// view keaktifan mahasiswa
Route::get('/keaktifanmahasiswa', [KeaktifanMahasiswaController::class, 'index'])->name('keaktifan-mahasiswa');

// detail keaktifan mahasiswa
Route::get('/keaktifanmahasiswa/detail/{id}', [KeaktifanMahasiswaController::class, 'show'])->name('detail-keaktifan-mahasiswa');

// edit detail keaktifan mahasiswa
Route::post('/editdetailkeaktifan', [KeaktifanMahasiswaController::class, 'edit'])->name('edit-keaktifan-mahasiswa');

// view validasi keaktifan mahasiswa
Route::get('/validasidatakeaktifan', [KeaktifanMahasiswaController::class, 'validasi'])->name('validasi-keaktifan-mahasiswa');

// view transkippointkeaktifan mahasiswa
Route::get('/transkippointkeaktifan', [KeaktifanMahasiswaController::class, 'transkippoint'])->name('transkip-point-keaktifan');

// download file keaktifan mahasiswa
Route::post('/downloadtranskippointkeaktifan', [KeaktifanMahasiswaController::class, 'download'])->name('download-file');

// view uploaddatakeaktifan
Route::get('/uploaddatakeaktifan', [KeaktifanMahasiswaController::class, 'upload'])->name('upload-data-keaktifan');

// proses upload data keaktifan
Route::post('/uploadpoint', [KeaktifanMahasiswaController::class, 'store'])->name('upload-data-keaktifan');

// melihat file upload
Route::get('/filekegiatan/{file}', [KeaktifanMahasiswaController::class, 'showfile'])->name('file-upload');
