<?php

namespace App\Models;


class Names 
{

    public static function company($name)
    {
        $value = explode(" ", $name);
        return '<b>'.$value[0].'</b> 
        <span class="fw-lighter" style="opacity:0.7">'.$value[1].'</span>';
    }

}