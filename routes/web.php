<?php

use App\Http\Controllers\CoaController;
use App\Http\Controllers\ContohformController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BahanbakuController;
use App\Http\Controllers\BahanbakuPembelianController;
use App\Http\Controllers\BahanbakuPembelianDetailController;
use App\Http\Controllers\PegawaiPenggajianController;
use App\Http\Controllers\ProdukDetailController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\ProduksiDetailController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\JurnalController;


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

// route ke master data jabatan
Route::get('jabatan', [JabatanController::class, 'index']);
Route::get('/jabatan/destroy/{id}', [JabatanController::class,'destroy'])->middleware(['auth']);
Route::resource('/jabatan', JabatanController::class)->middleware(['auth']);

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
Route::post('/bahanbakupembeliandetail', [BahanbakuPembelianDetailController::class, 'store'])->name('bahanbakupembeliandetail.store');
Route::get('/bahanbakupembeliandetail/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianDetailController::class,'destroy'])->name('bahanbakupembeliandetail.destroy');
Route::get('/bahanbakupembeliandetail/create/{id}', [BahanBakuPembelianDetailController::class, 'create'])->name('bahanbakupembeliandetail.create');

// route ke produkdetail
Route::resource('/produk/detail', ProdukDetailController::class)->middleware(['auth']);
Route::get('/produk/detail/{id}', [ProdukDetailController::class, 'show'])->name('produkdetail.show');
Route::get('/produk/detail/create/{id}', [ProdukDetailController::class, 'create'])->name('produkdetail.create');
Route::post('/produk/detail/', [ProdukDetailController::class, 'store'])->name('produkdetail.store');
Route::get('/produk/detail/{id}/edit', [ProdukDetailController::class, 'edit'])->name('produkdetail.edit');
Route::put('/produk/detail/{id}', [ProdukDetailController::class, 'update'])->name('produkdetail.update');
Route::get('/produk/detail/destroy/{id}', [ProdukDetailController::class, 'destroy'])->name('produkdetail.destroy');

// route ke produksi & detail
Route::resource('/produksi', ProduksiController::class)->middleware(['auth']);
Route::get('/produksi/detail/{id}', [App\Http\Controllers\ProduksiController::class,'detail'])->middleware(['auth']);
Route::get('/produksi/detail/{id}', [ProduksiDetailController::class, 'detail'])->name('produksi.detail');
Route::get('/getProdukByJenis', [ProduksiDetailController::class, 'getProdukByJenis'])->name('getProdukByJenis');
Route::post('/produksi', [ProduksiController::class, 'store'])->name('produksi.store');
Route::post('/produksi/detail', [ProduksiDetailController::class, 'store'])->name('produksidetail.store');
Route::get('/produksi/detail/destroy/{id}', [App\Http\Controllers\ProduksiDetailController::class,'destroy'])->name('produksidetail.destroy');
Route::get('/produksi/detail/create/{id}', [ProduksiDetailController::class, 'create'])->name('produksidetail.create');
Route::get('/produksi/approve/{id}', [ProduksiController::class, 'approve'])->name('produksi.approve');

// untuk transaksi penjualan
Route::get('penjualan/produk/{id}', [App\Http\Controllers\PenjualanController::class,'getDataProduk'])->middleware(['auth']);
Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang'])->middleware(['auth']);
Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail'])->middleware(['auth']);
Route::get('penjualan/produk', [App\Http\Controllers\PenjualanController::class,'getDataProdukAll'])->middleware(['auth']);
Route::get('penjualan/jmlproduk', [App\Http\Controllers\PenjualanController::class,'getJumlahProduk'])->middleware(['auth']);
Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson'])->middleware(['auth']);
Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout'])->middleware(['auth']);
Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice'])->middleware(['auth']);
Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice'])->middleware(['auth']);
Route::get('penjualan/status', [App\Http\Controllers\PenjualanController::class,'viewstatus'])->middleware(['auth']);
Route::resource('penjualan', PenjualanController::class)->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang'])->middleware(['auth']);
Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus'])->middleware(['auth']); 
Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus'])->middleware(['auth']);
Route::get('pembayaran/approve/{transaksi_no}', [App\Http\Controllers\PembayaranController::class,'approve'])->middleware(['auth']);
Route::get('pembayaran/unapprove/{transaksi_no}', [App\Http\Controllers\PembayaranController::class,'unapprove'])->middleware(['auth']);
Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG'])->middleware(['auth']);
Route::resource('pembayaran', PembayaranController::class)->middleware(['auth']);

// grafik
Route::get('grafik/viewPenjualanBlnBerjalan', [App\Http\Controllers\GrafikController::class,'viewPenjualanBlnBerjalan'])->middleware(['auth']);
Route::get('grafik/viewJmlPenjualan', [App\Http\Controllers\GrafikController::class,'viewJmlPenjualan'])->middleware(['auth']);
Route::get('grafik/viewJmlProdukTerjual', [App\Http\Controllers\GrafikController::class,'viewJmlProdukTerjual'])->middleware(['auth']);
Route::get('grafik/viewPenjualanSelectOption/{tahun}', [App\Http\Controllers\GrafikController::class,'viewPenjualanSelectOption'])->middleware(['auth']);
Route::get('grafik/viewDataPenjualanSelectOption/{tahun}', [App\Http\Controllers\GrafikController::class,'viewDataPenjualanSelectOption'])->middleware(['auth']);

// laporan
Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum'])->middleware(['auth']);
Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum'])->middleware(['auth']);
Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar'])->middleware(['auth']);
Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar'])->middleware(['auth']);

// untuk midtrans
Route::get('midtrans', [App\Http\Controllers\CobaMidtransController::class,'index'])->middleware(['auth']);
Route::get('midtrans/status', [App\Http\Controllers\CobaMidtransController::class,'cekstatus2'])->middleware(['auth']);
Route::get('midtrans/status2/{id}', [App\Http\Controllers\CobaMidtransController::class,'cekstatus'])->middleware(['auth']);
Route::get('midtrans/bayar', [App\Http\Controllers\CobaMidtransController::class,'bayar'])->middleware(['auth']);
Route::post('midtrans/proses_bayar', [App\Http\Controllers\CobaMidtransController::class,'proses_bayar'])->middleware(['auth']);

require __DIR__.'/auth.php';
