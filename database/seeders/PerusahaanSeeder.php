<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert some data
        DB::table('perusahaan')->insert([
            'kode_perusahaan' => 'PR-001',
            'nama_perusahaan' => 'Pecel Lele Sehat Sentosa',
            'alamat_perusahaan' => 'Jl. Raya Yang Tak Kunjung Sepi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
