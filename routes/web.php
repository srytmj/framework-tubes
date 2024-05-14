<?php

use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\BahanbakuPembelianController;
use App\Http\Controllers\PegawaiPenggajianController;


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

Route::get('/', function () {
    // return view('welcome');
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');


// untuk master data coa
// jika ingin menambahkan routes baru selain default resource di tambah di awal
// sebelum route resource
Route::get('coa/tabel', [App\Http\Controllers\CoaController::class,'tabel'])->middleware(['auth']);
Route::get('coa/fetchcoa', [App\Http\Controllers\CoaController::class,'fetchcoa'])->middleware(['auth']);
Route::get('coa/fetchAll', [App\Http\Controllers\CoaController::class,'fetchAll'])->middleware(['auth']);
Route::get('coa/edit/{id}', [App\Http\Controllers\CoaController::class,'edit'])->middleware(['auth']);
Route::get('coa/destroy/{id}', [App\Http\Controllers\CoaController::class,'destroy'])->middleware(['auth']);
Route::resource('coa', CoaController::class)->middleware(['auth']);

// route ke master data distributor
Route::get('/distributor', [DistributorController::class, 'index']);
Route::get('/distributor/destroy/{id}', [DistributorController::class,'destroy'])->middleware(['auth']);
Route::resource('/distributor', DistributorController::class)->middleware(['auth']);

// route ke master data pegawai
Route::get('pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai/destroy/{id}', [PegawaiController::class,'destroy'])->middleware(['auth']);
Route::resource('/pegawai', PegawaiController::class)->middleware(['auth']);

// route ke penggajian pegawai
Route::get('pegawaipenggajian', [PegawaiPenggajianController::class, 'index']);
Route::get('/pegawaipenggajian/destroy/{id}', [PegawaiPenggajianController::class,'destroy'])->middleware(['auth']);
Route::resource('/pegawaipenggajian', PegawaiPenggajianController::class)->middleware(['auth']);

// route ke master data produk
Route::get('produk', [ProdukController::class, 'index']);
Route::get('/produk/destroy/{id}', [ProdukController::class,'destroy'])->middleware(['auth']);
Route::resource('/produk', ProdukController::class)->middleware(['auth']);

// route ke master data bahanbaku 
Route::resource('/bahanbaku', BahanbakuController::class)->middleware(['auth']);
Route::get('/bahanbaku/destroy/{id}', [App\Http\Controllers\BahanbakuController::class,'destroy'])->middleware(['auth']);

// route ke bahanbakupembelian
// Route::get('bahanbakupembelian/tabel', [App\Http\Controllers\BahanbakuPembelianController::class,'tabel'])->middleware(['auth']);
// Route::get('bahanbakupembelian/fetchcoa', [App\Http\Controllers\BahanbakuPembelianController::class,'fetchcoa'])->middleware(['auth']);
// Route::get('bahanbakupembelian/fetchAll', [App\Http\Controllers\BahanbakuPembelianController::class,'fetchAll'])->middleware(['auth']);
// Route::get('bahanbakupembelian/edit/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'edit'])->middleware(['auth']);
// Route::get('bahanbakupembelian/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'destroy'])->middleware(['auth']);
// Route::resource('bahanbakupembelian', BahanbakuPembelianController::class)->middleware(['auth']);
Route::resource('/bahanbakupembelian', BahanbakuPembelianController::class)->middleware(['auth']);
Route::get('/bahanbakupembelian/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'destroy'])->middleware(['auth']);
Route::get('/bahanbakupembelian/detail/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'detail'])->name('bahanbakupembelian.detail')->middleware(['auth']);

// // route ke master data persediaanbahan
// Route::resource('/persediaanbahan', App\Http\Controllers\PersediaanbahanController::class)->middleware(['auth']);
// Route::get('/persediaanbahan/destroy/{id}', [App\Http\Controllers\PersediaanbahanController::class,'destroy'])->middleware(['auth']);
require __DIR__.'/auth.php';

require __DIR__.'/auth.php';
