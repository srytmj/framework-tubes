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
        Schema::create('bahanbaku_pembelian_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bahanbaku_pembelian_kode', 6)->nullable();
            $table->string('bahanbaku_kode', 6)->nullable();
            $table->integer('harga_satuan')->nullable();
            $table->integer('kuantitas')->default(0);
            $table->timestamps(0);
        });

        // DB::table('bahanbaku_pembelian_detail')->insert([
        //     [
        //         'bahanbaku_pembelian_kode' => 'BBP001',
        //         'bahanbaku_kode' => 'BB016',
        //         'harga_satuan' => '10000',
        //         'kuantitas' => '100',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbaku_pembelian_detail');
    }
};
