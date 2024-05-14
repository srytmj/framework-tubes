<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('distributor', function (Blueprint $table) {
            $table->id();
            $table->string('distributor_kode', 6) -> unique();
            $table->string('distributor_nama', 30) -> unique();
            $table->string('alamat_distributor');
            $table->timestamps();
        });

        DB::table('distributor')->insert([
            [
                'distributor_kode' => 'DS001',
                'distributor_nama' => 'Distributor Utama',
                'alamat_distributor' => 'Jl. Raya No.1, Jakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS002',
                'distributor_nama' => 'Distribusi Nusantara',
                'alamat_distributor' => 'Jl. Merdeka No.45, Bandung',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS003',
                'distributor_nama' => 'PT Sumber Berkah',
                'alamat_distributor' => 'Jl. Kemerdekaan No.23, Surabaya',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS004',
                'distributor_nama' => 'Distribusi Sejahtera',
                'alamat_distributor' => 'Jl. Pahlawan No.8, Yogyakarta',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'distributor_kode' => 'DS005',
                'distributor_nama' => 'PT Mitra Bersama',
                'alamat_distributor' => 'Jl. Perdamaian No.12, Semarang',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributor');
    }
};
