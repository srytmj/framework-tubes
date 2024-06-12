<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::join('users', 'pegawai.id', '=', 'users.id')->get();
        return view('pegawai.view', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        $jabatans = Jabatan::all();
        return view('pegawai/create',['pegawai_id' => Pegawai::getPegawaiId(), 'jabatans' => $jabatans]);
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
        $pegawai = $request->validate([
            'pegawai_id' => 'required',
            'pegawai_nama' => 'required',
            'pegawai_no_telepon' => 'required',
            'pegawai_alamat' => 'required',
            'pegawai_jenis_kelamin' => 'required',
            'pegawai_jabatan' => 'required',
        ]);

        $user = $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        // masukkan ke db


        $user = User::create([
            'name' => $pegawai['pegawai_nama'],
            'email' => $user['email'],
            'password' => Hash::make($user['password']),
            'role' => $pegawai['pegawai_jabatan'],
        ]);

        Pegawai::create([
            'pegawai_id' => $pegawai['pegawai_id'],
            'pegawai_nama' => $pegawai['pegawai_nama'],
            'pegawai_no_telepon' => $pegawai['pegawai_no_telepon'],
            'pegawai_alamat' => $pegawai['pegawai_alamat'],
            'pegawai_jenis_kelamin' => $pegawai['pegawai_jenis_kelamin'],
            'pegawai_jabatan' => $pegawai['pegawai_jabatan'],
            'user_id' => $user->id,
        ]);


        return redirect()->route('pegawai.index')->with('success','Data Berhasil di Input');    
    }

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
