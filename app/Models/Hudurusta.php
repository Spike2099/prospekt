<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hudurusta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'hudurusta';

    protected $fillable = [
        'article', 'name', 'quantity', 'price'
    ];
    
         //для получения совпадений множества объектов
    public static function getManyByArticleHudurusta($search)
    {
        $result = Hudurusta::query()->where('article', 'like', '%' . $search . '%')->limit(100)->get()->toArray();
        foreach ($result as &$item) {
            $item['link'] = 'TrSaleProduct'; //oilProduct
            $item['stock_category_id'] = 'hudurusta'; //oil
        }
        return $result;
    }
    
    //получение единицы товара
    public static function getByArticleHudurusta($article)
    {
        return Hudurusta::where('article', $article)->first();
    }
    
    public static function getStockHudurusta($offset , $limit)
    {
        return Hudurusta::query()->offset($offset)->limit($limit)->get()->toArray();
    }

}