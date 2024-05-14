<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class BahanbakuPembelian extends Model
{
    use HasFactory;
    protected $table = 'bahanbaku_pembelian';
    // list kolom yang bisa diisi
    protected $fillable = ['bahanbaku_pembelian_kode','distributor_kode'];

    // query nilai max dari kode bahanbakupembelian untuk generate otomatis kode bahanbakupembelian
    public static function getKodebahanbakupembelian()
    {
        // query kode bahanbakupembelian
        $sql = "SELECT IFNULL(MAX(bahanbaku_pembelian_kode), 'BBP-000') as bahanbaku_pembelian_kode 
                FROM bahanbaku_pembelian";
        $kodebahanbakupembelian = DB::select($sql);

        // cacah hasilnya
        foreach ($kodebahanbakupembelian as $kdprsh) {
            $kd = $kdprsh->bahanbaku_pembelian_kode;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'BBP'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
