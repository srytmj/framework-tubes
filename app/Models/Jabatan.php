<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $fillable = [
        'jabatan_id',
        'jabatan_nama',
        'tarif_perjam',
    ];
    public static function getJabatanId()
    {
        // query kode distributor
        $sql = "SELECT IFNULL(MAX(jabatan_id), 'JOB-000') as jabatan_id
                FROM jabatan";
        $jabatanid = DB::select($sql);

        // cacah hasilnya
        foreach ($jabatanid as $idjob) {
            $kd = $idjob->jabatan_id;
        }
        // Mengambil substring tiga digit akhir dari string DR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string DR-001
        $noakhir = 'JOB-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }

}
