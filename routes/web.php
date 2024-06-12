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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');


Route::middleware(['auth'])->group(function () {

    Route::group(['middleware' => ['role:admin|manajer']], function () {

        // Route untuk master data coa
        Route::get('coa/tabel', [CoaController::class, 'tabel']);
        Route::get('coa/fetchcoa', [CoaController::class, 'fetchcoa']);
        Route::get('coa/fetchAll', [CoaController::class, 'fetchAll']);
        Route::get('coa/edit/{id}', [CoaController::class, 'edit']);
        Route::get('coa/destroy/{id}', [CoaController::class, 'destroy']);
        Route::resource('coa', CoaController::class);

        // Route untuk master data distributor
        Route::get('/distributor', [DistributorController::class, 'index']);
        Route::get('/distributor/destroy/{id}', [DistributorController::class,'destroy']);
        Route::resource('/distributor', DistributorController::class);

        // Route untuk master data jabatan
        Route::get('jabatan', [JabatanController::class, 'index']);
        Route::get('/jabatan/destroy/{id}', [JabatanController::class,'destroy']);
        Route::resource('/jabatan', JabatanController::class);

        // Route untuk master data pegawai
        Route::get('pegawai', [PegawaiController::class, 'index']);
        Route::get('/pegawai/destroy/{id}', [PegawaiController::class,'destroy']);
        Route::resource('/pegawai', PegawaiController::class);

        // Route untuk penggajian pegawai
        Route::get('pegawaipenggajian', [PegawaiPenggajianController::class, 'index']);
        Route::get('/pegawaipenggajian/destroy/{id}', [PegawaiPenggajianController::class,'destroy']);
        Route::resource('/pegawaipenggajian', PegawaiPenggajianController::class);


    });

    Route::group(['middleware' => ['role:admin|manajer|petugas_gudang']], function () {
        
        // Route untuk master data produk
        Route::get('produk', [ProdukController::class, 'index']);
        Route::get('/produk/destroy/{id}', [ProdukController::class,'destroy']);
        Route::resource('/produk', ProdukController::class);

        // Route untuk master data bahanbaku
        Route::resource('/bahanbaku', BahanbakuController::class);
        Route::get('/bahanbaku/destroy/{id}', [App\Http\Controllers\BahanbakuController::class,'destroy']);

        // Route untuk bahanbakupembelian
        Route::get('/bahanbakupembelian/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianController::class,'destroy']);
        Route::get('/bahanbakupembelian/approve/{id}', [BahanBakuPembelianController::class, 'approve']);
        Route::resource('/bahanbakupembelian', BahanbakuPembelianController::class);

        // Route untuk bahanbakupembelian detail
        Route::get('/bahanbakupembelian/detail/{id}', [App\Http\Controllers\BahanbakuPembelianDetailController::class,'detail']);
        Route::get('/bahanbakupembelian/detail/{id}', [BahanbakuPembelianDetailController::class, 'detail'])->name('bahanbakupembelian.detail');
        Route::get('/getBahanBakuByJenis', [BahanbakuPembelianDetailController::class, 'getBahanbakuByJenis'])->name('getBahanBakuByJenis');
        Route::post('/bahanbakupembeliandetail', [BahanbakuPembelianDetailController::class, 'store'])->name('bahanbakupembeliandetail.store');
        Route::get('/bahanbakupembeliandetail/destroy/{id}', [App\Http\Controllers\BahanbakuPembelianDetailController::class,'destroy'])->name('bahanbakupembeliandetail.destroy');
        Route::get('/bahanbakupembeliandetail/create/{id}', [BahanBakuPembelianDetailController::class, 'create'])->name('bahanbakupembeliandetail.create');
        Route::resource('/bahanbakupembeliandetail', BahanbakuPembelianDetailController::class);

        // Route untuk produkdetail
        Route::get('/produk/detail/{id}', [ProdukDetailController::class, 'show'])->name('produkdetail.show');
        Route::get('/produk/detail/create/{id}', [ProdukDetailController::class, 'create'])->name('produkdetail.create');
        Route::post('/produk/detail/', [ProdukDetailController::class, 'store'])->name('produkdetail.store');
        Route::get('/produk/detail/{id}/edit', [ProdukDetailController::class, 'edit'])->name('produkdetail.edit');
        Route::put('/produk/detail/{id}', [ProdukDetailController::class, 'update'])->name('produkdetail.update');
        Route::get('/produk/detail/destroy/{id}', [ProdukDetailController::class, 'destroy'])->name('produkdetail.destroy');
        Route::resource('/produk/detail', ProdukDetailController::class);

        // Route untuk produksi & detail
        Route::get('/produksi/detail/{id}', [App\Http\Controllers\ProduksiController::class,'detail']);
        Route::get('/produksi/detail/{id}', [ProduksiDetailController::class, 'detail'])->name('produksi.detail');
        Route::get('/getProdukByJenis', [ProduksiDetailController::class, 'getProdukByJenis'])->name('getProdukByJenis');
        Route::post('/produksi', [ProduksiController::class, 'store'])->name('produksi.store');
        Route::post('/produksi/detail', [ProduksiDetailController::class, 'store'])->name('produksidetail.store');
        Route::get('/produksi/detail/destroy/{id}', [App\Http\Controllers\ProduksiDetailController::class,'destroy'])->name('produksidetail.destroy');
        Route::get('/produksi/detail/create/{id}', [ProduksiDetailController::class, 'create'])->name('produksidetail.create');
        Route::get('/produksi/approve/{id}', [ProduksiController::class, 'approve'])->name('produksi.approve');
        Route::resource('/produksi', ProduksiController::class);

    });

    Route::group(['middleware' => ['role:admin|manajer']], function () {

        // Route untuk transaksi penjualan
        Route::get('penjualan/produk/{id}', [App\Http\Controllers\PenjualanController::class,'getDataProduk']);
        Route::get('penjualan/keranjang', [App\Http\Controllers\PenjualanController::class,'keranjang']);
        Route::get('penjualan/destroypenjualandetail/{id}', [App\Http\Controllers\PenjualanController::class,'destroypenjualandetail']);
        Route::get('penjualan/produk', [App\Http\Controllers\PenjualanController::class,'getDataProdukAll']);
        Route::get('penjualan/jmlproduk', [App\Http\Controllers\PenjualanController::class,'getJumlahProduk']);
        Route::get('penjualan/keranjangjson', [App\Http\Controllers\PenjualanController::class,'keranjangjson']);
        Route::get('penjualan/checkout', [App\Http\Controllers\PenjualanController::class,'checkout']);
        Route::get('penjualan/invoice', [App\Http\Controllers\PenjualanController::class,'invoice']);
        Route::get('penjualan/jmlinvoice', [App\Http\Controllers\PenjualanController::class,'getInvoice']);
        Route::get('penjualan/status', [App\Http\Controllers\PenjualanController::class,'viewstatus']);
        Route::resource('penjualan', PenjualanController::class);

        // Route untuk transaksi pembayaran
        Route::get('pembayaran/viewkeranjang', [App\Http\Controllers\PembayaranController::class,'viewkeranjang']);
        Route::get('pembayaran/viewstatus', [App\Http\Controllers\PembayaranController::class,'viewstatus']); 
        Route::get('pembayaran/viewapprovalstatus', [App\Http\Controllers\PembayaranController::class,'viewapprovalstatus']);
        Route::get('pembayaran/approve/{transaksi_no}', [App\Http\Controllers\PembayaranController::class,'approve']);
        Route::get('pembayaran/unapprove/{transaksi_no}', [App\Http\Controllers\PembayaranController::class,'unapprove']);
        Route::get('pembayaran/viewstatusPG', [App\Http\Controllers\PembayaranController::class,'viewstatusPG']);
        Route::resource('pembayaran', PembayaranController::class);

        // Route untuk midtrans
        Route::get('midtrans', [App\Http\Controllers\CobaMidtransController::class,'index']);
        Route::get('midtrans/status', [App\Http\Controllers\CobaMidtransController::class,'cekstatus2']);
        Route::get('midtrans/status2/{id}', [App\Http\Controllers\CobaMidtransController::class,'cekstatus']);
        Route::get('midtrans/bayar', [App\Http\Controllers\CobaMidtransController::class,'bayar']);
        Route::post('midtrans/proses_bayar', [App\Http\Controllers\CobaMidtransController::class,'proses_bayar']);
    });

    // Route untuk grafik
    Route::get('grafik/viewPenjualanBlnBerjalan', [App\Http\Controllers\GrafikController::class,'viewPenjualanBlnBerjalan']);
    Route::get('grafik/viewJmlPenjualan', [App\Http\Controllers\GrafikController::class,'viewJmlPenjualan']);
    Route::get('grafik/viewJmlProdukTerjual', [App\Http\Controllers\GrafikController::class,'viewJmlProdukTerjual']);
    Route::get('grafik/viewPenjualanSelectOption/{tahun}', [App\Http\Controllers\GrafikController::class,'viewPenjualanSelectOption']);
    Route::get('grafik/viewDataPenjualanSelectOption/{tahun}', [App\Http\Controllers\GrafikController::class,'viewDataPenjualanSelectOption']);

    // Route untuk laporan
    Route::get('jurnal/umum', [App\Http\Controllers\JurnalController::class,'jurnalumum']);
    Route::get('jurnal/viewdatajurnalumum/{periode}', [App\Http\Controllers\JurnalController::class,'viewdatajurnalumum']);
    Route::get('jurnal/bukubesar', [App\Http\Controllers\JurnalController::class,'bukubesar']);
    Route::get('jurnal/viewdatabukubesar/{periode}/{akun}', [App\Http\Controllers\JurnalController::class,'viewdatabukubesar']);
});

require __DIR__.'/auth.php';
