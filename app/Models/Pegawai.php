<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRole;

class Pegawai extends Model
{
    use HasFactory, HasRole;

    protected $table = 'pegawai';
    // protected $primaryKey = 'pegawai_id';
    protected $fillable = [
        'pegawai_id',
        'pegawai_nama',
        'pegawai_no_telepon',
        'pegawai_alamat',
        'pegawai_jenis_kelamin',
        'pegawai_jabatan',

    ];
    // query nilai max dari kode distributor untuk generate otomatis kode distributor
    public static function getPegawaiId()
    {
        // query kode distributor
        $sql = "SELECT IFNULL(MAX(pegawai_id), 'PGW-000') as pegawai_id 
                FROM pegawai";
        $pegawaiid = DB::select($sql);

        // cacah hasilnya
        foreach ($pegawaiid as $idcst) {
            $kd = $idcst->pegawai_id;
        }
        // Mengambil substring tiga digit akhir dari string DR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string DR-001
        $noakhir = 'PGW-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }

}
