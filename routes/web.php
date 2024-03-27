<?php

use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
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

// route untuk validasi login
// Route::post('/validasi_login', [App\Http\Controllers\LoginController::class, 'show']);

// route selamat
Route::get('/selamat', function () {
    return view('selamat',['nama'=>'Hendro Jokondo-kondo']);
});

// route contoh1
Route::get('/contoh1', [App\Http\Controllers\Contoh1Controller::class, 'show']);
// route contoh2
Route::get('/contoh2', [App\Http\Controllers\Contoh2Controller::class, 'show']);

// untuk master data coa
// jika ingin menambahkan routes baru selain default resource di tambah di awal
// sebelum route resource
Route::get('coa/tabel', [App\Http\Controllers\CoaController::class,'tabel'])->middleware(['auth']);
Route::get('coa/fetchcoa', [App\Http\Controllers\CoaController::class,'fetchcoa'])->middleware(['auth']);
Route::get('coa/fetchAll', [App\Http\Controllers\CoaController::class,'fetchAll'])->middleware(['auth']);
Route::get('coa/edit/{id}', [App\Http\Controllers\CoaController::class,'edit'])->middleware(['auth']);
Route::get('coa/destroy/{id}', [App\Http\Controllers\CoaController::class,'destroy'])->middleware(['auth']);
Route::resource('coa', CoaController::class)->middleware(['auth']);

// route ke master data perusahaan
Route::get('/perusahaan', [PerusahaanController::class, 'index']);
Route::get('/perusahaan/destroy/{id}', [PerusahaanController::class,'destroy'])->middleware(['auth']);
Route::resource('/perusahaan', PerusahaanController::class)->middleware(['auth']);

// route ke master data contohform
Route::get('contohform/fetchAll', [ContohformController::class,'fetchAll'])->middleware(['auth']);
Route::get('contohform/fetchcontohform', [App\Http\Controllers\ContohformController::class,'fetchcontohform'])->middleware(['auth']);
Route::get('contohform/edit/{id}', [App\Http\Controllers\ContohformController::class,'edit'])->middleware(['auth']);
Route::get('contohform/destroy/{id}', [App\Http\Controllers\ContohformController::class,'destroy'])->middleware(['auth']);
Route::resource('contohform', App\Http\Controllers\ContohformController::class)->middleware(['auth']);

// route ke master data pelanggan
Route::get('pelanggan', [PelangganController::class, 'index']);
Route::get('/pelanggan/destroy/{id}', [PelangganController::class,'destroy'])->middleware(['auth']);
Route::resource('/pelanggan', PelangganController::class)->middleware(['auth']);

// route ke master data produk
Route::get('produk', [ProdukController::class, 'index']);
Route::get('/produk/destroy/{id}', [ProdukController::class,'destroy'])->middleware(['auth']);
Route::resource('/produk', ProdukController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
