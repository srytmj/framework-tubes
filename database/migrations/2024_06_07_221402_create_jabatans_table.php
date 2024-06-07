<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan_id', 6)->nullable();
            $table->string('jabatan_nama')->nullable();
            $table->integer('tarif_perjam')->default(0);        
            $table->timestamps();
        });
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};
