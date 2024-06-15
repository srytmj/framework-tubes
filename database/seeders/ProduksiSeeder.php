<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        DB::table('produksi')->insert([
            [
                'produksi_kode' => 'PRS001',
                'tanggal_produksi' => '2024-05-01',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('produk_detail')->insert([
            [
                'produk_kode' => 'PR001',
                'bahanbaku_kode' => 'BB013',
                'jumlah' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
