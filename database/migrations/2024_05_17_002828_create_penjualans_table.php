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
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaksi_no');
            $table->integer('id_customer');
            $table->datetime('tgl_transaksi', precision: 0);
            $table->datetime('tgl_expired');
            $table->integer('total_harga');
            $table->string('status');
            // $table->timestamps();
        });

        Schema::create('penjualan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaksi_no');
            $table->integer('produk_id');
            $table->integer('produk_harga');
            $table->integer('produk_qty');
            $table->integer('total');
            $table->datetime('tgl_transaksi');
            $table->datetime('tgl_expired');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
