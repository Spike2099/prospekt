<?php

namespace App\Models;

class Database
{
    public  static function getCategotiesArray() // $arr['id'] = $categoryName
    {
        $categories= self::getTablesList();
        $categoriesMerged = array_merge($categories['stock'], $categories['others']);
        $categoriesResult = [];
        array_walk($categoriesMerged, function($value) use (&$categoriesResult){
            $categoriesResult[$value['id']] = $value['name'];
        });
        return $categoriesResult;
    }
    public static function getTablesList()
    {
        return [
            'analogs' => [
                ['id' => 'replacement', 'name' => 'Аналоги'],
            ],
            'stock' => [
                ['id' => 1, 'name' => 'MERCEDES-BENZ СКЛАД 2'],
                ['id' => 3, 'name' => 'НеОриги'],
                ['id' => 2, 'name' => 'DongFeng'],
                ['id' => 4, 'name' => 'MERCEDES-BENZ Новый Склад']
            ],
            'others' => [
                ['id' => 'moysklad', 'name' => 'МойСклад'],
                ['id' => 'colyman', 'name' => 'Турецкий Склад'],
                ['id' => 'oil', 'name' => 'Москва Склад'],
                ['id' => 'hudurusta', 'name' => 'Турция под заказ'],  
            ]
        ];
    }
}