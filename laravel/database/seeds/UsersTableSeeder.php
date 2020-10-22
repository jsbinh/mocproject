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
        $data = [
            [
                'name'          => 'Initiator DiMC',
                'email'         => 'di.mc.initiator@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at'    => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Screening DiMC',
                'email'         => 'di.mc.screening@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Design DiMC',
                'email'         => 'di.mc.design@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'DesignApprove DiMC',
                'email'         => 'di.mc.designapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Implement DiMC',
                'email'         => 'di.mc.implement@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'ImplementApprove DiMC',
                'email'         => 'di.mc.implementapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Closeout DiMC',
                'email'         => 'di.mc.closeout@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'CloseoutApprove DiMC',
                'email'         => 'di.mc.closeoutapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ]
        ];

        DB::table('users')->insert($data);


        /*DB::table('users')->insert([
            'name' => 'Admin', //Str::random(10),
            'email' => 'admin.mocproject@gmail.com',
            'password' => Hash::make('admin@123'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ]);*/
    }
}
