<?php
namespace App\Models\Data;

use App\Models\MoySklad;
use App\Models\Stock as SpareParts;


class Stock
{
    public static function getStockAllPosition($text)
    {
        return SpareParts::select('article', 'name', 'unit', 'quantity', 'price')
                    ->where('article', $text)
                    ->get();
    }

}