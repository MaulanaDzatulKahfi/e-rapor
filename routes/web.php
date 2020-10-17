<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TestController;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('test/pdf/{id}', [NilaiController::class, 'pdf']);
// Route::get('test', [TestController::class, 'index']);
// Route::get('test/view', [TestController::class, 'view']);
// Route::get('test/setcookie', [TestController::class, 'setcookie']);
// Route::get('test/getcookie', [TestController::class, 'getcookie']);
// Route::get('test/export', function () {
//     return view('nilai.format.nilaiPengetahuan', [
//         'siswa' => Siswa::where('kelas_id', Auth::user()->kelas_id)->get(),
//     ]);
// });

Route::get('cari/{id}', [SiswaController::class, 'cari']);
Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [SiswaController::class, 'index'])->name('/');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['auth', 'CheckRole:admin,siswa,walikelas']], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => ['auth', 'CheckRole:admin']], function () {
    Route::get('/admin', [AdminController::class, 'dashboard']);
    // crud siswa
    Route::post('/tambahsiswa', [SiswaController::class, 'tambah_siswa']);
    Route::get('/editsiswa/{id}', [SiswaController::class, 'edit']);
    Route::put('/updatesiswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/hapussiswa/{siswa}', [SiswaController::class, 'hapus']);

    //crud kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas/tambah', [KelasController::class, 'tambah']);
    Route::get('kelas/edit/{kelas}', [KelasController::class, 'edit']);
    Route::put('/kelas/update/{kelas}', [KelasController::class, 'update']);
    Route::delete('/kelas/hapus/{kelas}', [KelasController::class, 'hapus']);

    //crud mapel
    Route::get('/pelajaran', [PelajaranController::class, 'index']);
    Route::post('/pelajaran/tambah', [PelajaranController::class, 'tambah']);
    Route::get('pelajaran/edit/{pelajaran}', [PelajaranController::class, 'edit']);
    Route::put('/pelajaran/update/{pelajaran}', [PelajaranController::class, 'update']);
    Route::delete('/pelajaran/hapus/{pelajaran}', [PelajaranController::class, 'hapus']);

    //crud eskul
    Route::get('/eskul', [EskulController::class, 'index']);
    Route::post('/eskul/tambah', [EskulController::class, 'tambah']);
    Route::get('eskul/edit/{eskul}', [EskulController::class, 'edit']);
    Route::put('/eskul/update/{eskul}', [EskulController::class, 'update']);
    Route::delete('/eskul/hapus/{eskul}', [EskulController::class, 'hapus']);
});
Route::group(['middleware' => ['auth', 'CheckRole:admin,walikelas']], function () {
    Route::get('/datasiswa', [AdminController::class, 'datasiswa']);
    //nilai
    Route::get('nilai', [NilaiController::class, 'index']);
    Route::post('nilai/download/{id}', [NilaiController::class, 'export']);
    // Route::get('nilai/detail/{id}', [NilaiController::class, 'detail']);
    Route::get('nilai/pdf/{id}', [NilaiController::class, 'pdf']);
    // import
    Route::post('nilai/import/sikap', [NilaiController::class, 'importsikap']);
    Route::post('nilai/import/nilai-pengetahuan', [NilaiController::class, 'importpengetahuan']);
    Route::post('nilai/import/nilai-keterampilan', [NilaiController::class, 'importketerampilan']);
    Route::post('nilai/import/nilai-eskul', [NilaiController::class, 'importeskul']);
});
Route::group(['middleware' => ['auth', 'CheckRole:walikelas']], function () {
    Route::get('/walikelas', [AdminController::class, 'walikelas']);
});
Route::group(['middleware' => ['auth', 'CheckRole:siswa']], function () {
    Route::get('/siswa', [SiswaController::class, 'dashboard']);
});
