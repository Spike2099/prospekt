<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;


class DaData
{
    
    public static function url()
    {
        return 'https://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/';
    }

    public static function headers() 
    {
        return [
            'Content-Type' => 'application/json',
            'Authorization' => 'Token '.config('app.dadata_token'),
            'X-Secret' => config('app.dadata_secret')
        ];
    }

    public static function header()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Token '.config('app.dadata_token')
        ];
    }

    
    public static function cleanName($name)
    {
        $url = 'https://cleaner.dadata.ru/api/v1/clean/name';
        $response = Http::withHeaders(self::headers())->post($url, [$name]);
        return $response->json();
    }

    public static function bank($inn)
    {
        $response = Http::withHeaders(self::header())->post(self::url().'bank', ['query' => $inn]);
        return $response->json();
    }

    public static function okved($number)
    {
        $response = Http::withHeaders(self::header())->post(self::url().'okved2', ['query' => $number]);
        return $response->json();
    }

    

}