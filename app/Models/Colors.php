<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class Colors
{

    public static function hex($number)
    {
        // $color = '#'.dechex($number);
        // if ( strpos( $color, '#' ) === 0 ) {
        //     return self::rgb_to_hex($color);
        // }
        return '#'.dechex($number);
    }

    public static function rgb_to_hex($rgba) 
    {
        preg_match( '/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i', $rgba, $by_color );
        return sprintf( '#%02x%02x%02x', $by_color[1], $by_color[2], $by_color[3] );
    }

    public static function background($color, $alfa = '0.1')
    {
        $dec = trim($color, '#');
        $dec = hexdec($dec);
        $rgb = [
            0xFF & ($dec >> 0x10),
            0xFF & ($dec >> 0x8),
            0xFF & $dec                        
        ];
        $rgba = implode(", ", $rgb);
        return 'background: rgba('.$rgba.', '.$alfa.')';
    }

}
