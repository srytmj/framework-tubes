<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JurnalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some data
        DB::table('jurnal')->insert(
            [
                [
                    'transaksi_id' => 1,
                    'id_perusahaan' => 1,
                    'kode_akun' => '111',
                    'tgl_jurnal' => '2024-05-17 00:00:00',
                    'posisi_d_c' => 'd',
                    'nominal' => 1000000,
                    'kelompok' => '1',
                    'transaksi' => 'penjualan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'transaksi_id' => 1,
                    'id_perusahaan' => 1,
                    'kode_akun' => '411',
                    'tgl_jurnal' => '2024-05-17 00:00:00',
                    'posisi_d_c' => 'c',
                    'nominal' => 1000000,
                    'kelompok' => '1',
                    'transaksi' => 'penjualan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]
        );
    }
}
