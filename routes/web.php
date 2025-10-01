<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data_pendaftaranController;
use App\Http\Controllers\Cari_pendaftaranController;
use App\Http\Controllers\Data_priodeController;
use App\Http\Controllers\Data_konsentrasi_keahlianController;
use App\Http\Controllers\Data_asal_sekolahController;
use App\Http\Controllers\Data_ukuran_seragamController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\TesMinatBakatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/form_pendaftaran', [PendaftaranController::class, 'form_pendaftaran']);
Route::get('/get_asal_sekolah', [PendaftaranController::class, 'getAsalSekolah']);
Route::post('/proses_pendaftaran', [PendaftaranController::class, 'proses_pendaftaran']);
Route::get('/bukti_pendaftaran/{id}', [PendaftaranController::class, 'bukti_pendaftaran'])->name('bukti_pendaftaran');

Route::get('/cari_pendaftaran', [Cari_pendaftaranController::class, 'index']);
Route::post('/proses_cari_pendaftaran', [Cari_pendaftaranController::class, 'proses_cari_pendaftaran']);
Route::get('/scan/{code}', [Cari_pendaftaranController::class, 'scan']);
Route::get('/isi_ukuran_seragam/{code}', [Cari_pendaftaranController::class, 'isi_ukuran_seragam']);
Route::post('/proses_isi_ukuran_seragam_{id}', [Cari_pendaftaranController::class, 'proses_isi_ukuran_seragam']);

Route::get('/data_pendaftaran', [Data_pendaftaranController::class, 'index'])->name('data_pendaftaran');
Route::get('/data_pendaftaran/tambah', [Data_pendaftaranController::class, 'form_tambah_pendaftaran']);
Route::post('/data_pendaftaran/proses', [Data_pendaftaranController::class, 'proses_pendaftaran_admin']);
Route::get('/data_pendaftaran/edit/{id}', [Data_pendaftaranController::class, 'form_edit_pendaftaran_admin']);
Route::put('/data_pendaftaran/update/{id}', [Data_pendaftaranController::class, 'update_pendaftaran_admin']);
Route::get('/data_pendaftaran/cetak/{id}', [Data_pendaftaranController::class, 'cetak_pendaftaran']);
Route::get('/data_pendaftaran/hapus/{id}', [Data_pendaftaranController::class, 'hapus']);
Route::get('/data_pendaftaran/download', [Data_pendaftaranController::class, 'download']);

Route::get('/data_priode', [Data_priodeController::class, 'index']);
Route::get('/databases/tambah_periode', [Data_priodeController::class, 'form_tambah_periode']);
Route::post('/databases/proses_tambah_periode', [Data_priodeController::class, 'proses_tambah_periode']);
Route::get('/databases/edit_periode/{id}', [Data_priodeController::class, 'view_edit_periode']);
Route::put('/databases/update_periode/{id}', [Data_priodeController::class, 'update_priode']);
Route::get('/databases/hapus_periode/{id}', [Data_priodeController::class, 'hapus_periode']);

Route::get('/data_konsentrasi_keahlian', [Data_konsentrasi_keahlianController::class, 'index']);
Route::get('/databases/form_tambah_konsentrasi_keahlian', [Data_konsentrasi_keahlianController::class, 'form_tambah_konsentrasi_keahlian']);
Route::post('/databases/proses_tambah_konsentrasi_keahlian', [Data_konsentrasi_keahlianController::class, 'proses_tambah_konsentrasi_keahlian']);
Route::get('/databases/edit_konsentrasi_keahlian/{id}', [Data_konsentrasi_keahlianController::class, 'form_edit_konsentrasi_keahlian']);
Route::put('/databases/update_konsentrasi_keahlian/{id}', [Data_konsentrasi_keahlianController::class, 'update_konsentrasi_keahlian']);
Route::get('/databases/hapus_konsentrasi_keahlian/{id}', [Data_konsentrasi_keahlianController::class, 'hapus_konsentrasi_keahlian']);

Route::get('/data_asal_sekolah', [Data_asal_sekolahController::class, 'index'])->name('data_asal_sekolah.index');
Route::get('/databases/form_tambah_asal_sekolah', [Data_asal_sekolahController::class, 'form_tambah_asal_sekolah']);
Route::post('/databases/proses_tambah_asal_sekolah', [Data_asal_sekolahController::class, 'proses_tambah_asal_sekolah']);
Route::get('/databases/edit_asal_sekolah/{id}', [Data_asal_sekolahController::class, 'form_edit_asal_sekolah']);
Route::put('/databases/update_asal_sekolah/{id}', [Data_asal_sekolahController::class, 'update_asal_sekolah']);
Route::get('/databases/hapus_asal_sekolah/{id}', [Data_asal_sekolahController::class, 'hapus_asal_sekolah']);

Route::get('/data_ukuran_seragam', [Data_ukuran_seragamController::class, 'index']);
Route::get('/data_ukuran_seragam/download', [Data_ukuran_seragamController::class, 'download']);
Route::get('/databases/form_tambah_ukuran_seragam/{code}', [Data_ukuran_seragamController::class, 'form_tambah_ukuran_seragam']);
Route::get('/databases/edit_ukuran_seragam/{id}', [Data_ukuran_seragamController::class, 'form_edit_ukuran_seragam']);
Route::put('/databases/update_ukuran_seragam/{id}', [Data_ukuran_seragamController::class, 'update_ukuran_seragam']);
Route::get('/databases/hapus_ukuran_seragam/{id}', [Data_ukuran_seragamController::class, 'hapus_ukuran_seragam']);

Route::get('/tes_minat_bakat', [TesMinatBakatController::class, 'index']);
