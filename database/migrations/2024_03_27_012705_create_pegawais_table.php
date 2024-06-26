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

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
