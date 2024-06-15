<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('distributor')->insert([
            [
                'distributor_kode' => 'DS001',
                'distributor_nama' => 'Distributor Utama',
                'distributor_alamat' => 'Jl. Raya No.1, Jakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS002',
                'distributor_nama' => 'Distribusi Nusantara',
                'distributor_alamat' => 'Jl. Merdeka No.45, Bandung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS003',
                'distributor_nama' => 'PT Sumber Berkah',
                'distributor_alamat' => 'Jl. Kemerdekaan No.23, Surabaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS004',
                'distributor_nama' => 'Distribusi Sejahtera',
                'distributor_alamat' => 'Jl. Pahlawan No.8, Yogyakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS005',
                'distributor_nama' => 'PT Mitra Bersama',
                'distributor_alamat' => 'Jl. Perdamaian No.12, Semarang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
