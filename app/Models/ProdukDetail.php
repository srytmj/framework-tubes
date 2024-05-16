<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDetail extends Model
{
    use HasFactory;

    protected $table = 'produk_detail';
    
    // protected $primaryKey = 'produk_kode';
    protected $fillable = [
        'produk_kode',
        'produk_nama',
        'produk_jenis',
        'produk_harga',
    ];}
