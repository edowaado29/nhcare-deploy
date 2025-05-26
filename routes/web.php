<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KedonaturanController;
use App\Http\Controllers\PengasuhController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\AnakasuhController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\SeleksiController;
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

// Route::get('/ex', function () {
//     return view('auth.mail-reset-password');
// });

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('isLoggedIn');

//Route Kedonaturan
Route::get('/kedonaturan', [KedonaturanController::class, 'kedonaturan'])->name('kedonaturan')->middleware('isLoggedIn');
Route::get('/detail_donatur/{id}', [KedonaturanController::class, 'detail_donatur'])->name('detail_donatur')->middleware('isLoggedIn');
Route::get('/tambah_donatur', [KedonaturanController::class, 'tambah_donatur'])->name('tambah_donatur')->middleware('isLoggedIn');
Route::post('/tambahDon', [KedonaturanController::class, 'tambahDon'])->name('tambahDon')->middleware('isLoggedIn');
Route::get('/edit_donatur/{id}', [KedonaturanController::class, 'edit_donatur'])->name('edit_donatur')->middleware('isLoggedIn');
Route::put('/update_donatur/{id}', [KedonaturanController::class, 'update_donatur'])->name('update_donatur')->middleware('isLoggedIn');
Route::delete('/hapus_donatur/{id}', [KedonaturanController::class, 'hapus_donatur'])->name('hapus_donatur')->middleware('isLoggedIn');

// Route Anak Asuh
Route::get('/anakasuh', [AnakasuhController::class, 'anakasuh'])->name('anakasuh')->middleware('isLoggedIn');
Route::get('/exportasi_anak', [AnakasuhController::class, 'exportasi_anak'])->name('exportasi_anak')->middleware('isLoggedIn');
Route::get('/detail_anakasuh/{id_anakasuh}', [AnakasuhController::class, 'detail_anakasuh'])->name('detail_anakasuh')->middleware('isLoggedIn');
Route::get('/tambah_anakasuh', [AnakasuhController::class, 'tambah_anakasuh'])->name('tambah_anakasuh')->middleware('isLoggedIn');
Route::post('/tambahAnk', [AnakasuhController::class, 'tambahAnk'])->name('tambahAnk')->middleware('isLoggedIn');
Route::delete('/hapus_anakasuh/{id_anakasuh}', [AnakasuhController::class, 'hapus_anakasuh'])->name('hapus_anakasuh')->middleware('isLoggedIn');
Route::get('/edit_anakasuh/{id_anakasuh}', [AnakasuhController::class, 'edit_anakasuh'])->name('edit_anakasuh')->middleware('isLoggedIn');
Route::put('/update_anakasuh/{id_anakasuh}', [AnakasuhController::class, 'update_anakasuh'])->name('update_anakasuh')->middleware('isLoggedIn');

// Route Donasi
Route::get('/donasi', [DonasiController::class, 'donasi'])->name('donasi')->middleware('isLoggedIn');
Route::get('/detail_donasi/{id}', [DonasiController::class, 'detail_donasi'])->name('detail_donasi')->middleware('isLoggedIn');

Route::get('/seleksi', [SeleksiController::class, 'seleksi'])->name('seleksi')->middleware('isLoggedIn');
Route::post('/seleksiAnakasuh', [SeleksiController::class, 'seleksiAnakasuh'])->name('seleksiAnakasuh')->middleware('isLoggedIn');
Route::get('/hasilSeleksi', [SeleksiController::class, 'hasilSeleksi'])->name('hasilSeleksi')->middleware('isLoggedIn');

//Route Jabatan
Route::get('/jabatan', [JabatanController::class, 'jabatan'])->name('jabatan')->middleware('isLoggedIn');
Route::get('/tambah_jabatan', [JabatanController::class, 'tambah_jabatan'])->name('tambah_jabatan')->middleware('isLoggedIn');
Route::post('/tambahJabat', [JabatanController::class, 'tambahJabat'])->name('tambahJabat')->middleware('isLoggedIn');
Route::get('/edit_jabatan/{id}', [JabatanController::class, 'edit_jabatan'])->name('edit_jabatan')->middleware('isLoggedIn');
Route::put('/update_jabatan/{id}', [JabatanController::class, 'update_jabatan'])->name('update_jabatan')->middleware('isLoggedIn');
Route::delete('/hapus_jabatan/{id}', [JabatanController::class, 'hapus_jabatan'])->name('hapus_jabatan')->middleware('isLoggedIn');

