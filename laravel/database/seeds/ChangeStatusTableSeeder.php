<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class ChangeStatusTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
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
        DB::table('change_statuses')->insert($data);
    }
}
