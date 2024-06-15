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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbaku_pembelian_detail');
    }
};
