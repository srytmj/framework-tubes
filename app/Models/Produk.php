<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    // protected $primaryKey = 'produk_kode';
    protected $fillable = [
        'produk_kode',
        'produk_nama',
        'produk_jenis',
        'produk_harga',
    ];
    // query nilai max dari kode distributor untuk generate otomatis kode distributor
    public static function getProdukId()
    {
        // query kode distributor
        $sql = "SELECT IFNULL(MAX(produk_kode), 'PD-000') as produk_kode 
                FROM produk";
        $produkid = DB::select($sql);

        // cacah hasilnya
        foreach ($produkid as $idcst) {
            $kd = $idcst->produk_kode;
        }
        // Mengambil substring tiga digit akhir dari string DR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string DR-001
        $noakhir = 'PD-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
    
    public function produkdetails() {
        return $this->hasMany(ProdukDetail::class);
    }
}
