<?php

namespace App\Models;

use Shuchkin\SimpleXLSX;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Shuchkin\SimpleXLSXGen;

class Excel
{

    public static function parse($path, $sheet = false)
    {
        if ( $xlsx = SimpleXLSX::parse($path) ) {
            //dd($xlsx->rows());
            return $sheet ? $xlsx->sheetNames() : $xlsx->rows();
        } else {
            dd(SimpleXLSX::parseError());
            return false;
            //SimpleXLSX::parseError();
        }
    }


    public static function reader($file)
    {
        $reader = IOFactory::createReader('Xlsx');
        $reader->setReadDataOnly(TRUE);
        $spreadsheet = $reader->load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        return $worksheet;
    }


    public static function loading($request)
    {
        // http://prospektrans.host/api/array/pack
        return setcookie("Pack", $request, time() + 3600);
    }


    /*public static function insert($db, $isReplacementAnalog = false)
    {
        try {
            DB::transaction(function () use ($db, $isReplacementAnalog) {
                foreach ($db as $item) {
                    if ($isReplacementAnalog) {
                        // В случае загрузки в другой склад использую Replacement::updateOrCreate
                        Replacement::updateOrCreate(
                            ['article' => $item['article']],
                            ['analog' => $item['analog']]
                        );
                    } else {
                        //По базе Stock::updateOrCreate
                        Stock::updateOrCreate(
                            ['article' => $item['article']],
                            [
                                'article' => $item['article'],
                                'name' => $item['name'],
                                'quantity' => $item['quantity'],
                                'price' => $item['price'],
                                'brands' => $item['brands'],
                                'image' => ''
                            ]
                        );
                    }
                }
            }, 3); // Повторить три раза, прежде чем признать неудачу
            DB::commit();
            return [
                'type' => 'success',
                'header' => 'Успешно!',
                'message' => 'Данные обновлены и записаны в базу данных.'
            ];
        } catch (\Exception $exception) {
            return [
                'type' => 'danger',
                'header' => 'Ошибка: ',
                'message' => $exception->getMessage() // Используем getMessage() для получения текста ошибки
            ];
        }
    }*/
    
    public static function insert($db, $isReplacementAnalog = false)
    {
    try {
        DB::transaction(function () use ($db, $isReplacementAnalog) {
            foreach ($db as $item) {
                if ($isReplacementAnalog) {
                    // В случае загрузки в другой склад использую Replacement::updateOrCreate
                    Replacement::updateOrCreate(
                        ['article' => $item['article']],
                        ['analog' => $item['analog']]
                    );
                } else {
                    // Проверяем наличие поля 'brands' в данных
                    $stockData = [
                        'article' => $item['article'],
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'image' => '' // Значение поля 'image'
                    ];

                    // Добавляем 'brands' только если оно существует
                    if (isset($item['brands'])) {
                        $stockData['brands'] = $item['brands'];
                    }

                    // Обновляем или создаем запись в Stock
                    Stock::updateOrCreate(
                        ['article' => $item['article']],
                        $stockData
                    );
                }
            }
        }, 3); // Повторить три раза, прежде чем признать неудачу

        DB::commit();
        return [
            'type' => 'success',
            'header' => 'Успешно!',
            'message' => 'Данные обновлены и записаны в базу данных.'
        ];
    } catch (\Exception $exception) {
        return [
            'type' => 'danger',
            'header' => 'Ошибка: ',
            'message' => $exception->getMessage() // Используем getMessage() для получения текста ошибки
        ];
    }
}


    public static function export($array, $name)
    {
        SimpleXLSXGen::fromArray($array)->downloadAs($name . '.xlsx');
    }

}