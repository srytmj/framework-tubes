<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coa')->insert([
            [
                'kode_akun' => '111',
                'nama_akun' => 'Kas',
                'header_akun' => '1',
                'id_perusahaan' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '112',
                'nama_akun' => 'Bank',
                'header_akun' => '1',
                'id_perusahaan' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '411',
                'nama_akun' => 'Pendapatan',
                'header_akun' => '4',
                'id_perusahaan' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '511',
                'nama_akun' => 'Beban Gaji',
                'header_akun' => '5',
                'id_perusahaan' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '121',
                'nama_akun' => 'Persediaan Bahan Baku',
                'header_akun' => '1',
                'id_perusahaan' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
