<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use App\Models\MoySklad;


class getImageMsProvider
{

    public static function Image($id)
    {
        $url = MoySklad::msUrl().'product/'.$id.'/images';
        $response = Http::withBasicAuth(config('app.ms_login'), config('app.ms_password'))->get($url);
        return $response->json();
    }

}
