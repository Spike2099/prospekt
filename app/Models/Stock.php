<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Stock extends Model
{
    use HasFactory;
    
    //public $timestamps = false;
    public $timestamps = false;

    protected $table = 'stock';
    
    protected $fillable = [ 
     'article', 'name', 'quantity', 'price' ,'description' , 'image', 'stock_category_id', 'brands'
    ];

    public function category()
    {

        return $this->belongsTo(StockCategory::class);
    }

    //временно воткнул where('stock_category_id', 1)->
    
    public static function getStock($offset, $limit, $category_id)
    {
        return Stock::where('stock_category_id', $category_id)->offset($offset)->limit($limit)->get()->toArray();
    }
    
    //для получения совпадений множества объектов
    public static function getManyByArticle($search, $category_id)
    {
        //try with category
        $result = Stock::where('stock_category_id', $category_id)->where('article', 'like', '%' . $search . '%')->limit(100)->get()->toArray();

        $link = '';
        switch ($category_id) {
            case 1:
                $link = 'product';
                break;
            case 2:
                $link = 'dongfengProduct';
                break;
            case 3:
                $link = 'originalPartsProduct';
                break;
            case 4:
                $link = 'newproduct';
                break;
        }

        foreach ($result as &$item) {
            $item['link'] = $link;
        }
        return $result;
    }
    
    public static function getCount($category_id)
    {
        return Stock::where('stock_category_id', $category_id)->count();
    }
    
    //получение единицы товара 
    public static function getByArticle($article, $category_id)
    {
       return Stock::where('stock_category_id', $category_id)
                ->where('article', $article)
                ->first();

    }


}