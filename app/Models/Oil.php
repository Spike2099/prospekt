<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Oil extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'oil';

    protected $fillable = [
        'article', 'name', 'quantity', 'price'
    ];
    
         //для получения совпадений множества объектов
    public static function getManyByArticleOil($search)
    {
        $result = Oil::query()->where('article', 'like', '%' . $search . '%')->limit(100)->get()->toArray();
        foreach ($result as &$item) {
            $item['link'] = 'OilProduct'; //oilProduct
            $item['stock_category_id'] = 'oil'; //oil
        }
        return $result;
    }
    
    //получение единицы товара
    public static function getByArticleOil($article)
    {
        return Oil::where('article', $article)->first();
    }
    
    public static function getStockOil($offset , $limit)
    {
        return Oil::query()->offset($offset)->limit($limit)->get()->toArray();
    }

}