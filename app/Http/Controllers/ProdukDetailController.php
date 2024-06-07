<?php

namespace App\Http\Controllers;

use App\Models\ProdukDetail;
use App\Models\Produk; 
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class ProdukDetailController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $produk = ProdukDetail::all();
        return view('produk.view',
                    [
                        'produk' => $produk
                    ]
                  );
    }  
    
    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // Ambil data jenis bahanbaku untuk dropdown di modal
        $bahanbakuJenisList = DB::table('bahanbaku')
            ->select('bahanbaku_jenis')
            ->distinct()
            ->get();
        
        $produkId = $id;
    
        // Ambil nama produk dan kode produk berdasarkan produkId
        $produk = DB::table('produk')
            ->where('id', $produkId)
            ->select('produk_nama', 'produk_kode')
            ->first();
    
        // Kembalikan view untuk create dengan data bahanbakuJenisList, produkNama, dan produkKode
        return view('produkdetail/create', compact('bahanbakuJenisList', 'produkId', 'produk'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        // Validasi input
        $validated = $request->validate([
            'produk_kode' => 'required',
            'bahanbaku_kode' => 'required',
            'jumlah' => 'required|integer',
        ]);
    
        // Simpan data ke tabel bahanbaku_pembelian_detail
        ProdukDetail::create($request->all());
    
        // Dapatkan ID dari tabel bahanbaku_pembelian berdasarkan kode yang diberikan
        $produk = Produk::where('produk_kode', $validated['produk_kode']) -> value('id');
    
        // Redirect ke halaman detail bahanbaku_pembelian berdasarkan ID yang ditemukan
        return redirect()->route('produkdetail.show', ['id' => $produk])->with('success', 'Data berhasil disimpan');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukDetail  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $pembelian = Produk::findOrFail($id);
        // return view('produk.detail', compact('pembelian'));
                // Ambil data bahan baku pembelian berdasarkan ID
        $produk = DB::table('produk')
            ->select('produk.produk_kode AS produk_kode', 'produk.produk_nama AS produk_nama')
            ->where('produk.id', $id)
            ->first();
    
        // Jika produk tidak ditemukan, maka lempar 404
        if (!$produk) {
            abort(404, 'Bahanbaku Pembelian not found');
        }
        
        // Ambil produk_kode dan status dari data yang ditemukan
        $produkKode = $produk->produk_kode;
        
        $produkId = $id;
    
        // Ambil data bahan baku
        $bahanbaku = DB::table('produk_detail as pd')
            ->join('bahanbaku as bb', 'pd.bahanbaku_kode', '=', 'bb.bahanbaku_kode')
            ->join('produk as p', 'pd.produk_kode', '=', 'p.produk_kode')
            ->select('pd.id','bb.bahanbaku_kode', 'bb.bahanbaku_nama', 'bb.bahanbaku_jenis', 'pd.jumlah')
            ->where('p.produk_kode', '=', $produkKode)
            ->get();
            
        // Kembalikan view dengan data yang ditemukan atau baru dibuat, data bahanbaku, dan data bahanbaku untuk dropdown
        return view('produk.detail', compact('produk', 'bahanbaku' ,'produkKode', 'produkId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBahanbakuPembelianRequest  $request
     * @param  \App\Models\ProdukDetail  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBahanbakuPembelianRequest $request, ProdukDetail $produk)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukDetail  $produk
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ProdukDetail $produk)
    public function destroy($id)
    {
        //hapus dari database
        $produk = ProdukDetail::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    
    // Function untuk mendapatkan nama bahanbaku berdasarkan jenis
    public function getBahanbakuByJenis(Request $request)
    {
        $jenis = $request->query('jenis');
        $bahanbaku = DB::table('bahanbaku')
            ->where('bahanbaku_jenis', $jenis)
            ->select('bahanbaku_kode', 'bahanbaku_nama')
            ->get();
    
        return response()->json($bahanbaku);
    }
}
