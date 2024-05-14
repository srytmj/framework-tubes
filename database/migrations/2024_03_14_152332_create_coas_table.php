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
    public function up(): void
    {
        Schema::create('coa', function (Blueprint $table) {
            $table->id();
            $table->string('kode_akun');
            $table->string('nama_akun');
            $table->string('header_akun');
            $table->string('distributor_kode');
            $table->timestamps();
        });

        DB::table('coa')->insert([
            [
                'kode_akun' => '1101',
                'nama_akun' => 'Kas',
                'header_akun' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '1102',
                'nama_akun' => 'Bank',
                'header_akun' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '1201',
                'nama_akun' => 'Piutang Usaha',
                'header_akun' => '1',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '2101',
                'nama_akun' => 'Utang Usaha',
                'header_akun' => '2',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'kode_akun' => '3101',
                'nama_akun' => 'Modal Saham',
                'header_akun' => '3',
                'distributor_kode' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coa');
    }
};
