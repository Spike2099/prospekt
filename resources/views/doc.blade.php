@extends('layout/index', [
    'title' => 'Юридическая информация | Проспект Транс',
    'keywords' => 'юридическая, сервис, service, информация, автосервис, мерседес бенц, актрос',
    'description' => 'Юридическая информация компании ООО "Проспект Транс"',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Юридическая информация')

@section('content')
<div class="w-100 bg-primary" style="height: 170px">
    <div class="d-flex justify-content-center align-items-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0 mt-1">Юридическая информация</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div>
                    <ul class="list-group list-group-flush text">
                        <li class="list-group-item">
                            <a href="/doc/license" class="text-dark">
                                Пользовательское соглашение
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/doc/privatepolice" class="text-dark">
                                Политика конфиденциальности
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/doc/responsibility" class="text-dark">
                                Отказ от ответственности
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/doc/guaranty" class="text-dark">
                                Условия гарантии
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="/doc/return-policy" class="text-dark">
                                Правила возврата
                            </a>            
                        </li>
                    </ul>
                </div>    
            </div>            
        </div>
    </div>
</section>
@endsection