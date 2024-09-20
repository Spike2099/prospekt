<?php

namespace Database\Seeders;

use App\Models\DongFeng;
use App\Models\Colyman;
use App\Models\ErrorCode;
use App\Models\ErrorCodeCategory;
use App\Models\Excel;
use Illuminate\Database\Seeder;

class ColymanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $initialPath = public_path("img/xml/colyman.xlsx");

        $parsedTable = array_slice(Excel::parse($initialPath), 1);

        foreach ($parsedTable as $rows) {
            Colyman::updateOrCreate(
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