<?php

namespace Database\Seeders;

use App\Models\Excel;
use App\Models\NonOriginal;
use Illuminate\Database\Seeder;

class NonOriginalSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $filePath = public_path("img/xml/nonoriginal.xlsx");

        $parsedTable = array_slice(Excel::parse($filePath), 1);

        foreach ($parsedTable as $rows) {
            NonOriginal::updateOrCreate([
                'article' => $rows[0],
                'name' => $rows[5] . ' '. $rows[1],
                'unit' => $rows[2],
                'quantity' => $rows[3],
                'price' => $rows[4],
            ]);
        }
    }
}
