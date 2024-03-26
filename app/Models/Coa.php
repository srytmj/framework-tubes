<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Coa extends Model
{
    // use HasFactory;
    protected $table = 'coa';

    // untuk melist kolom yang dapat diisi
    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'header_akun',
        'id_perusahaan',
    ];

    // untuk melihat data coa dan nama perusahaan
    public static function getCoaDetailPerusahaan()
    {
        // query kode perusahaan
        $sql = "SELECT a.*,b.nama_perusahaan
                FROM coa a
                JOIN perusahaan b
                ON (a.id_perusahaan=b.id)";
        $coa = DB::select($sql);

        return $coa;

    }
    
}
