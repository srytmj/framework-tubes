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
        Schema::create('bahanbaku_pembelian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bahanbaku_pembelian_kode', 6)->nullable();
            $table->string('distributor_kode', 50)->nullable();
            $table->string('status')->default('unconfirmed');
            $table->timestamps(0);
        });

        DB::table('bahanbaku_pembelian')->insert([
            [
                'bahanbaku_pembelian_kode' => 'BBP001',
                'distributor_kode' => 'DS004',
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
        Schema::dropIfExists('bahanbaku_pembelian');
    }
};
