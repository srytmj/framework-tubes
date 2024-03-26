<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('pelanggan.view', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return view('pelanggan/create',['pelanggan_id' => Pelanggan::getPelangganId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pelanggan_id' => 'required',
            'pelanggan_nama' => 'required',
            'pelanggan_no_telepon' => 'required',
            'pelanggan_alamat' => 'required',
            'pelanggan_jenis_kelamin' => 'required',
        ]);

        // masukkan ke db
        Pelanggan::create($request->all());
        
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Input');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdatePelangganRequest  $request
     * @param  \App\Models\Pelanggan  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pelanggan_id' => 'required',
            'pelanggan_nama' => 'required',
            'pelanggan_no_telepon' => 'required',
            'pelanggan_alamat' => 'required',
            'pelanggan_jenis_kelamin' => 'required',
        ]);    

        $pelanggan->update($validated);
    
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        //hapus dari database
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success','Data Berhasil di Hapus');
    }
    
}
