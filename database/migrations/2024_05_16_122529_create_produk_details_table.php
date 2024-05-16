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
        Schema::create('produk_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produk_kode');
            $table->string('bahanbaku_kode');
            $table->integer('jumlah');
            $table->timestamps();
        });

        DB::table('produk_detail')->insert([
            [
                'produk_kode' => 'PR001',
                'bahanbaku_kode' => 'BB027',
                'jumlah' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_detail');
    }
};
