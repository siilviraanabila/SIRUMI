<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\ControllerPegawai;
use App\Http\Controllers\ControllerAdmin;
use App\Http\Controllers\ControllerUmum;
use App\Http\Controllers\CalendarController;

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
Route::get('/home', function () {
    return redirect('/admin'); 
}); 

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
    Route::get('/dashboard', [SesiController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [SesiController::class, 'admin']);
    Route::get('/admin/dashboard', [ControllerAdmin::class, 'dashboardAdmin'])->name('dashboard')->middleware('userAkses:admin');
    Route::get('/admin/registerPegawai', [ControllerAdmin::class, 'getRegisterPegawai'])->name('getRegisterPegawai')->middleware('userAkses:admin');
    Route::post('/admin/registerPegawai', [ControllerAdmin::class, 'registerPegawai'])->name('registerPegawai')->middleware('userAkses:admin');
    Route::get('/admin/importPegawai', [ControllerAdmin::class, 'getImportPegawai'])->name('getImportPegawai')->middleware('userAkses:admin');
    Route::post('/admin/importPegawai', [ControllerAdmin::class, 'importPegawai'])->name('importPegawai')->middleware('userAkses:admin');
    Route::get('/admin/importPegawai/download-template', [ControllerAdmin::class, 'downloadTemplate'])->name('downloadTemplate')->middleware('userAkses:admin');
    Route::get('/admin/daftarPegawai', [ControllerAdmin::class, 'getPegawai'])->name('getDaftarPegawai')->middleware('userAkses:admin');
    Route::get('/admin/editPegawai/{nip}', [ControllerAdmin::class, 'editPegawai'])->name('editPegawai')->middleware('userAkses:admin');
    Route::put('/admin/updatePegawai/{nip}', [ControllerAdmin::class, 'updatePegawai'])->name('updatePegawai')->middleware('userAkses:admin');
    Route::delete('/admin/deletePegawai/{nip}', [ControllerAdmin::class, 'deletePegawai'])->name('deleteDataPegawai')->middleware('userAkses:admin');
    Route::get('admin/FullCalendar', [ControllerAdmin::class, 'getEvent'])->name('geteventAdmin')->middleware('userAkses:admin');

    // Route::get('/home', [ControllerPeminjaman::class, 'dashboard'])->name('dashboard_pengguna');
    Route::match(['get', 'post'], '/logout', [SesiController::class, 'logout'])->name('logout');
    Route::post('/storePeminjaman', [ControllerPegawai::class, 'storePeminjaman'])->name('storePeminjaman')->middleware('userAkses:pegawai');
    Route::get('pegawai/formPeminjaman', [ControllerPegawai::class, 'formPeminjamanView'])->name('formPeminjaman')->middleware('userAkses:pegawai');
    Route::get('/get-ruangan-gedung', [ControllerPegawai::class, 'getRuanganGedung'])->middleware('userAkses:pegawai,umum');
    Route::get('pegawai/ruangan', [ControllerPegawai::class, 'ruangan'])->name('ruangan')->middleware('userAkses:pegawai');
    Route::get('pegawai/ruangan/search', [ControllerPegawai::class, 'search'])->name('search')->middleware('userAkses:pegawai');
    Route::get('/pegawai/dashboard', [ControllerPegawai::class, 'dashboardPegawai'])->name('dashboardPegawai')->middleware('userAkses:pegawai');
    Route::get('pegawai/dataPeminjaman', [ControllerPegawai::class, 'getDataPeminjaman'])->name('getDataPeminjaman')->middleware('userAkses:pegawai');
    Route::get('pegawai/showdataPeminjaman/{id}', [ControllerPegawai::class, 'showdataPeminjaman'])->name('showdataPeminjaman')->middleware('userAkses:pegawai');
    Route::get('pegawai/editdataPeminjaman/{id}', [ControllerPegawai::class, 'editdataPeminjaman'])->name('editdataPeminjaman')->middleware('userAkses:pegawai');
    Route::delete('/pegawai/deletePeminjaman/{id}', [ControllerPegawai::class, 'deletePeminjaman'])->name('deletePeminjaman')->middleware('userAkses:pegawai');
    Route::put('/pegawai/updatePeminjaman/{id}', [ControllerPegawai::class, 'updatePeminjaman'])->name('updatePeminjaman')->middleware('userAkses:pegawai');
    Route::get('pegawai/FullCalendar', [ControllerPegawai::class, 'getEvent'])->name('geteventPegawai')->middleware('userAkses:pegawai');

    Route::get('umum/dashboardUmum', [ControllerUmum::class, 'dashboardUmum'])->name('dashboardUmum')->middleware('userAkses:umum');
    Route::get('umum/tambahFasilitas', [ControllerUmum::class, 'tambahFasilitasView'])->name('tambahFasilitas')->middleware('userAkses:umum');
    Route::get('umum/dataPeminjamanUmum', [ControllerUmum::class, 'getDataPeminjamanUmum'])->name('getDataPeminjamanUmum')->middleware('userAkses:umum');
    Route::get('umum/showdataPeminjamanUmum/{id}', [ControllerUmum::class, 'showdataPeminjamanUmum'])->name('showdataPeminjamanUmum')->middleware('userAkses:umum');
    Route::get('umum/editdataPeminjamanUmum/{id}', [ControllerUmum::class, 'editdataPeminjamanUmum'])->name('editdataPeminjamanUmum')->middleware('userAkses:umum');
    Route::put('umum/updatedataPeminjamanUmum/{id}', [ControllerUmum::class, 'updatedataPeminjamanUmum'])->name('updatedataPeminjamanUmum')->middleware('userAkses:umum');
    Route::delete('/umum/deletePeminjamanUmum/{id}', [ControllerUmum::class, 'deletePeminjamanUmum'])->name('deletePeminjamanUmum')->middleware('userAkses:umum');
    Route::post('/storePeminjamanUmum', [ControllerUmum::class, 'storePeminjamanUmum'])->name('storePeminjamanUmum')->middleware('userAkses:umum');
    Route::get('umum/formPeminjamanUmum', [ControllerUmum::class, 'formPeminjamanUmum'])->name('formPeminjamanUmum')->middleware('userAkses:umum');
    Route::get('/get-ruangan-by-gedung', [ControllerUmum::class, 'getRuanganByGedung'])->middleware('userAkses:umum');
    Route::get('/fetch-ruangan', [ControllerUmum::class, 'fetchByGedung'])->middleware('userAkses:umum');
    Route::get('umum/FullCalendar', [ControllerUmum::class, 'getEvent'])->name('geteventUmum')->middleware('userAkses:umum');
    Route::get('umum/rekapPeminjaman', [ControllerUmum::class, 'getRekapPeminjaman'])->name('getRekapPeminjaman')->middleware('userAkses:umum');
    Route::post('umum/rekapPeminjaman', [ControllerUmum::class, 'searchDate'])->name('searchDate')->middleware('userAkses:umum');
    //Route::get('umum/rekapPeminjaman/export/excel', [ControllerUmum::class, 'export_excel'])->name('export_excel')->middleware('userAkses:umum');
    Route::get('umum/cetakRekap', [ControllerUmum::class, 'cetakRekap'])->name('cetakRekap')->middleware('userAkses:umum');
    Route::get('umum/formTambahFasilitas', [ControllerUmum::class, 'formTambahFasilitas'])->name('formTambahFasilitas')->middleware('userAkses:umum');
    Route::get('umum/ruanganUmum', [ControllerUmum::class, 'ruanganUmum'])->name('ruanganUmum')->middleware('userAkses:umum');
    Route::get('umum/tambahRuangan', [ControllerUmum::class, 'tambahRuangan'])->name('tambahRuangan')->middleware('userAkses:umum');
    Route::post('umum/storeTambahRuangan', [ControllerUmum::class, 'storeTambahRuangan'])->name('storeTambahRuangan')->middleware('userAkses:umum');
    Route::get('umum/editRuangan/{id}', [ControllerUmum::class, 'editRuangan'])->name('editRuangan')->middleware('userAkses:umum');
    Route::put('umum/updateRuangan/{id}', [ControllerUmum::class, 'updateRuangan'])->name('updateRuangan')->middleware('userAkses:umum');
    Route::delete('/umum/deleteRuangan/{id}', [ControllerUmum::class, 'deleteRuangan'])->name('deleteRuangan')->middleware('userAkses:umum');
    Route::get('umum/tambahGedung', [ControllerUmum::class, 'tambahGedung'])->name('tambahGedung')->middleware('userAkses:umum');
    Route::post('umum/storeTambahGedung', [ControllerUmum::class, 'storeTambahGedung'])->name('storeTambahGedung')->middleware('userAkses:umum');
    Route::get('umum/editGedung/{id}', [ControllerUmum::class, 'editGedung'])->name('editGedung')->middleware('userAkses:umum');
    Route::put('umum/updateGedung/{id}', [ControllerUmum::class, 'updateGedung'])->name('updateGedung')->middleware('userAkses:umum');
    Route::delete('/umum/deleteGedung/{id}', [ControllerUmum::class, 'deleteGedung'])->name('deleteGedung')->middleware('userAkses:umum');
    Route::get('umum/rekapPeminjaman/export/excel', [ControllerUmum::class, 'export_excel'])->name('export_excel')->middleware('userAkses:umum');
    Route::get('umum/ruanganUmum/searchUmum', [ControllerUmum::class, 'searchUmum'])->name('searchUmum')->middleware('userAkses:umum');
});

Route::namespace('App\Http\Controllers')->group(function () {
});

