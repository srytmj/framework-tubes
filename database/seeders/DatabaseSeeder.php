<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BahanBakuSeeder::class);
        $this->call(CoaSeeder::class);
        $this->call(DistributorSeeder::class);
        $this->call(JabatanSeeder::class);
        $this->call(JurnalSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(PembelianSeeder::class);
        $this->call(PenjualanSeeder::class);
        $this->call(PerusahaanSeeder::class);
        $this->call(PgpenjualanSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(ProduksiSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
    }
}
