<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BahanbakuPembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'bahanbaku_pembelian_detail';
    // list kolom yang bisa diisi
    protected $fillable = ['bahanbaku_pembelian_kode','bahanbaku_kode', 'harga_satuan', 'kuantitas', 'total'];
}
