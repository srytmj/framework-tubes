<?php

use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\BahanbakuPembelianController;
use App\Http\Controllers\BahanbakuPembelianDetailController;
use App\Http\Controllers\PegawaiPenggajianController;
use App\Http\Controllers\ProdukDetailController;


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
Route::resource('/bahanbakupembelian', BahanbakuPembelianController::class)->middleware(['auth']);
Route::get('/bahanbakupembelian/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'destroy'])->middleware(['auth']);
Route::get('/bahanbakupembelian/approve/{id}', [BahanBakuPembelianController::class, 'approve'])->name('bahanbakupembelian.approve');

// route ke bahanbakupembelian detail
Route::resource('/bahanbakupembeliandetail', BahanbakuPembelianDetailController::class)->middleware(['auth']);
Route::get('/bahanbakupembelian/detail/{id}', [App\Http\Controllers\BahanbakuPembelianDetailController::class,'detail'])->middleware(['auth']);
Route::get('/bahanbakupembelian/detail/{id}', [BahanbakuPembelianDetailController::class, 'detail'])->name('bahanbakupembelian.detail');
Route::get('/getBahanBakuByJenis', [BahanbakuPembelianDetailController::class, 'getBahanbakuByJenis'])->name('getBahanBakuByJenis');
Route::get('/bahanbakupembeliandetail/create/{id}', [BahanBakuPembelianDetailController::class, 'create'])->name('bahanbakupembeliandetail.create');
Route::post('/bahanbakupembeliandetail', [BahanbakuPembelianDetailController::class, 'store'])->name('bahanbakupembeliandetail.store');
Route::get('/bahanbakupembeliandetail/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianDetailController::class,'destroy'])->name('bahanbakupembeliandetail.destroy');

// route ke produkdetail
Route::resource('/produk/detail', ProdukDetailController::class)->middleware(['auth']);
Route::get('/produk/detail/{id}', [ProdukDetailController::class, 'show'])->name('produkdetail.show');
Route::get('/produk/detail/{id}/create', [ProdukDetailController::class, 'create'])->name('produkdetail.create');
Route::post('/produk/detail/', [ProdukDetailController::class, 'store'])->name('produkdetail.store');
Route::get('/produk/detail/{id}/edit', [ProdukDetailController::class, 'edit'])->name('produkdetail.edit');
Route::put('/produk/detail/{id}', [ProdukDetailController::class, 'update'])->name('produkdetail.update');
Route::delete('/produk/detail/{id}', [ProdukDetailController::class, 'destroy'])->name('produkdetail.destroy');

require __DIR__.'/auth.php';
