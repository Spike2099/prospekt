<?php

namespace App\Models;
use Carbon\Carbon;
use App\Models\Declension;

class TimeFormat
{

    public static function addDays($datatime, $day)
    {
        return Carbon::parse($datatime)->addDays($day)->locale('ru')->translatedFormat('d.m.Y');
    }

    public static function datatime($datatime)
    {
        return Carbon::parse($datatime)->locale('ru')->translatedFormat('d F Y, H:i');
    }

    public static function app($datatime)
    {
        return Carbon::parse($datatime)->locale('ru')->translatedFormat('«d» F Yг.');
    }

    public static function data($datatime)
    {
        return Carbon::parse($datatime)->locale('ru')->translatedFormat('d.m.Y');
    }

    public static function diff($datatime, $value)
    {
        return Carbon::parse($datatime)->diff(Carbon::now())->format('%'.$value);
    }

    public static function difference($datatime)
    {
        $year = self::diff($datatime, 'y') === '0' ? '' : self::diff($datatime, 'y').' '.Declension::year(self::diff($datatime, 'y')).', ';
        $month = self::diff($datatime, 'm') === '0' ? '' : self::diff($datatime, 'm').' '.Declension::month(self::diff($datatime, 'm')).', ';
        $day = self::diff($datatime, 'd') === '0' ? '' : self::diff($datatime, 'd').' '.Declension::day(self::diff($datatime, 'd')).', ';
        $hour = self::diff($datatime, 'h') === '0' ? '' : self::diff($datatime, 'h').' '.Declension::hour(self::diff($datatime, 'h'));
        return $hour === '0' ? 'Новый пользователь' : $year.$month.$day.$hour;
    }

} 