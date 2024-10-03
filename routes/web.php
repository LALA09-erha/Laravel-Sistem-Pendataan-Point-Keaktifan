<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KeaktifanMahasiswaController;
use App\Http\Controllers\KedudukanController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubkategoriController;

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

// View register page
Route::get('/register', [AuthController::class, 'register'])->name('register');

// process register
Route::post('/prosesregist', [AuthController::class, 'store']);

// proses edit-profile
Route::post('/edit-profile', [AuthController::class, 'edit']);

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

// view kategori
Route::get('/kategori ', [SubkategoriController::class, 'index'])->name('kategorimahasiswa');

//proses tambah kategori
Route::post('/tambahsubkategori', [SubkategoriController::class, 'store'])->name('tambah-kategori');

//edit sub kategori
Route::post('/editsubkategori', [SubkategoriController::class, 'edit'])->name('edit-kategori');

// hapus sub kategori
Route::post('/deletesubkategori', [SubkategoriController::class, 'destroy'])->name('hapus-kategori');

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

// validasi keaktifan mahasiswa
Route::get('/keaktifanmahasiswa/validasi/{id}', [KeaktifanMahasiswaController::class, 'acc_validasi'])->name('validasi-keaktifan-mahasiswa');

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

// view profilttd
Route::get('/data-dosen', [KeaktifanMahasiswaController::class, 'datadosen'])->name('profil');

// add dosen
Route::post('/adddosen', [KeaktifanMahasiswaController::class, 'add_dosen'])->name('add-dosen');

// delete dosen
Route::post('/deletedosen', [KeaktifanMahasiswaController::class, 'delete_dosen'])->name('delete-dosen');

// proses edit profil ttd
Route::post('/editdosen', [KeaktifanMahasiswaController::class, 'editdosen'])->name('edit-profil-ttd');
