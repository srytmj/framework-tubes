<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bahanbaku', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bahanbaku_kode', 6)->nullable();
            $table->string('bahanbaku_nama', 50)->nullable();
            $table->string('bahanbaku_jenis', 50)->nullable();
            $table->string('bahanbaku_satuan', 10)->nullable();
            $table->integer('bahanbaku_stok')->default(0);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahanbaku');
    }
    
};
