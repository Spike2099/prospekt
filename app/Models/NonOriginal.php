<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonOriginal extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'nonoriginal';

    protected $fillable = [ 
     'article', 'name', 'quantity', 'price' ,'description' , 'image'
    ];
    
     //для получения совпадений множества объектов
    public static function getManyByArticleNonOriginal($search)
    {
        $result = NonOriginal::query()->where('article', 'like', '%' . $search . '%')->get()->toArray();
        foreach ($result as &$item) {
            $item['link'] = 'originalPartsProduct';
        }
        return $result;
    }
    
    //получение единицы товара
    public static function getByArticleNonOriginal($article)
    {
        return NonOriginal::where('article', $article)->first();
    }

}
