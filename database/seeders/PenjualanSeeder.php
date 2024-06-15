<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert into penjualan
        DB::table('penjualan')->insert([
            'transaksi_no' => 'FK-0001',
            'id_customer' => 1,
            'tgl_transaksi' => now(),
            'tgl_expired' => now()->addDays(7),
            'total_harga' => 100000,
            'status' => 'selesai',
        ]);

        // Insert into penjualan_detail
        DB::table('penjualan_detail')->insert([
            [
                'transaksi_no' => 'FK-0001',
                'produk_id' => 18,
                'produk_harga' => 15000,
                'produk_qty' => 3,
                'total' => 45000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7),
            ],
            [
                'transaksi_no' => 'FK-0001',
                'produk_id' => 3,
                'produk_harga' => 35000,
                'produk_qty' => 1,
                'total' => 35000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7)
            ]
        ]);
    }
}
