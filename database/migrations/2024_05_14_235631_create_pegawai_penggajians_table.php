<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pegawai_penggajian', function (Blueprint $table) {
            $table->id();
            $table->string('pegawai_penggajian_id');
            $table->string('pegawai_id');
            $table->date('periode');
            $table->integer('jam_kerja');
            $table->integer('gaji');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_penggajian');
    }
};
