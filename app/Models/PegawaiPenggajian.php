<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiPenggajian extends Model
{
    use HasFactory;

    protected $table = 'pegawai_penggajian';

    protected $fillable = [
        'pegawai_penggajian_id',
        'pegawai_id',
        'periode',
        'jam_kerja',
        'gaji',
    ];

    // public function pegawai()
    // {
    //     return $this->belongsTo(Pegawai::class);
    // }
}