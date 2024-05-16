<?php

namespace App\Http\Controllers;

use App\Models\Produksi;
use App\Models\ProduksiDetail;
use App\Models\Distributor;
use App\Http\Requests\StoreProduksiRequest;
use App\Http\Requests\UpdateProduksiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class ProduksiController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $produksi = Produksi::all();
        return view('produksi.view',
                    [
                        'produksi' => $produksi
                    ]
                  );
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // berikan kode produksi secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        $distributor = Distributor::orderBy('distributor_nama')->get(); 
        $distributors = $distributor; // Declare the $distributors variable

        return view('produksi/create', ['produksi_kode' => Produksi::getkodeproduksi(), 'distributors' => $distributors]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProduksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduksiRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'produksi_kode' => 'required',
            'tanggal_produksi' => 'required',
        ]);

        // masukkan ke db
        Produksi::create($request->all());
        
        return redirect()->route('produksi.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function show(Produksi $produksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProduksiRequest  $request
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProduksiRequest $request, Produksi $produksi)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'produksi_kode' => 'required',
        ]);
    
        $produksi->update($validated);
    
        return redirect()->route('produksi.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produksi  $produksi
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Produksi $produksi)
    public function destroy($id)
    {
        //hapus dari database
        $produksi = Produksi::findOrFail($id);
        $produksi->delete();

        return redirect()->route('produksi.index')->with('success','Data Berhasil di Hapus');
    }

    public function approve($id)
    {
        // Update the status to approved
        DB::table('produksi')->where('id', $id)->update(['status' => 'approved']);
    
        // Get the details of the approved produksi
        $details = DB::table('produksi_detail')
            ->where('produksi_kode', function($query) use ($id) {
                $query->select('produksi_kode')
                    ->from('produksi')
                    ->where('id', $id);
            })->get();
    
        foreach ($details as $detail) {
            // Update the kuantitas in the produk table
            DB::table('produk')->where('produk_kode', $detail->produk_kode)
                ->increment('produk_stok', $detail->kuantitas);
    
            // Update the bahanbaku_stok in the bahanbaku table
            $bahanbaku_kode = DB::table('produk_detail')
                ->where('produk_kode', $detail->produk_kode)
                ->value('bahanbaku_kode');
    
            DB::table('bahanbaku')->where('bahanbaku_kode', $bahanbaku_kode)
                ->decrement('bahanbaku_stok', $detail->kuantitas);
        }
    
        return redirect()->back()->with('success', 'Produksi berhasil diapprove');
    }
    
}
