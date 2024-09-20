<?php

namespace App\Http\Controllers;

use App\Models\Excel;
use App\Models\MoySklad;
use App\Models\Stock;
use App\Models\DongFeng;
use App\Models\NonOriginal;
use App\Models\Replacement;
use Illuminate\Http\Request;


class ApiController extends Controller
{

    public function getValue(Request $request)
    {
        $request->validate([
            'uuid' => 'required'
        ]);
        $uuid = $request->input('uuid');
    }

    public function downloadFiles(Request $request)
    {
        $request->validate(['file' => 'required']);
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $error = $_FILES['file']['error'];
        $ext = explode('.', $name);
        $uploaddir = './img/xml/';
        $uploadfile = $uploaddir . 'table.' . $ext[1];
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
            $data = [
                'text' => 'Таблица с товарами загружена',
                'name' => $name,
                'extension' => $ext[1],
                'type' => $type,
                'size' => $size,
                'error' => $error
            ];
            return $data;
        } else {
            return ['text' => 'Ошибка!'];
        }
    }

    /*public function loadStock(Request $request)
    {
        $category_id = $request->input('store');
        //$country = $request->input('country');
        //$pack = $request->input('pack');
        $file = $request->input('file');

        //я добавил loadtype чтобы определять условие при загрузке
        $loadType = $request->input('loadType');

        $path = './img/xml/';

        $table = array_slice(Excel::parse($path . $file), 1);

        if ($loadType === 'replacement') {
            // Загружаем в Replacement
            foreach ($table as $item) {
                Replacement::updateOrCreate(
                    [
                        'article' => $item[0],
                        'analog' => $item[1]
                    ]
                );
            }
        } else {
            // Заполняем массив для обновления базы
            $array = [];
            $excelArticles = [];
            foreach ($table as $item) {
                $excelArticles[] = $item[0];
                $array[] = [
                    'article' => $item[0],
                    'name' => $item[1],
                    'quantity' => !empty($item[2]) ? $item[2] : 0,
                    'price' => $item[3],
                    'brands' => $item[4],
                ];
            }
            // Удаление записей, которых нет в excel файле (этого не нужно для Replacement)

            $databaseArticles = Stock::where('stock_category_id', $category_id)->pluck('article')->toArray();
            $articlesToDelete = array_diff($databaseArticles, $excelArticles);
            Stock::where('stock_category_id', $category_id)->whereIn('article', $articlesToDelete)->delete();
            // Загружаем в Stock
            foreach ($array as $item) {
                Stock::updateOrCreate( //$category_id
                    [
                        'article' => $item['article'],
                        'stock_category_id' => $category_id
                    ],
                    [
                        'article' => $item['article'],
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'brands' => $item['brands']
                    ]
                );
            }
        }
        return redirect()->route('stockable');
    }*/
    
    public function loadStock(Request $request)
    {
    $category_id = $request->input('store');
    $file = $request->input('file');
    $loadType = $request->input('loadType');

    $path = './img/xml/';
    $table = array_slice(Excel::parse($path . $file), 1);

    if ($loadType === 'replacement') {
        // Загружаем в Replacement
        foreach ($table as $item) {
            Replacement::updateOrCreate(
                [
                    'article' => $item[0],
                    'analog' => $item[1]
                ]
            );
        }
    } else {
        // Заполняем массив для обновления базы
        $array = [];
        $excelArticles = [];
        foreach ($table as $item) {
            $excelArticles[] = $item[0];

            $stockData = [
                'article' => $item[0],
                'name' => $item[1],
                'quantity' => !empty($item[2]) ? $item[2] : 0,
                'price' => $item[3],
            ];

            // Проверка на наличие поля 'brands' в элементе массива
            if (isset($item[4])) {
                $stockData['brands'] = $item[4];
            }

            $array[] = $stockData;
        }

        // Удаление записей, которых нет в excel файле (этого не нужно для Replacement)
        $databaseArticles = Stock::where('stock_category_id', $category_id)->pluck('article')->toArray();
        $articlesToDelete = array_diff($databaseArticles, $excelArticles);
        Stock::where('stock_category_id', $category_id)->whereIn('article', $articlesToDelete)->delete();

        // Загружаем в Stock
        foreach ($array as $item) {
            Stock::updateOrCreate(
                [
                    'article' => $item['article'],
                    'stock_category_id' => $category_id
                ],
                $item
            );
        }
    }

    return redirect()->route('stockable');
}

    
}
