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
        Schema::create('produksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('produksi_kode', 6)->nullable();
            $table->date('tanggal_produksi');
            $table->string('status')->default('unconfirmed');
            $table->timestamps(0);
        });

        DB::table('produksi')->insert([
            [
                'produksi_kode' => 'PRS001',
                'tanggal_produksi' => '2024-05-01',
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
        Schema::dropIfExists('produksi');
    }
};
