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
        // Validasi input menggunakan StorePegawaiPenggajianRequest
        $validated = $request->validated();
    
        // Generate pegawai_penggajian_id
        $pegawai_penggajian_id = $request->pegawai_id . '_' . $request->periode;
        $periode = $request->periode . '-01';
    
        // Periksa apakah data sudah ada
        $existingPenggajian = PegawaiPenggajian::where('pegawai_id', $request->pegawai_id)
            ->where('periode', $periode)
            ->exists();
    
        // Jika data sudah ada, kembalikan dengan pesan error
        if ($existingPenggajian) {
            return redirect()->back()->with('error', 'Data penggajian untuk pegawai pada periode ini sudah ada.');
        }
    
        // Jika tidak ada, lanjutkan menyimpan data
        // Masukkan ke dalam database
        $penggajian = PegawaiPenggajian::create([
            'pegawai_penggajian_id' => $pegawai_penggajian_id,
            'pegawai_id' => $request->pegawai_id,
            'periode' => $periode,
            'jam_kerja' => $request->jam_kerja,
            'gaji' => $request->gaji,
        ]);
    
        // Query untuk mendapatkan nilai nominal transaksi
        $data_penggajian = DB::table('pegawai_penggajian')->where('id', $penggajian->id)->first();
    
        // Catat ke jurnal
        DB::table('jurnal')->insert([
            'transaksi_id' => $data_penggajian->id,
            'id_perusahaan' => 1,
            'kode_akun' => '511',
            'tgl_jurnal' => now(),
            'posisi_d_c' => 'd',
            'nominal' => $request->gaji,
            'kelompok' => 5,
            'transaksi' => 'penggajian',
        ]);
    
        DB::table('jurnal')->insert([
            'transaksi_id' => $data_penggajian->id,
            'id_perusahaan' => 1,
            'kode_akun' => '111',
            'tgl_jurnal' => now(),
            'posisi_d_c' => 'c',
            'nominal' => $request->gaji,
            'kelompok' => 1,
            'transaksi' => 'penggajian',
        ]);
    
        // Redirect dengan pesan sukses
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
        $pegawai_nama = Pegawai::where('pegawai_id', $pegawaipenggajian->pegawai_id)->first()->pegawai_nama;
        return view('pegawaipenggajian.edit', ['pegawai' => Pegawai::all(), 'pegawaipenggajian' => $pegawaipenggajian, 'pegawai_nama' => $pegawai_nama]);
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
            'jam_kerja' => 'required',
            'gaji' => 'required',
        ]);  
        
        // Perbarui data PegawaiPenggajian
        $pegawaipenggajian->update($validated);
    
        // Perbarui kolom 'nominal' pada tabel 'jurnal'
        DB::table('jurnal')
            ->where('transaksi_id', $pegawaipenggajian->id)
            ->where('transaksi', 'penggajian')
            ->update(['nominal' => $request->gaji]);
    
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
        // Hapus data dari tabel PegawaiPenggajian
        $pegawaipenggajian = PegawaiPenggajian::findOrFail($id);
        $pegawaipenggajian->delete();
    
        // Hapus data dari tabel jurnal yang memiliki transaksi_id sama dengan $id dan transaksi adalah "penggajian"
        DB::table('jurnal')
            ->where('transaksi_id', $id)
            ->where('transaksi', 'penggajian')
            ->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('pegawaipenggajian.index')->with('success','Data Berhasil di Hapus');
    }
    
}
