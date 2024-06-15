<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            [
                'jabatan_id' => 'JOB001',
                'jabatan_nama' => 'Koki',
                'tarif_perjam' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan_id' => 'JOB002',
                'jabatan_nama' => 'Pelayan',
                'tarif_perjam' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan_id' => 'JOB003',
                'jabatan_nama' => 'Kasir',
                'tarif_perjam' => 18000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan_id' => 'JOB004',
                'jabatan_nama' => 'Manajer',
                'tarif_perjam' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan_id' => 'JOB005',
                'jabatan_nama' => 'Petugas Kebersihan',
                'tarif_perjam' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'jabatan_id' => 'JOB006',
                'jabatan_nama' => 'Staf Gudang',
                'tarif_perjam' => 16000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
