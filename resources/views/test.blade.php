@extends('layout/index', [
    'title' => 'Проспект Партс',
    'keywords' => 'ремонт в москве, ремонт машин в мытищи, ремонт двигателя, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Каталог, широкий ассортимент комплектующих и расходных материалов для грузовых автомобилей',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Проспект Партс')

@section('content')
<div style="height: 1000px" class="mt-5 pt-5">
    <div style="color: {{$сolors::hex(10066329)}}; {{$сolors::background($сolors::hex(10066329))}};width: 100px; height: 100px">
        Текст
    </div>    
</div>

@endsection