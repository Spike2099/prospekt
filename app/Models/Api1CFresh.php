<?php

namespace App\Models;
use Illuminate\Support\Facades\Http;


class Api1CFresh
{

    public static function odataUrl()
    {
        return 'https://1cfresh.com/a/ea/1080462/odata/standard.odata/';
    }


    public static function get($url)
    {
        $login = 'oApiData';
        $password = 'Ld7EktWZ2JqfcKkHfpyU';        
        return Http::withBasicAuth(
            $login, 
            $password
        )->get($url);
    }


    public static function DocumentReceiptToCurrentAccount()
    {
        $param = '?$format=json&$inlinecount=allpages&$top=200&$orderby=СчетНаОплату_Key desc';
        $url = self::odataUrl().'Document_ПоступлениеНаРасчетныйСчет_РасшифровкаПлатежа'.$param;
        $response = self::get($url);
        $items = $response->json();
        $array = [];
        foreach($items['value'] as $item) {
            $array[] = [
                'id' => $item['Ref_Key'],
                'pay' => $item['СуммаПлатежа'],
                'return_pay' => $item['СуммаВзаиморасчетов'],
                'sum_tax' => $item['СуммаНДС'],
                'tax' => $item['СтавкаНДС'],
                'return_sum' => $item['СуммаВозврата'],
                'status' => $item['СпособПогашенияЗадолженности'],
                'order' => $item['СчетНаОплату_Key'],
                'org' => self::BuyerInvoice($item['СчетНаОплату_Key']),
            ];
        }
        return [
            'count' => $items['odata.count'],
            'value' => $array
        ];


    }


    public static function BuyerInvoice($document)
    {
        $param = '?$format=json&$inlinecount=allpages';
        $url = self::odataUrl()."Document_СчетНаОплатуПокупателю(guid'".$document."')/Контрагент".$param;
        $response = self::get($url);
        $data = $response->json();
        return [
            'name' => isset($data['НаименованиеПолное']) ? $data['НаименованиеПолное'] : 'Нет данных',
            'inn' => isset($data['ИНН']) ? $data['ИНН'] : '...',
            'kpp' => isset($data['КПП']) ? $data['КПП'] : '...',
            'rn' => isset($data['РегистрационныйНомер']) ? $data['РегистрационныйНомер'] : '..',
            'code' => isset($data['Code']) ? $data['Code'] : '.',
        ];
    }


    public static function nomenclature()
    {
        // &$top=10
        // Parent@navigationLinkUrl,
        // ВидНоменклатуры@navigationLinkUrl,
        $select = '$select=Ref_Key,Code,Description,Артикул,ЕдиницаИзмерения@navigationLinkUrl,НоменклатурнаяГруппа@navigationLinkUrl,СтранаПроисхождения@navigationLinkUrl,НомерГТД@navigationLinkUrl&';
        $param = '&$format=json&$inlinecount=allpages';
        $filter = "Артикул ne ''";
        $url = self::odataUrl().'Catalog_Номенклатура?$filter='.$filter.$param;
        //return $url;
        $response = self::get($url);
        return $response->json();
    }

    public static function gtd($id)
    {
        $param = '?$format=json'; // &$inlinecount=allpages
        $guid = "'$id'";
        $url = self::odataUrl().'Catalog_Номенклатура(guid'.$guid.')/НомерГТД'.$param;
        //return $url;
        $response = self::get($url);
        return $response->json();
    }

}