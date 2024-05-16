<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukProduksi extends Model
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
    
    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public function bahanbaku() {
        return $this->belongsTo(BahanBaku::class);
    }
    
}
