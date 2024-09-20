<?php
    $name = config('app.name');
    $name = ltrim($name, '«');
    $name = rtrim($name, '»');
    $url = 'https://prospekt-parts.com';
    $mclid = isset($_GET['mclid']) ? $_GET['mclid'] : '1002';
    $clid = isset($_GET['clid']) ? $_GET['clid'] : '2405959';
    $vid = isset($_GET['vid']) ? $_GET['vid'] : 'marketDeal';
    //?type=7&amp;&amp;mclid={{$mclid}}&amp;&amp;sku={{$decl::article($item['article'])}}&amp;&amp;clid={{$clid}}&amp;&amp;vid={{$vid}}
?>
<?='<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL ?>
<yml_catalog date="{{date('Y-M-D h:m')}}">
    <shop>
        <name>{{$name}}</name>
        <company>ООО {{config('app.name')}}</company>
        <url>{{$url}}</url>
        <currencies>
            <currency id="RUB" rate="1"/>
        </currencies>
        <categories>
            <category id="190401">Все товары</category>
            <category id="1198118" parentId="190401">Запчасти</category>
        </categories>
        <offers>
 
{{--    @foreach ($yml as $item)--}}
{{--            <offer id="{{$decl::article($item['article'])}}" available="true">--}}
{{--                <name>{{$item['name']}}</name>--}}
{{--                <description>Оригинальные запчасти Мерседес Бенц, доставка и отправка в регионы</description>--}}
{{--                <categoryId>1198118</categoryId>--}}
{{--                <picture>{{$url}}/img/goods/{{$item['article']}}.jpg</picture>--}}
{{--                <price>{{$item['price']}}</price>--}}
{{--                <currencyId>RUB</currencyId>--}}
{{--                <url>{{$url}}/stockMercedesBenz/{{$item['id']}}?type=7&amp;mclid={{$mclid}}&amp;sku={{$decl::article($item['article'])}}&amp;clid={{$clid}}&amp;vid={{$vid}}</url>--}}
{{--                <group_id>{{$decl::article($item['article'])}}</group_id>--}}
{{--                <vendor>Mercedes-Benz</vendor>--}}
{{--                <oldprice>{{$item['price']+100}}</oldprice>--}}
{{--                <delivery>true</delivery>--}}
{{--            </offer>--}}
{{--    @endforeach--}}

{{--        @foreach ($yml as $item)--}}
{{--            <offer id="{{$decl::article($item['article'])}}" available="true">--}}
{{--                <name>{{$item['name']}}</name>--}}
{{--                <categoryId>1198118</categoryId>--}}
{{--                <picture>{{$url}}/img/goods/{{$item['article']}}.jpg</picture>--}}
{{--                <price>{{$item['price']}}</price>--}}
{{--                <currencyId>RUB</currencyId>--}}
{{--                <url>{{$url}}/dongfengParts/{{$item['id']}}?type=7&amp;mclid={{$mclid}}--}}
{{--                    &amp;sku={{$decl::article($item['article'])}}&amp;clid={{$clid}}&amp;vid={{$vid}}</url>--}}
{{--                <group_id>{{$decl::article($item['article'])}}</group_id>--}}
{{--                <vendor>Mercedes-Benz</vendor>--}}
{{--                <oldprice>{{$item['price']+100}}</oldprice>--}}
{{--            </offer>--}}
{{--        @endforeach--}}

        @foreach ($yml as $item)
            <offer id="{{$decl::article($item['article'])}}" available="true">
                <name>{{$item['name']}}</name>
                <description>Оригинальные запчасти Мерседес Бенц, доставка и отправка в регионы</description>
                <categoryId>1198118</categoryId>
                <picture>{{$url}}/img/goods/{{$item['article']}}.jpg</picture>
                <price>{{$item['price']}}</price>
                <currencyId>RUB</currencyId>
                
<url>{{$url}}/product/mercedes-benz/{{$item['id']}}</url>


                <group_id>{{$decl::article($item['article'])}}</group_id>
                <vendor>Mercedes-Benz</vendor>
                <oldprice>{{$item['price'] + 100}}</oldprice>
                <delivery>true</delivery>
            </offer>
        @endforeach


 
        </offers>
    </shop>
</yml_catalog>