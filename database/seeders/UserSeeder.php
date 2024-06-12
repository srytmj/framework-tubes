<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12341234'),
        ]);
        $role1->assignRole('admin');

        $role2 = User::create([
            'name' => 'user1',
            'email' => 'user@mail.com',
            'password' => bcrypt('12341234'),
        ]);
        $role2->assignRole('user');

        $role3 = User::create([
            'name' => 'user3',
            'email' => 'user3@mail.com',
            'password' => Hash::make('12341234'),
    ]);
        $role3 -> assignRole('kasir');

        $role4 = User::create([
            'name' => 'user4',
            'email' => 'user4@mail.com',
            'password' => Hash::make('12341234'),
        ]);
        $role4 -> assignRole('manajer');

        $role5 = User::create([
            'name' => 'user5',
            'email' => 'user5@mail.com',
            'password' => Hash::make('12341234'),
        ]);
        $role5 -> assignRole('petugas_gudang');

        $role6 = User::create([
            'name' => 'user6',
            'email' => 'user6@mail.com',
            'password' => Hash::make('12341234'),
        ]);
        $role6 -> assignRole('petugas_lainnya');

    }
}