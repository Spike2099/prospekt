<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('roles')->truncate();
        DB::table('roles')->insert([
            ['name' => 'Admin', 'slug' => 'admin', 'created_at' => '2022-10-26 13:59:34', 'updated_at' => '2022-10-26 13:59:34'],
            ['name' => 'Customer', 'slug' => 'customer', 'created_at' => '2022-10-26 13:59:34', 'updated_at' => '2022-10-26 13:59:34'],
            ['name' => 'Manager', 'slug' => 'manager', 'created_at' => '2022-10-26 13:59:34', 'updated_at' => '2022-10-26 13:59:34'],
            ['name' => 'Accountant', 'slug' => 'accountant', 'created_at' => '2022-10-26 13:59:34', 'updated_at' => '2022-10-26 13:59:34'],
            ['name' => 'Networker', 'slug' => 'networker', 'created_at' => '2022-10-26 13:59:34', 'updated_at' => '2022-10-26 13:59:34']            
        ]);
    }
}
