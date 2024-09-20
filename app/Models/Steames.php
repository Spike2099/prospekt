<?php

namespace App\Models;
use App\Models\MoySklad;


class Steames
{
    //поиск по id ,я переделываю по артикулу
    public static function getListURL($fiter)
    {
        $modal = MoySklad::searchByProduct('', $fiter);
        $array = [];
            foreach($modal["rows"] as $item) {
                $array[] = 'https://api.moysklad.ru/api/remap/1.2/entity/assortment?filter=id='.$item['id'];
            }
        return $array;
    }


    public static function nullOrResult($modal, $fiter)
    {
        if(count($modal["rows"]) === 0) {
            return 'https://api.moysklad.ru/api/remap/1.2/entity/assortment?expand=productFolder&limit=100&filter=article~'.$fiter;
        } else {
            $array = [];
            foreach($modal["rows"] as $item) {
                $array[] = 'id='.$item['id'];
            }
            return 'https://api.moysklad.ru/api/remap/1.2/entity/assortment?expand=productFolder&limit=100&filter='.implode(";", $array);            
        }
    }

    
    public static function getListResult($fiter)
    {
        $modal = MoySklad::searchByProduct('', $fiter);
        return self::nullOrResult($modal, $fiter);
    }

    // public static function getResult($fiter)
    // {
    //     $urls = self::getListURL($fiter);
    //     $token = base64_encode(config('app.ms_login').':'.config('app.ms_password'));

    //     $mh = curl_multi_init();
    //     foreach ($urls as $i => $url) {
    //         $conn[$i] = curl_init($url);
    //         curl_setopt($conn[$i], CURLOPT_RETURNTRANSFER, 1);
    //         curl_setopt($conn[$i], CURLOPT_CONNECTTIMEOUT, 10);
    //         curl_setopt($conn[$i], CURLOPT_HTTPHEADER, array(
    //             'Authorization: Basic '.$token
    //         ));
    //         curl_multi_add_handle ($mh, $conn[$i]);
    //     }
    //     do {
    //         $status = curl_multi_exec($mh, $active);
    //         if ($active) {
    //             curl_multi_select($mh);
    //         }
    //     } while ($active && $status == CURLM_OK);

    //     for ($i = 0; $i < count($urls); $i++) {
    //         $res[$i] = curl_multi_getcontent($conn[$i]); 
    //         curl_multi_remove_handle($mh, $conn[$i]);
    //         curl_close($conn[$i]);
    //     }
    //     curl_multi_close($mh);
    //     $result = [];
    //     for ($i = 0; $i <= count($urls)-1; $i++) {
    //         $result[] = json_decode($res[$i], true);
    //     };
    //     return [
    //         'count' => count($urls),
    //         'rows' => $result
    //     ];
    // }
}