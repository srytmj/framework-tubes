<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contohform', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_dokumen',20);
            $table->string('gambar_dokumen',20);
            $table->date('tgl_rilis');
            $table->string('klasifikasi_dokumen',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contohform');
    }
};
