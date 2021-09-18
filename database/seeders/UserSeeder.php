<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('branches')->insert([
            'branch_name'=>4,
            'branch_email'=>3,
            'branch_phone'=>'stuff',
            'branch_address'=>'stuff@stuff.com',
            'branch_state'=>'stuff@stuff.com',
            'branch_pin'=>'stuff@stuff.com',
            'branch_country'=>'stuff@stuff.com',




        ]);

        DB::table('users')->insert([
        'role_id'=>1,
        'branch_id'=>1,
        'name'=>'admin',
        'email'=>'admin@admin.com',
        'password'=>bcrypt('123456789'),


        ]);

        DB::table('users')->insert([
            'role_id'=>2,
            'branch_id'=>1,
            'name'=>'stuff',
            'email'=>'stuf@stuf.com',
            'password'=>bcrypt('123456789'),


        ]);

        DB::table('users')->insert([
            'role_id'=>3,
            'branch_id'=>1,
            'name'=>'manager',
            'email'=>'manager@manager.com',
            'password'=>bcrypt('123456789'),


        ]);

        DB::table('users')->insert([
            'role_id'=>4,
            'branch_id'=>1,
            'name'=>'stuff',
            'email'=>'stuff@stuff.com',
            'password'=>bcrypt('123456789'),


        ]);




    }
}
