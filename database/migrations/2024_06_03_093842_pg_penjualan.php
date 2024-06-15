<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pg_penjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_penjualan');
            $table->string('masked_card', 100)->nullable();
            $table->string('approval_code', 100)->nullable();
            $table->string('bank', 100)->nullable();
            $table->string('eci', 100)->nullable();
            $table->string('channel_response_code', 100)->nullable();
            $table->string('channel_response_message', 100)->nullable();
            $table->string('transaction_time', 100)->nullable();
            $table->string('gross_amount', 100)->nullable();
            $table->string('currency', 100)->nullable();
            $table->string('order_id', 100)->nullable();
            $table->string('payment_type', 100)->nullable();
            $table->string('signature_key', 128)->nullable();
            $table->string('status_code', 100)->nullable();
            $table->string('transaction_id', 100)->nullable();
            $table->string('transaction_status', 100)->nullable();
            $table->string('fraud_status', 100)->nullable();
            $table->dateTime('settlement_time')->nullable();
            $table->string('status_message', 100)->nullable();
            $table->string('merchant_id', 100)->nullable();
            $table->string('card_type', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pg_penjualan');
    }
};