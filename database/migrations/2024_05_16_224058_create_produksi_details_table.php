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
        Schema::create('produksi_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produksi_kode', 6)->nullable();
            $table->string('produk_kode', 6)->nullable();
            $table->integer('kuantitas')->default(0);
            $table->timestamps(0);
        });

        DB::table('produksi_detail')->insert([
            [
                'produksi_kode' => 'PRS001',
                'produk_kode' => 'PR001',
                'kuantitas' => '3',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi_detail');
    }
};
