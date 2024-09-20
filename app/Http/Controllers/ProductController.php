<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Colyman;
use App\Models\Oil;
use App\Models\Hudurusta;

class ProductController extends Controller
{
    //вывод мерседесбензсклад2
    public function show(Stock $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('product.show', compact('product'));
    }

    public function index($limit = 64, $offset = 0, $stockId = 'Mercedes-Benz склад 2')
    {
        $product['rows'] = Stock::getStock($offset, $limit, 1);
        $product['meta']['size'] = Stock::getCount(1);
        return view('product.index', compact('product', 'limit', 'offset', 'stockId'));
    }
    
    //Армтек id 4
    public function showArmtek(Stock $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('newproduct.show', compact('product'));
    }
    
    public function indexArmtek($limit = 64, $offset = 0, $stockId = 'Mercedes-Benz Новый Склад')
    {
        $product['rows'] = Stock::getStock($offset, $limit, 4);
        $product['meta']['size'] = Stock::getCount(1);
        $product['meta']['size'] = Stock::count(); // Это вернёт общее количество товаров
        return view('newproduct.index', compact('product', 'limit', 'offset', 'stockId'));
    }
    //Армтек id 4
    
    //вывод NonOriginal
    public function showNonoriginal(Stock $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('nonoriginal.show', compact('product'));
    }


    public function indexNonoriginal($limit = 64, $offset = 0, $stockId = 'Запчасти Оригиналы')
    {
        $product['rows'] = Stock::getStock($offset, $limit, 3);
        //$price *= 100
        $product['meta']['size'] = Stock::getCount(3);
        return view('nonoriginal.index', compact('product', 'limit', 'offset', 'stockId'));
    }
    
    //вывод DongFeng
    public function showDongFeng(Stock $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('dongfeng.show', compact('product'));
    }

    public function indexDongFeng($limit = 64, $offset = 0, $stockId = 'DongFeng')
    {
        $product['rows'] = Stock::getStock($offset, $limit, 2);
        //$price *= 100
        $product['meta']['size'] = Stock::getCount(2);
        return view('dongfeng.index', compact('product', 'limit', 'offset', 'stockId'));
    }
    
    //вывод Turkish Стока в базе "colyman"
    public function showColyman(Colyman $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('colyman.show', compact('product'));
    }

    public function indexColyman($limit = 64, $offset = 0, $stockId = 'Mercedes-Benz Турецкий Склад')
    {
        $product['rows'] = Colyman::query()->offset($offset)->limit($limit)->get()->toArray();
        //$price *= 100
        $product['meta']['size'] = Colyman::query()->count();
        return view('colyman.index', compact('product', 'limit', 'offset', 'stockId'));
    }
    
     //вывод Turkish Стока в базе "oil"
    public function showOil(Oil $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('oil.show', compact('product'));
    }

    public function indexOil($limit = 64, $offset = 0, $stockId = 'Mercedes-Benz Масло Моторное')
    {
        $product['rows'] = Oil::query()->offset($offset)->limit($limit)->get()->toArray();
        //$price *= 100
        $product['meta']['size'] = Oil::query()->count();
        return view('oil.index', compact('product', 'limit', 'offset', 'stockId'));
    } 
    
    
         //вывод Turkish Стока в базе "TrSale"
    public function showTurkishSale(Hudurusta $product)
    {
        //костыль, пока вся логика цен завязана на моем складе
        $product['price'] *= 100;
        return view('hudurusta.show', compact('product'));
    }

    public function indexTurkishSale($limit = 64, $offset = 0, $stockId = 'Mercedes-Benz Турция под заказ')
    {
        $product['rows'] = Hudurusta::query()->offset($offset)->limit($limit)->get()->toArray();
        //$price *= 100
        $product['meta']['size'] = Hudurusta::query()->count();
        return view('hudurusta.index', compact('product', 'limit', 'offset', 'stockId'));
    } 
    
    
}
