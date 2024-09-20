@extends('layout/index', [
    'title' => 'Информация для поставщиков | Проспект Транс',
    'keywords' => 'партнёры, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация для поставщиков',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Информация для поставщиков')

@section('content')
<div class="w-100" style="background-image: url(/img/abstract-polygonal.jpg);background-position: 0px -1005px;background-attachment: fixed;background-size: cover;height: 250px;text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0">Информация для поставщиков</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <h4 class="text fw-bold">По вопросам сотрудничества</h4>
            <p>Пишите на почту - <a href="mailto:prospekt-trans@ro.ru">prospekt-trans@ro.ru</a></p>
        </div>
    </div>
</section>
@endsection