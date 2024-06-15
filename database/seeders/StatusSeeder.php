<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_pemesanan')->insert([
            [
                'status' => 'pesan',
                'deskripsi' => 'Pemesanan Produk',
            ],
            [
                'status' => 'siap_bayar',
                'deskripsi' => 'Checkout',
            ],
            [
                'status' => 'konfirmasi_bayar',
                'deskripsi' => 'Konfirmasi Pembayaran',
            ],
            [
                'status' => 'selesai',
                'deskripsi' => 'Pesanan Selesai',
            ],
            [
                'status' => 'expired',
                'deskripsi' => 'Pesanan Expired',
            ]
        ]);
    }
}
