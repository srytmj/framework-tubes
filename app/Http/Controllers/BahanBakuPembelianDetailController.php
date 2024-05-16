<?php

namespace App\Http\Controllers;

use App\Models\BahanbakuPembelianDetail;
use App\Models\BahanbakuPembelian; 
use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class BahanbakuPembelianDetailController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $bahanbakupembelian = BahanbakuPembelianDetail::all();
        return view('bahanbakupembelian.view',
                    [
                        'bahanbakupembelian' => $bahanbakupembelian
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
        $bahanbakupembelian = DB::table('bahanbaku_pembelian')
            ->join('distributor', 'bahanbaku_pembelian.distributor_kode', '=', 'distributor.distributor_kode')
            ->select('bahanbaku_pembelian.bahanbaku_pembelian_kode as bahanbaku_pembelian_kode', 'distributor.distributor_nama as distributor_nama', 'bahanbaku_pembelian.status as status')
            ->where('bahanbaku_pembelian.id', $id)
            ->first();
    
        // Jika bahanbakupembelian tidak ditemukan, maka lempar 404
        if (!$bahanbakupembelian) {
            abort(404, 'Bahanbaku Pembelian not found');
        }
        
        // Ambil bahanbakupembelian_kode dan status dari data yang ditemukan
        $bahanbakupembelianKode = $bahanbakupembelian->bahanbaku_pembelian_kode;
        $status = $bahanbakupembelian->status;
        
        $bahanbakupembelianId = $id;
    
        // Ambil data bahan baku dengan kuantitas, produk_harga satuan, dan subtotal
        $bahanbaku = DB::table('bahanbaku')
            ->join('bahanbaku_pembelian_detail', 'bahanbaku.bahanbaku_kode', '=', 'bahanbaku_pembelian_detail.bahanbaku_kode')
            ->select('bahanbaku_pembelian_detail.id', 'bahanbaku.bahanbaku_kode', 'bahanbaku.bahanbaku_nama', 'bahanbaku.bahanbaku_jenis', 'bahanbaku_pembelian_detail.kuantitas', 'bahanbaku_pembelian_detail.harga_satuan', DB::raw('(bahanbaku_pembelian_detail.kuantitas * bahanbaku_pembelian_detail.harga_satuan) AS subtotal'))
            ->where('bahanbaku_pembelian_detail.bahanbaku_pembelian_kode', $bahanbakupembelianKode)
            ->get();
    
        // Kembalikan view dengan data yang ditemukan atau baru dibuat, data bahanbaku, dan data bahanbaku untuk dropdown
        return view('bahanbakupembelian.detail', compact('bahanbakupembelian', 'bahanbaku' ,'bahanbakupembelianKode', 'bahanbakupembelianId', 'status'));
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

        // Misalkan bahanbaku_pembelian_kode diambil dari tabel bahanbaku_pembelian
        $bahanbakuPembelianKode = DB::table('bahanbaku_pembelian')
            ->where('id', $id)
            ->value('bahanbaku_pembelian_kode');  // Ganti dengan logika yang sesuai
        
        $bahanbakuPembelianId = $id;

        // Kembalikan view untuk create dengan data bahanbakuJenisList
        return view('bahanbakupembelian/bahanbaku', compact('bahanbakuJenisList', 'bahanbakuPembelianKode', 'bahanbakuPembelianId'));
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
            'bahanbaku_pembelian_kode' => 'required',
            'bahanbaku_kode' => 'required',
            'kuantitas' => 'required|integer',
            'harga_satuan' => 'required|numeric',
        ]);
    
        // Simpan data ke tabel bahanbaku_pembelian_detail
        BahanbakuPembelianDetail::create($request->all());
    
        // Dapatkan ID dari tabel bahanbaku_pembelian berdasarkan kode yang diberikan
        $bahanbakuPembelianId = BahanbakuPembelian::where('bahanbaku_pembelian_kode', $validated['bahanbaku_pembelian_kode']) -> value('id');
    
        // Redirect ke halaman detail bahanbaku_pembelian berdasarkan ID yang ditemukan
        return redirect()->route('bahanbakupembelian.detail', ['id' => $bahanbakuPembelianId])->with('success', 'Data berhasil disimpan');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BahanbakuPembelianDetail  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = BahanBakuPembelian::findOrFail($id);
        return view('bahanbakupembelian.detail', compact('pembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBahanbakuPembelianRequest  $request
     * @param  \App\Models\BahanbakuPembelianDetail  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBahanbakuPembelianRequest $request, BahanbakuPembelianDetail $bahanbakupembelian)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BahanbakuPembelianDetail  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    // public function destroy(BahanbakuPembelianDetail $bahanbakupembelian)
    public function destroy($id)
    {
        //hapus dari database
        $bahanbakupembelian = BahanbakuPembelianDetail::findOrFail($id);
        $bahanbakupembelian->delete();

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
