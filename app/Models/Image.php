<?php
namespace App\Models;

class Image
{
    public static function src($uuid)
    {
        //$item = Goods::where('link', $uuid)->get();
        //return response()->json($item);
        return isset($item[0]['image']) && $item[0]['image'] !== ''  ? trim($item[0]['image'], '.') : '/img/placeholder.png';
        // $item[0]['image'] === '' ? '/img/placeholder.png' : trim($item[0]['image'], ".");
    }

    public static function text($uuid)
    {
        //$item = Goods::where('link', $uuid)->get();
        $image = isset($item[0]['image']) && $item[0]['image'] !== ''  ? trim($item[0]['image'], '.') : '/img/placeholder.png';
        $description = isset($item[0]['description']) && $item[0]['description'] !== ''  ? $item[0]['description'] : '';
        return [
            'image' => $image,
            'description' => $description
        ];
    }

    public static function quantity($quantity)
    {
        // $item = Goods::where('link', $uuid)->get();
        // $quantity = $item[0]['quantity'];
        $class = $quantity == 0 ? 'label-danger' : 'label';
        $text = $quantity == 0 ? 'Нет в наличии' : 'В наличии '.$quantity;
        return [
            'class' => $class,
            'text' => $text,
            'quantity' => $quantity
        ];
    }

}