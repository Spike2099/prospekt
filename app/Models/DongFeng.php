<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DongFeng extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'dongfengstock';

    protected $fillable = [
        'article', 'name', 'quantity', 'price'
    ];
    
         //для получения совпадений множества объектов
    public static function getManyByArticleDongFeng($search)
    {
        $result = DongFeng::query()->where('article', 'like', '%' . $search . '%')->get()->toArray();
        foreach ($result as &$item) {
            $item['link'] = 'dongfengProduct';
        }
        return $result;
    }
    
    //получение единицы товара
    public static function getByArticleDongFeng($article)
    {
        return DongFeng::where('article', $article)->first();
    }
    
    public static function getStockDongFeng($offset , $limit)
    {
        return DongFeng::query()->offset($offset)->limit($limit)->get()->toArray();
    }

}