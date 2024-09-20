<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Colyman extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'colyman';

    protected $fillable = [
        'article', 'name', 'quantity', 'price'
    ];
    
         //для получения совпадений множества объектов
    public static function getManyByArticleColyman($search)
    {
        $result = Colyman::query()->where('article', 'like', '%' . $search . '%')->limit(100)->get()->toArray();
        foreach ($result as &$item) {
            $item['link'] = 'turkishProduct';
            $item['stock_category_id'] = 'colyman';
        }
        return $result;
    }
    
    //получение единицы товара
    public static function getByArticleColyman($article)
    {
        return Colyman::where('article', $article)->first();
    }
    
    public static function getStockColyman($offset , $limit)
    {
        return Colyman::query()->offset($offset)->limit($limit)->get()->toArray();
    }

}