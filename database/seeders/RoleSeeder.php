<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
        
        Role::create([
            'name' => 'kasir',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'manajer',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'petugas_gudang',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' => 'petugas_lainnya',
            'guard_name' => 'web'
        ]);
    }
}