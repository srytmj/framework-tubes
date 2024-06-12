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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // DB::table('users')->insert([
        //     [            
        //         'name' => 'user1',
        //         'email' => 'user1@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'user2',
        //         'email' => 'user2@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'user3',
        //         'email' => 'user3@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'user4',
        //         'email' => 'user4@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'user5',
        //         'email' => 'user5@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'name' => 'user6',
        //         'email' => 'user6@mail.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('12341234'),
        //         'remember_token' => \Illuminate\Support\Str::random(10),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
