<?php

namespace App\Http\Controllers;

use App\Models\BahanbakuPembelian;
use App\Models\Distributor;
use App\Http\Requests\StoreBahanbakuPembelianRequest;
use App\Http\Requests\UpdateBahanbakuPembelianRequest;

use Illuminate\Foundation\Http\FormRequest;

class BahanbakuPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $bahanbakupembelian = BahanbakuPembelian::all();
        return view('bahanbakupembelian.view',
                    [
                        'bahanbakupembelian' => $bahanbakupembelian
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
        // berikan kode bahanbakupembelian secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        $distributor = Distributor::orderBy('distributor_nama')->get(); 
        $distributors = $distributor; // Declare the $distributors variable

        return view('bahanbakupembelian/create', ['bahanbaku_pembelian_kode' => BahanbakuPembelian::getKodebahanbakupembelian(), 'distributors' => $distributors]);
        // return view('bahanbakupembelian/view');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBahanbakuPembelianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBahanbakuPembelianRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'bahanbaku_pembelian_kode' => 'required',
        ]);

        // masukkan ke db
        BahanbakuPembelian::create($request->all());
        
        return redirect()->route('bahanbakupembelian.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BahanbakuPembelian  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    public function show(BahanbakuPembelian $bahanbakupembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BahanbakuPembelian  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    public function detail(BahanbakuPembelian $bahanbakupembelian)
    {
        return view('bahanbakupembelian.detail', compact('bahanbakupembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBahanbakuPembelianRequest  $request
     * @param  \App\Models\BahanbakuPembelian  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBahanbakuPembelianRequest $request, BahanbakuPembelian $bahanbakupembelian)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'bahanbaku_pembelian_kode' => 'required',
        ]);
    
        $bahanbakupembelian->update($validated);
    
        return redirect()->route('bahanbakupembelian.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BahanbakuPembelian  $bahanbakupembelian
     * @return \Illuminate\Http\Response
     */
    // public function destroy(BahanbakuPembelian $bahanbakupembelian)
    public function destroy($id)
    {
        //hapus dari database
        $bahanbakupembelian = BahanbakuPembelian::findOrFail($id);
        $bahanbakupembelian->delete();

        return redirect()->route('bahanbakupembelian.index')->with('success','Data Berhasil di Hapus');
    }
}
