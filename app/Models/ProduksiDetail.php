<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduksiDetail extends Model
{
    use HasFactory;

    protected $table = 'produksi_detail';
    // list kolom yang bisa diisi
    protected $fillable = [
        'produksi_kode',
        'produk_kode', 
        'kuantitas', 
        'total'
    ];
}
