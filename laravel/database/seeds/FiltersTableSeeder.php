<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FiltersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('filters')->insert([
            'user_id' => 1,
            'filter' => json_encode([
                [
                    "roe" => [
                        "gte" => 7
                    ]
                ],
                // Lãi gộp
                [
                    "tllg" => [
                        "gte" => 15
                    ]
                ],
                // P/E
                [
                    "tspe" => [
                        "lte" => 10
                    ]
                ],
                // Vốn hoá thị trường
                [
                    "vhtt" => [
                        "gte" => 500000000000
                    ]
                ],
                // Trung bình khối lượng 10 phiên
                [
                    "tbkl10" => [
                        "gte" => 100000
                    ]
                ],
                // [
                //     "code" => [
                //         "inq" => ["TIG"]
                //     ]
                // ],
                [
                    "CompanyName" => [
                        "neq" => null
                    ]
                ]
            ]),
            'created_at' => date('Y-m-d H:i:s', time()),
        ]);
    }
}
