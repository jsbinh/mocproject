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
                'status_id'     => 1,
                'created_at'    => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Screening DiMC',
                'email'         => 'di.mc.screening@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 2,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Design DiMC',
                'email'         => 'di.mc.design@gmail.com',
                'status_id'     => 3,
                'password'      => Hash::make('Aa!23456'),
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'DesignApprove DiMC',
                'email'         => 'di.mc.designapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 4,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Implement DiMC',
                'email'         => 'di.mc.implement@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 5,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'ImplementApprove DiMC',
                'email'         => 'di.mc.implementapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 6,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'Closeout DiMC',
                'email'         => 'di.mc.closeout@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 7,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ],
            [
                'name'          => 'CloseoutApprove DiMC',
                'email'         => 'di.mc.closeoutapprove@gmail.com',
                'password'      => Hash::make('Aa!23456'),
                'status_id'     => 8,
                'created_at' => date('Y-m-d H:i:s', time()),
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ]
        ];

        DB::table('users')->delete();
        DB::table('users')->insert($data);

        $dataStatus = [
            [
                'id'    => 1,
                'name'  => 'Initial',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 2,
                'name'  => 'Screening',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 3,
                'name'  => 'Design',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 4,
                'name'  => 'Design Review/Approve',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 5,
                'name'  => 'Implement',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 6,
                'name'  => 'Implement Review/Approve',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 7,
                'name'  => 'Closeout',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 8,
                'name'  => 'Closeout Review/Approve',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
            [
                'id'    => 9,
                'name'  => 'Closed/Cancelled',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ],
        ];

        DB::table('change_statuses')->delete();
        DB::table('change_statuses')->insert($dataStatus);


        /*DB::table('users')->insert([
            'name' => 'Admin', //Str::random(10),
            'email' => 'admin.mocproject@gmail.com',
            'password' => Hash::make('admin@123'),
            'created_at' => date('Y-m-d H:i:s', time()),
            'email_verified_at' => date('Y-m-d H:i:s', time())
        ]);*/
    }
}
