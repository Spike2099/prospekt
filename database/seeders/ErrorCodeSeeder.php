<?php

namespace Database\Seeders;

use App\Models\ErrorCode;
use App\Models\ErrorCodeCategory;
use App\Models\Excel;
use Illuminate\Database\Seeder;

class ErrorCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $initialPath = public_path("img/xml/error_codes/");
        $id = 1;
        $data = array_diff(scandir($initialPath), array('.', '..'));

        foreach ($data as $tableNames) {
            $parsedTable = Excel::parse($initialPath . $tableNames);
            ErrorCodeCategory::updateOrCreate([
                'name' => $parsedTable[0][0],
                'description' => $parsedTable[0][1]
            ]);

            $parsedTable = array_slice($parsedTable, 2);
            foreach ($parsedTable as $rows) {
                ErrorCode::updateOrCreate([
                    'error_code_category_id' => $id,
                    'code' => $rows[0],
                    'description' => $rows[1]
                ]);
            }
            $id += 1;
        }

    }
}
