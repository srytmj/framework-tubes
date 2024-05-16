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

        // Insert into penjualan
        DB::table('penjualan')->insert([
            'transaksi_no' => 'FK-0001',
            'id_customer' => 1,
            'tgl_transaksi' => now(),
            'tgl_expired' => now()->addDays(7),
            'total_harga' => 100000,
            'status' => 'selesai',
        ]);


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

        // Insert into penjualan_detail
        DB::table('penjualan_detail')->insert([
            [
                'transaksi_no' => 'FK-0001',
                'produk_id' => 18,
                'produk_harga' => 15000,
                'produk_qty' => 3,
                'total' => 45000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7),
            ],
            [
                'transaksi_no' => 'FK-0001',
                'produk_id' => 3,
                'produk_harga' => 35000,
                'produk_qty' => 1,
                'total' => 35000,
                'tgl_transaksi' => now(),
                'tgl_expired' => now()->addDays(7)
            ]
    ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
