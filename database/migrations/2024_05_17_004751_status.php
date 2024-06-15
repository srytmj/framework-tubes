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
        Schema::create('status_transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaksi_no');
            $table->integer('id_customer');
            $table->string('status');
            $table->date('waktu');
        });

        Schema::create('status_pemesanan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status');
            $table->string('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
