<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;

// untuk validator
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth; //untuk mendapatkan auth


class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // getViewProduk()
        $produk = Penjualan::getProduk();
        $id_customer = Auth::id(); //dapatkan id customer dari sesi user
        return view('penjualan.view',
                [
                    'produk' => $produk,
                    'jml' => Penjualan::getJmlProduk($id_customer),
                    'jml_invoice' => Penjualan::getJmlInvoice($id_customer),
                ]
        );
    }

    // dapatkan data produk berdasarkan id produk
    public function getDataProduk($id){
        $produk = Penjualan::getProdukId($id);
        if($produk)
        {
            return response()->json([
                'status'=>200,
                'produk'=> $produk,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan data produk berdasarkan id produk
    public function getDataProdukAll(){
        $produk = Penjualan::getProduk();
        if($produk)
        {
            return response()->json([
                'status'=>200,
                'produk'=> $produk,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan jumlah produk untuk keranjang
    public function getJumlahProduk(){
        $id_customer = Auth::id();
        $produk_qty = Penjualan::getJmlProduk($id_customer);
        if($produk_qty)
        {
            return response()->json([
                'status'=>200,
                'jumlah'=> $produk_qty,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // dapatkan jumlah produk untuk keranjang
    public function getInvoice(){
        $id_customer = Auth::id();
        $produk_qty = Penjualan::getJmlInvoice($id_customer);
        if($produk_qty)
        {
            return response()->json([
                'status'=>200,
                'jmlinvoice'=> $produk_qty,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenjualanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validator = Validator::make(
            $request->all(),
            [
                'jumlah' => 'required',
            ]
        );
        
        if($validator->fails()){
            // gagal
            return response()->json(
                [
                    'status' => 400,
                    'errors' => $validator->messages(),
                ]
            );
        }else{
            // berhasil

            // cek apakah tipenya input atau update
            // input => tipeproses isinya adalah tambah
            // update => tipeproses isinya adalah ubah
            
            if($request->input('tipeproses')=='tambah'){

                $id_customer = Auth::id();
                $produk_qty = $request->input('jumlah');
                $produk_id = $request->input('idprodukhidden');

                $brg = Penjualan::getProdukId($produk_id);
                foreach($brg as $b):
                    $produk_harga = $b->produk_harga;
                endforeach;

                $total_harga = $produk_harga*$produk_qty;
                Penjualan::inputPenjualan($id_customer,$total_harga,$produk_id,$produk_qty,$produk_harga,$total_harga);

                return response()->json(
                    [
                        'status' => 200,
                        'message' => 'Sukses Input Data',
                    ]
                );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }

    // view keranjang
    public function keranjang(){
        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer);
        return view('penjualan/viewkeranjang',
                [
                    'keranjang' => $keranjang
                ]
        );
    }

    // view status
    public function viewstatus(){
        $id_customer = Auth::id();
        // dapatkan id ke berapa dari status pemesanan
        $id_status_pemesanan = Penjualan::getIdStatus($id_customer);
        $status_pemesanan = Penjualan::getStatusAll($id_customer);
        return view('penjualan.viewstatus',
                [
                    'status_pemesanan' => $status_pemesanan,
                    'id_status_pemesanan'=> $id_status_pemesanan
                ]
        );
    } 

    // view keranjang
    public function keranjangjson(){
        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer);
        if($keranjang)
        {
            return response()->json([
                'status'=>200,
                'keranjang'=> $keranjang,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // view keranjang
    public function checkout(){
        $id_customer = Auth::id();
        Penjualan::checkout($id_customer); //proses cekout
        $produk = Penjualan::getProduk();

        return redirect('penjualan/status');
    }

    // invoice
    public function invoice(){
        $id_customer = Auth::id();
        $invoice = Penjualan::getListInvoice($id_customer);
        if($invoice)
        {
            return response()->json([
                'status'=>200,
                'invoice'=> $invoice,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'Tidak ada data ditemukan.'
            ]);
        }
    }

    // delete penjualan detail
    public function destroypenjualandetail($id_penjualan_detail){
        // kembalikan produk_stok ke semula
        Penjualan::kembalikanstok($id_penjualan_detail);

        //hapus dari database
        Penjualan::hapuspenjualandetail($id_penjualan_detail);

        $id_customer = Auth::id();
        $keranjang = Penjualan::viewKeranjang($id_customer);

        return view('penjualan/viewkeranjang',
            [
                'keranjang' => $keranjang,
                'status_hapus' => 'Sukses Hapus'
            ]
        );
    }
}
