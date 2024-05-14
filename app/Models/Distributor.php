<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Distributor extends Model
{
    use HasFactory;
    protected $table = 'distributor';
    // list kolom yang bisa diisi
    protected $fillable = ['distributor_kode','distributor_nama','alamat_distributor'];

    // query nilai max dari kode distributor untuk generate otomatis kode distributor
    public static function getKodeDistributor()
    {
        // query kode distributor
        $sql = "SELECT IFNULL(MAX(distributor_kode), 'DR-000') as distributor_kode 
                FROM distributor";
        $kodedistributor = DB::select($sql);

        // cacah hasilnya
        foreach ($kodedistributor as $kdprsh) {
            $kd = $kdprsh->distributor_kode;
        }
        // Mengambil substring tiga digit akhir dari string PR-000
        $noawal = substr($kd,-3);
        $noakhir = $noawal+1; //menambahkan 1, hasilnya adalah integer cth 1
        
        //menyambung dengan string PR-001
        $noakhir = 'PR-'.str_pad($noakhir,3,"0",STR_PAD_LEFT); 

        return $noakhir;

    }
}
