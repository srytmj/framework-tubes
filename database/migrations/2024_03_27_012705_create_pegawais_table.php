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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_id') -> unique();
            $table->string('pegawai_nama'); 
            $table->string('pegawai_no_telepon'); 
            $table->text('pegawai_alamat'); 
            $table->enum('pegawai_jenis_kelamin', ['L', 'P']);
            $table->string('pegawai_jabatan')->default('Serabutan');
            $table->timestamps();
        });

        DB::table('pegawai')->insert([
            [
                'pegawai_id' => 'PG001',
                'pegawai_nama' => 'Bakti Surya Atmaja',
                'pegawai_no_telepon' => '081',
                'pegawai_alamat' => 'Jl. Merdeka No.1',
                'pegawai_jenis_kelamin' => 'L',
                'pegawai_jabatan' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG002',
                'pegawai_nama' => 'Budi Santoso',
                'pegawai_no_telepon' => '081234567891',
                'pegawai_alamat' => 'Jl. Kebangsaan No.2',
                'pegawai_jenis_kelamin' => 'L',
                'pegawai_jabatan' => 'Pelayan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG003',
                'pegawai_nama' => 'Citra Dewi',
                'pegawai_no_telepon' => '081234567892',
                'pegawai_alamat' => 'Jl. Pancasila No.3',
                'pegawai_jenis_kelamin' => 'P',
                'pegawai_jabatan' => 'Kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG004',
                'pegawai_nama' => 'Dian Pratama',
                'pegawai_no_telepon' => '081234567893',
                'pegawai_alamat' => 'Jl. Bhineka No.4',
                'pegawai_jenis_kelamin' => 'P',
                'pegawai_jabatan' => 'Manajer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG005',
                'pegawai_nama' => 'Eka Putra',
                'pegawai_no_telepon' => '081234567894',
                'pegawai_alamat' => 'Jl. Persatuan No.5',
                'pegawai_jenis_kelamin' => 'L',
                'pegawai_jabatan' => 'Petugas Kebersihan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pegawai_id' => 'PG006',
                'pegawai_nama' => 'Ahmad Fauzi',
                'pegawai_no_telepon' => '081234567890',
                'pegawai_alamat' => 'Jl. Merdeka No.1',
                'pegawai_jenis_kelamin' => 'L',
                'pegawai_jabatan' => 'Koki',
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
        Schema::dropIfExists('pegawai');
    }
};
