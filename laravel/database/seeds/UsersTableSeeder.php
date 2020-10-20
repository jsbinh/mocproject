<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Admin', //Str::random(10),
            'email' => 'admin.mocproject@gmail.com',
            'password' => Hash::make('admin@123'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
