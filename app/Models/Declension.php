<?php

namespace App\Models;
use App\Models\FormatCurrency;
use App\Models\voicecms\Voice;
use App\Models\voicecms\Namevoiceru;


class Declension
{

    public static function diff($n, $s1, $s2, $s3, $b = false)
    {
        $m = $n % 10; $j = $n % 100;
        if($b) {$n = $n;}
        if($m==0 || $m>=5 || ($j>=10 && $j<=20)) {return $s3;}
        if($m>=2 && $m<=4) {return $s2;}
        return $s1;
    }

    public static function year($num)
    {
        return self::diff($num, 'год', 'года', 'лет');
    }

    public static function month($num)
    {
        return self::diff($num, 'месяц', 'месяца', 'месяцев');
    }

    public static function day($num)
    {
        return self::diff($num, 'день', 'дня', 'дней');
    }

    public static function hour($num)
    {
        return self::diff($num, 'час', 'часа', 'часов');
    }

    public static function minutes($num)
    {
        return self::diff($num, 'минута', 'минуты', 'минут');
    }

    public static function rub($num)
    {
        return self::diff($num, 'рубль', 'рубля', 'рублей');
    }

    public static function cart($num)
    {
        return self::diff($num, 'товар', 'товара', 'товаров');
    }

    public static function name($num)
    {
        return self::diff($num, 'наименование', 'наименования', 'наименований');
    }

    public static function demand($num)
    {
        return self::diff($num, 'отчёт', 'отчёта', 'отчётов');
    }

    public static function positions($num)
    {
        return '<b>'.$num.'</b>&#160;'. self::diff($num, 'позиция', 'позиции', 'позиций');
    }

    public static function preorders($num)
    {
        return '<b>'.$num.'</b> &#160;'. self::diff($num, 'предзаказ', 'предзаказа', 'предзаказов');
    }

    public static function orders($num)
    {
        return $num.' '. self::diff($num, 'счёт', 'счёта', 'счетов');
    }
    
    public static function custom($num)
    {
        return $num.' '. self::diff($num, 'заказ', 'заказа', 'заказов');
    }
    
    public static function search($num)
    {
        $start = self::diff($num, 'Найден', 'Найдено', 'Найдено');
        $end = self::diff($num, 'результат', 'результата', 'результатов');
        return $start.' '.FormatCurrency::res($num).' '.$end;
    }

    public static function fio($person)
    {
        $nc = new Namevoiceru();
        return $nc->q($person, Voice::$RODITLN);
    }

    public static function nc($name)
    {
        return preg_replace('~^(\S++)\s++(\S)\S++\s++(\S)\S++$~u', '$1 $2. $3.', $name);
    }

    public static function article($article)
    {
        $start = $article[0];
        $result = is_string($start) === true ? substr($article, 1) : $article;
        return $article === '' ? '' : $result;
    }

}