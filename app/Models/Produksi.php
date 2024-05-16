<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produksi extends Model
{
    use HasFactory;

    protected $table = 'produksi';
    // protected $primaryKey = 'produk_kode';
    protected $fillable = [
        'produksi_kode',
        'tanggal_produksi',
    ];    

    // query nilai max dari kode bahanbakupembelian untuk generate otomatis kode bahanbakupembelian
    public static function getkodeproduksi()
    {
        // query kode bahanbakupembelian
        $sql = "SELECT IFNULL(MAX(produksi_kode), 'PRS-000') as produksi_kode 
                FROM produksi";
        $kodebahanbakupembelian = DB::select($sql);

        // cacah hasilnya
        foreach ($kodebahanbakupembelian as $kdprsh) {
            $kd = $kdprsh->produksi_kode;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PRS'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
