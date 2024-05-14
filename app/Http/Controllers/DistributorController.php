<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use App\Http\Requests\StoreDistributorRequest;
use App\Http\Requests\UpdateDistributorRequest;

use Illuminate\Foundation\Http\FormRequest;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //query data
        $distributor = Distributor::all();
        return view('distributor.view',
                    [
                        'distributor' => $distributor
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
        // berikan kode distributor secara otomatis
        // 1. query dulu ke db, select max untuk mengetahui posisi terakhir 
        
        return view('distributor/create', ['distributor_kode' => Distributor::getKodeDistributor()]);
        // return view('distributor/view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDistributorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistributorRequest $request)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru disimpan ke db
        $validated = $request->validate([
            'distributor_kode' => 'required',
            'distributor_nama' => 'required|unique:distributor|min:5|max:255',
            'distributor_alamat' => 'required',
        ]);

        // masukkan ke db
        Distributor::create($request->all());
        
        return redirect()->route('distributor.index')->with('success','Data Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function show(Distributor $distributor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function edit(Distributor $distributor)
    {
        return view('distributor.edit', compact('distributor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDistributorRequest  $request
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistributorRequest $request, Distributor $distributor)
    {
        //digunakan untuk validasi kemudian kalau ok tidak ada masalah baru diupdate ke db
        $validated = $request->validate([
            'distributor_kode' => 'required',
            'distributor_nama' => 'required|max:255',
            'distributor_alamat' => 'required',
        ]);
    
        $distributor->update($validated);
    
        return redirect()->route('distributor.index')->with('success','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distributor  $distributor
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Distributor $distributor)
    public function destroy($id)
    {
        //hapus dari database
        $distributor = Distributor::findOrFail($id);
        $distributor->delete();

        return redirect()->route('distributor.index')->with('success','Data Berhasil di Hapus');
    }
}
