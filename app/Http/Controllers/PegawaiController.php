<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        return view('pegawai.view', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return view('pegawai/create',['pegawai_id' => Pegawai::getPegawaiId()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pegawai_id' => 'required',
            'pegawai_nama' => 'required',
            'pegawai_no_telepon' => 'required',
            'pegawai_alamat' => 'required',
            'pegawai_jenis_kelamin' => 'required',
            'pegawai_jabatan' => 'required',
        ]);

        // masukkan ke db
        Pegawai::create($request->all());
        
        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Input');    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pegawai_id' => 'required',
            'pegawai_nama' => 'required',
            'pegawai_no_telepon' => 'required',
            'pegawai_alamat' => 'required',
            'pegawai_jenis_kelamin' => 'required',
            'pegawai_jabatan' => 'required',
        ]);    

        $pegawai->update($validated);
    
        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Hapus');
    }
    
}
