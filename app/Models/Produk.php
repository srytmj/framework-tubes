<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    // protected $primaryKey = 'kode_produk';
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'jenis_produk',
        'harga_produk',
    ];
    // query nilai max dari kode perusahaan untuk generate otomatis kode perusahaan
    public static function getProdukId()
    {
        // query kode perusahaan
        $sql = "SELECT IFNULL(MAX(kode_produk), 'PD-000') as kode_produk 
                FROM produk";
        $produkid = DB::select($sql);

        // cacah hasilnya
        foreach ($produkid as $idcst) {
            $kd = $idcst->kode_produk;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PD-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }}
