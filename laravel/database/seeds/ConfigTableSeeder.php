<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('config')->insert([
            'name' => 'default_filter',
            'value' => json_encode([
                // Tỉ trọng doanh thu 4 quý
                [
                    'ttdt4q' => [
                        'gte' => 0
                    ]
                ],
                // Tỉ trọng doanh thu quý gần nhất
                [
                    'ttdtqgn' => [
                        'gte' => 0
                    ]
                ],
                // Tỉ trọng doanh thu quý gần nhì
                [
                    'ttdtqgn2' => [
                        'gte' => 0
                    ]
                ],
                // Tỉ trọng lợi nhuận sau thuế 4 quý gần nhất
                [
                    'ttlnst4qgn' => [
                        'gte' => 0
                    ]
                ],
                // Tỉ trọng lợi nhuận sau thuế quý gần nhất
                [
                    'ttlnstqgn' => [
                        'gte' => 0
                    ]
                ],
                // Tỉ trọng lợi nhuận sau thuế quý gần nhì
                [
                    'ttlnstqgn2' => [
                        'gte' => 0
                    ]
                ],
                // ROE
                [
                    "roe" => [
                        "gte" => 7
                    ]
                ],
                // ROA
                [
                    "roa" => [
                        "gte" => 0
                    ]
                ],
                // Tỉ lệ Lãi gộp
                [
                    "tllg" => [
                        "gte" => 15
                    ]
                ],
                // Tỉ lệ Lãi ròng
                [
                    "tllr" => [
                        "gte" => 0
                    ]
                ],
                // P/E
                [
                    "tspe" => [
                        "lte" => 10
                    ]
                ],
                // P/B
                [
                    "tspb" => [
                        "gte" => 1
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
                // Trung bình khối lượng 20 phiên
                [
                    "tbkl20" => [
                        "gte" => 100000
                    ]
                ],
                [
                    "code" => [
                        "inq" => ["VCB", "ACB"]
                    ]
                ],
                [
                    "CompanyName" => [
                        "neq" => null
                    ]
                ]
            ]),
            'description' => 'Default filter',
            'created_at' => date('Y-m-d H:i:s', time()),
        ]);

        DB::table('config')->insert([
            'name' => 'default_stock_json',
            'value' => '{"ttdt4q":0,"ttdtqgn":0,"ttdtqgn2":0,"ttlnst4qgn":0,"ttlnstqgn":0,"ttlnstqgn2":0,"roe":0,"roa":0,"tllg":0,"tllr":0,"tspb":0,"tspe":0,"cdate":"-","code":"-","closed_price":0,"stock_signal":0,"vhtt":0,"CompanyName":"-","id":"-","tbkl10":0,"tbkl20":0,"ma20":0,"ma50":0,"ma150":0,"ma250":0,"gtkltb10":0,"gtkltb20":0,"tn_vcsh":0,"ndh_lnst":0,"pttdgvnht":0,"pttdklhnvtb10p":0,"pttdklhnvtb20p":0,"pttdgtklhnvtb10p":0,"pttdgtklhnvtb20p":0,"tamtu":0,"tutu":0}',
            'description' => 'Default stock json',
            'created_at' => date('Y-m-d H:i:s', time())
        ]);
    }
}
