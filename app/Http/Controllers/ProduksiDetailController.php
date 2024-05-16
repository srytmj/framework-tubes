<?php

namespace App\Http\Controllers;

use App\Models\ProduksiDetail;
use App\Models\Produksi; 
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class ProduksiDetailController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $produksi = ProduksiDetail::all();
        return view('produksi.view',
                    [
                        'produksi' => $produksi
                    ]
                  );
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        // Ambil data bahan baku pembelian berdasarkan ID
        $produksi = DB::table('produksi')
            ->select('produksi.produksi_kode as produksi_kode', 'produksi.tanggal_produksi as tanggal_produksi', 'produksi.status as status')
            ->where('produksi.id', $id)
            ->first();
    
        // Jika produksi tidak ditemukan, maka lempar 404
        if (!$produksi) {
            abort(404, 'Bahanbaku Pembelian not found');
        }
        
        // Ambil produksi_kode dan status dari data yang ditemukan
        $produksiKode = $produksi->produksi_kode;
        $status = $produksi->status;
        
        $produksiId = $id;
    
        // Ambil data produk
        $produk = DB::table('produk')
            ->join('produksi_detail', 'produk.produk_kode', '=', 'produksi_detail.produk_kode')
            ->select('produksi_detail.id', 'produk.produk_kode', 'produk.produk_nama', 'produk.produk_jenis', 'produksi_detail.kuantitas')
            ->where('produksi_detail.produksi_kode', $produksiKode)
            ->get();
    
        // Kembalikan view dengan data yang ditemukan atau baru dibuat, data produk, dan data produk untuk dropdown
        return view('produksi.detail', compact('produksi', 'produk' ,'produksiKode', 'produksiId', 'status'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // Ambil data jenis produk untuk dropdown di modal
        $produkJenisList = DB::table('produk')
            ->select('produk_jenis')
            ->distinct()
            ->get();

        // Misalkan produksi_kode diambil dari tabel produksi
        $ProduksiKode = DB::table('produksi')
            ->where('id', $id)
            ->value('produksi_kode');  // Ganti dengan logika yang sesuai
        
        $ProduksiId = $id;

        // Kembalikan view untuk create dengan data produkJenisList
        return view('produksi/produk', compact('produkJenisList', 'ProduksiKode', 'ProduksiId'));
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
            'produksi_kode' => 'required',
            'produk_kode' => 'required',
            'kuantitas' => 'required|integer',
        ]);
    
        // Simpan data ke tabel produksi_detail
        ProduksiDetail::create($request->all());
    
        // Dapatkan ID dari tabel produksi berdasarkan kode yang diberikan
        $ProduksiId = Produksi::where('produksi_kode', $validated['produksi_kode']) -> value('id');
    
        // Redirect ke halaman detail produksi berdasarkan ID yang ditemukan
        return redirect()->route('produksi.detail', ['id' => $ProduksiId])->with('success', 'Data berhasil disimpan');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProduksiDetail  $produksi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = BahanBakuPembelian::findOrFail($id);
        return view('produksi.detail', compact('pembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProduksiRequest  $request
     * @param  \App\Models\ProduksiDetail  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduksiRequest $request, ProduksiDetail $produksi)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProduksiDetail  $produksi
     * @return \Illuminate\Http\Response
     */
    // public function destroy(ProduksiDetail $produksi)
    public function destroy($id)
    {
        //hapus dari database
        $produksi = ProduksiDetail::findOrFail($id);
        $produksi->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
    
    // Function untuk mendapatkan nama produk berdasarkan jenis
    public function getProdukByJenis(Request $request)
    {
        $jenis = $request->query('jenis');
        $produk = DB::table('produk')
            ->where('produk_jenis', $jenis)
            ->select('produk_kode', 'produk_nama')
            ->get();
    
        return response()->json($produk);
    }
}
