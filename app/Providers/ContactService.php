<?php

namespace App\Providers;

class ContactService
{

    public static function format_phone($phone = '', $convert = false, $trim = true)
    {
        if (empty($phone)) return '';
        $phone = preg_replace("/[^0-9A-Za-z]/", "", $phone);
        if ($convert == true) {
            $replace = array(
                '2'=>array('a','b','c'),
                '3'=>array('d','e','f'),
                '4'=>array('g','h','i'),
                '5'=>array('j','k','l'),
                '6'=>array('m','n','o'),
                '7'=>array('p','q','r','s'),
                '8'=>array('t','u','v'), 
                '9'=>array('w','x','y','z')
            );
     
            foreach($replace as $digit=>$letters) {
                $phone = str_ireplace($letters, $digit, $phone);
            }
        }

        if ($trim == true && strlen($phone)>11) {
            $phone = substr($phone,  0, 11);
        }
        if (strlen($phone) == 7) {
            return preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "$1-$2", $phone);
        } elseif (strlen($phone) == 10) {
            return preg_replace("/([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{4})/", "($1) $2-$3", $phone);
        } elseif (strlen($phone) == 11) {
            return preg_replace("/([0-9a-zA-Z]{1})([0-9a-zA-Z]{3})([0-9a-zA-Z]{3})([0-9a-zA-Z]{2})([0-9a-zA-Z]{2})/", "$1 ($2) $3-$4-$5", $phone);
        }
        return $phone;
    }

    public static function format_nds($nds)
    {
        return preg_replace("/([A-ZА-ЯЁ]{3})([0-9]{2})/", '$1 $2%', $nds);
        // @"([a-zа-яё])([A-ZА-ЯЁ])","$1 $2"
    }

    public static function format_spz($status)
    {
        $status = preg_replace("/(?=[A-ZА-ЯЁ])(?<=[^\\sA-ZА-ЯЁ])/u", ' ', $status);
        return mb_strtolower($status);
    }


    public static function getPhone($phone, $class = [], $og = false)
    {
        $class = implode(' ', $class);
        if($og) {
            return '
            <a href="tel:'.$phone.'" class="'.$class.'">
                <span itemprop="telephone">
                    '.self::format_phone($phone).'
                </span>
            </a>';
        }
        return '<a href="tel:'.$phone.'" class="'.$class.'">'.self::format_phone($phone).'</a>';
    }


    public static function getEmail($email, $class = [], $og = false)
    {
        $class = implode(' ', $class);
        if($og) {
            return '<a href="mailto:'.$email.'" class="'.$class.'"><span itemprop="email">'.$email.'</span></a>';
        }
        return '<a href="mailto:'.$email.'" class="'.$class.'">'.$email.'</a>';
    }

}