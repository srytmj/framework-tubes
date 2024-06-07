<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Http\Requests\StoreJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('jabatan.view', compact('jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StoreJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return view('jabatan/create',['jabatan_id' => Jabatan::getJabatanId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJabatanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJabatanRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'jabatan_id' => 'required',
            'jabatan_nama' => 'required',
            'tarif_perjam' => 'required',
        ]);

        // masukkan ke db
        Jabatan::create($request->all());
        
        return redirect()->route('jabatan.index')->with('success','Data Berhasil di Input');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdateJabatanRequest  $request
     * @param  \App\Models\Jabatan  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJabatanRequest $request, Jabatan $jabatan)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'jabatan_id' => 'required',
            'jabatan_nama' => 'required',
            'tarif_perjam' => 'required',
        ]);    

        $jabatan->update($validated);
    
        return redirect()->route('jabatan.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan.index')->with('success','Data Berhasil di Hapus');
    }
    
}
