<?php

namespace Database\Seeders;

use App\Models\DongFeng;
use App\Models\ErrorCode;
use App\Models\ErrorCodeCategory;
use App\Models\Excel;
use Illuminate\Database\Seeder;

class DongFengStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $initialPath = public_path("img/xml/dongfeng.xlsx");

        $parsedTable = array_slice(Excel::parse($initialPath), 1);

        foreach ($parsedTable as $rows) {
            DongFeng::updateOrCreate(
                ['article' => $rows[0]],
                [
                    'article' => $rows[0],
                    'name' => $rows[1],
                    'quantity' => $rows[2],
                    'price' => $rows[3],
                ]
            );
        }
    }
}