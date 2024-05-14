<?php

namespace App\Http\Controllers;

use App\Models\PegawaiPenggajian;
use App\Models\Pegawai;

use App\Http\Requests\StorePegawaiPenggajianRequest;
use App\Http\Requests\UpdatePegawaiPenggajianRequest;
use Illuminate\Support\Facades\DB;

class PegawaiPenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gajiPegawai = DB::table('pegawai_penggajian')
        ->join('pegawai', 'pegawai_penggajian.pegawai_id', '=', 'pegawai.pegawai_id')
        ->select('pegawai_penggajian.id', 'pegawai_penggajian.periode', 'pegawai.pegawai_nama', 'pegawai.pegawai_jabatan', 'pegawai_penggajian.gaji')
        ->get();

        return view('pegawaipenggajian.view', compact('gajiPegawai'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiPenggajianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        return view('pegawaipenggajian/create',['pegawai' => Pegawai::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiPenggajianRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePegawaiPenggajianRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pegawai_id' => 'required',
            'periode' => 'required',
            'gaji' => 'required',
        ]);

        // generate pegawai_penggajian_id
        $pegawai_penggajian_id = $request->pegawai_id . '_' . $request->periode;
        $periode = $request->periode . '-01';

        // masukkan ke db
        PegawaiPenggajian::create([
            'pegawai_penggajian_id' => $pegawai_penggajian_id,
            'pegawai_id' => $request->pegawai_id,
            'periode' => $periode,
            'gaji' => $request->gaji,
        ]);
        
        return redirect()->route('pegawaipenggajian.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PegawaiPenggajian  
     * @return \Illuminate\Http\Response
     */
    public function show(PegawaiPenggajian $pegawaipenggajian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PegawaiPenggajian  
     * @return \Illuminate\Http\Response
     */
    public function edit(PegawaiPenggajian $pegawaipenggajian)
    {
        return view('pegawaipenggajian.edit', compact('pegawaipenggajian'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \App\Http\Requests\UpdatePegawaiPenggajianRequest  $request
     * @param  \App\Models\PegawaiPenggajian  
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePegawaiPenggajianRequest $request, PegawaiPenggajian $pegawaipenggajian)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'pegawai_id' => 'required',
            'periode' => 'required',
            'gaji' => 'required',
        ]);  

        $pegawaipenggajian->update($validated);
    
        return redirect()->route('pegawaipenggajian.index')->with('success','Data Berhasil di Ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PegawaiPenggajian  $distributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //hapus dari database
        $pegawaipenggajian = PegawaiPenggajian::findOrFail($id);
        $pegawaipenggajian->delete();

        return redirect()->route('pegawaipenggajian.index')->with('success','Data Berhasil di Hapus');
    }
    
}
