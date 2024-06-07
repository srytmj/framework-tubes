<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.view', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return view('produk/create',['produk_kode' => Produk::getProdukId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'produk_kode' => 'required',
            'produk_nama' => 'required',
            'produk_jenis' => 'required',
            'produk_harga' => 'required',
            'produk_foto' => 'file|required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $file = $request->file('produk_foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'fotoproduk';
        $file->move($tujuan_upload,$fileName);

        $validated['produk_foto'] = $fileName;

        // masukkan ke db
        Produk::create($request->all());
        
        return redirect()->route('produk.index')->with('success','Data Berhasil di Input');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'produk_kode' => 'required',
            'produk_nama' => 'required',
            'produk_jenis' => 'required',
            'produk_harga' => 'required',
            'produk_foto' => 'file|required|image|mimes:jpeg,png,jpg|max:2048'
        ]);    

        $file = $request->file('produk_foto');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'fotoproduk';
        $file->move($tujuan_upload,$fileName);

        $validated['produk_foto'] = $fileName;
        
        $produk->update($validated);
    
        return redirect()->route('produk.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success','Data Berhasil di Hapus');
    }
    
}