//route pengasuh
Route::get('/pengasuh', [PengasuhController::class, 'pengasuh'])->name('pengasuh')->middleware('isLoggedIn');
Route::get('/detail_pengasuh/{id}', [PengasuhController::class, 'detail_pengasuh'])->name('detail_pengasuh')->middleware('isLoggedIn');
Route::get('/tambah_pengasuh', [PengasuhController::class, 'tambah_pengasuh'])->name('tambah_pengasuh')->middleware('isLoggedIn');
Route::post('/tambahPeng', [PengasuhController::class, 'tambahPeng'])->name('tambahPeng')->middleware('isLoggedIn');
Route::get('/edit_pengasuh/{id}', [PengasuhController::class, 'edit_pengasuh'])->name('edit_pengasuh')->middleware('isLoggedIn');
Route::put('/update_pengasuh/{id}', [PengasuhController::class, 'update_pengasuh'])->name('update_pengasuh')->middleware('isLoggedIn');
Route::delete('/hapus_pengasuh/{id}', [PengasuhController::class, 'hapus_pengasuh'])->name('hapus_pengasuh')->middleware('isLoggedIn');

//route acara
Route::get('/acara', [AcaraController::class, 'acara'])->name('acara')->middleware('isLoggedIn');
Route::get('/detail_acara/{id}', [AcaraController::class, 'detail_acara'])->name('detail_acara')->middleware('isLoggedIn');
Route::get('/tambah_acara', [AcaraController::class, 'tambah_acara'])->name('tambah_acara')->middleware('isLoggedIn');
Route::post('/tambahAcr', [AcaraController::class, 'tambahAcr'])->name('tambahAcr')->middleware('isLoggedIn');
Route::get('/edit_acara/{id}', [AcaraController::class, 'edit_acara'])->name('edit_acara')->middleware('isLoggedIn');
Route::put('/updateAcr/{id}', [AcaraController::class, 'updateAcr'])->name('updateAcr')->middleware('isLoggedIn');
Route::delete('/hapus_acara/{id}', [AcaraController::class, 'hapus_acara'])->name('hapus_acara')->middleware('isLoggedIn');

//route artikel
Route::get('/artikel', [ArtikelController::class, 'artikel'])->name('artikel')->middleware('isLoggedIn');
Route::get('/detail_artikel/{id}', [ArtikelController::class, 'detail_artikel'])->name('detail_artikel')->middleware('isLoggedIn');
Route::get('/tambah_artikel', [ArtikelController::class, 'tambah_artikel'])->name('tambah_artikel')->middleware('isLoggedIn');
Route::post('/tambah_artkl', [ArtikelController::class, 'tambah_artkl'])->name('tambah_artkl')->middleware('isLoggedIn');
Route::get('/edit_artikel/{id}', [ArtikelController::class, 'edit_artikel'])->name('edit_artikel')->middleware('isLoggedIn');
Route::put('/update_artikel/{id}', [ArtikelController::class, 'update_artikel'])->name('update_artikel')->middleware('isLoggedIn');
Route::delete('/hapus_artikel/{id}', [ArtikelController::class, 'hapus_artikel'])->name('hapus_artikel')->middleware('isLoggedIn');

//route program
Route::get('/program', [ProgramController::class, 'program'])->name('program')->middleware('isLoggedIn');
Route::get('/detail_program/{id}', [ProgramController::class, 'detail_program'])->name('detail_program')->middleware('isLoggedIn');
Route::get('/tambah_program', [ProgramController::class, 'tambah_program'])->name('tambah_program')->middleware('isLoggedIn');
Route::post('/tambah', [ProgramController::class, 'tambah'])->name('tambah')->middleware('isLoggedIn');
Route::get('/edit_program/{id}', [ProgramController::class, 'edit_program'])->name('edit_program')->middleware('isLoggedIn');
Route::put('/update/{id}', [ProgramController::class, 'update'])->name('update')->middleware('isLoggedIn');
Route::delete('/hapus_program/{id}', [ProgramController::class, 'hapus_program'])->name('hapus_program')->middleware('isLoggedIn');

// route profile
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware('isLoggedIn');
Route::put('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile')->middleware('isLoggedIn');
Route::put('/uploadImg', [ProfileController::class, 'uploadImg'])->name('uploadImg')->middleware('isLoggedIn');
Route::put('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword')->middleware('isLoggedIn');

// route auth
Route::controller(AuthController::class)->group(function(){
    Route::get('/', 'index')->middleware('alreadyLoggedIn');
    Route::get('/login','login')->name('login')->middleware('alreadyLoggedIn');
    Route::get('/forgot_password','forgot_password')->name('forgot_password')->middleware('alreadyLoggedIn');
    Route::post('/forgot_password_act','forgot_password_act')->name('forgot_password_act')->middleware('alreadyLoggedIn');
    Route::get('/validasi_forgot_password/{token}','validasi_forgot_password')->name('validasi_forgot_password')->middleware('alreadyLoggedIn');
    Route::post('/validasi_forgot_password_act','validasi_forgot_password_act')->name('validasi_forgot_password_act')->middleware('alreadyLoggedIn');
    Route::post('/loginUser','loginUser')->name('loginUser');
    Route::get('/logout','logout');
});