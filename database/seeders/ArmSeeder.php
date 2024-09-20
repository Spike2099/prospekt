<?php

namespace Database\Seeders;


use App\Models\Stock;
use App\Models\Excel;
use Illuminate\Database\Seeder;

class ArmSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $initialPath = public_path("img/xml/arm.xlsx");

        $parsedTable = array_slice(Excel::parse($initialPath), 1);

        foreach ($parsedTable as $rows) {
        Stock::updateOrCreate(
            ['article' => $rows[0], 'stock_category_id' => 4],
            [
                'article' => $rows[0],
                'name' => $rows[1],
                'quantity' => $rows[2],
                'price' => $rows[3],
                'brands' => $rows[4],
                'stock_category_id' => 4,
            ]
        );

        }
    }
}