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
        'distributor_kode',
    ];

    // untuk melihat data coa dan nama distributor
    public static function getCoaDetailDistributor()
    {
        // query kode distributor
        $sql = "SELECT a.*,b.distributor_nama
                FROM coa a
                JOIN distributor b
                ON (a.distributor_kode=b.id)";
        $coa = DB::select($sql);

        return $coa;

    }
    
}
