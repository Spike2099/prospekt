<?php

namespace App\Http\Controllers;

use App\Models\Excel;
use App\Models\MoySklad;
use App\Models\Data\Replacement;

class StockController extends Controller
{
    public function StockExport()
    {
        $prdouctFolders = MoySklad::getAllProductFolders();

        $data = [['Бренд','Артикул','Наименование','Остаток','Цена продажи','OEM номера','OEM номера (замены)','OEM номера (замены)','OEM номера (замены)']];

        foreach ($prdouctFolders['rows'] as $folder) {
            $products = MoySklad::getProductFromStock($folder['meta']['href'], 100000);
            $arr = [];
            foreach ($products['rows'] as $item) {
                if (!($item['quantity'] == 0 || $item['salePrices'][0]['value'] == 0)){
                    $row = [$folder['name'], $item['article'], $item['name'], $item['quantity'], $item['salePrices'][0]['value'] / 100];
                    $replacements = Replacement::findAnalogs($item['article']);
                    if (!empty($replacements)){
                        foreach ($replacements as $rep) {
                            $row[] = $rep['analog'];
                        }
                    }
                    $data[] = $row;
                }
            }
        }
        Excel::export($data, 'stock_balance');
    }


}
