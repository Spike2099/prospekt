@extends('layout/index', [
    'title' => 'Наше производство | Проспект Партс',
    'keywords' => 'сервис, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация о компании.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Страница Ошибки')

@section('content')
<div class="w-100" style="background-image: url(/img/sklad.jpg); background-position: center -180px; background-attachment: fixed; background-size: cover; height: 250px; text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">Коды неисправности Mercedes-Benz</h2>
    </div>
</div>

<section class="bg-white">
    <div class="container">
        <div class="row">
    <div class="container">
        
        <th><h1>Код ошибки: {{ $errorCode->code }}</h1></th></br>
        <th><p class="Error_text_size">Описание ошибки: {{ $errorCode->description }}</p></th>
        <!-- Другая инфорация об ошибке -->
    </div>
        </div>
    </div>
</section>
@endsection
