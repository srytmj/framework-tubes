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
                'kode_akun' => '1101',
                'nama_akun' => 'Kas',
                'header_akun' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '1102',
                'nama_akun' => 'Bank',
                'header_akun' => '1',
                'distributor_kode' => 'DS001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '1201',
                'nama_akun' => 'Piutang Usaha',
                'header_akun' => '1',
                'distributor_kode' => 'DS001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '2101',
                'nama_akun' => 'Utang Usaha',
                'header_akun' => '2',
                'distributor_kode' => 'DS001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '3101',
                'nama_akun' => 'Modal Saham',
                'header_akun' => '3',
                'distributor_kode' => 'DS001',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
