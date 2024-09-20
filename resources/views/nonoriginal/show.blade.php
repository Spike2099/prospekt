@php
    $str = mb_convert_case($product['name'], MB_CASE_TITLE, "UTF-8");
    $result = array_merge($listorder, $bestsellers, $alllist);
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    //$image = $images::src($id);
    $price = $currency::rubl($product['price']);
    //$keywords = $seo::keywords($images::text($id)['description']);
    $description = isset($product['description']) ?
        $product['article'] . ' | ' . $product['description'] :
        $product['article']. ', MERCEDES-BENZ \ '.$price;
    $quantity =  $product['$quantity'];

    $path = './img/goods/'.$product['article'].'.jpg';
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';

@endphp
@extends('layout/index', [
    'title' => $product['name'] . ' | Проспект Партс',
    'keywords' => 'деталь',
    'description' => 'Деталь '. $product['name'] .', широкий ассортимент комплектующих и расходных материалов для грузовых автомобилей',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', $product['name'] . ' | Проспект Партс')

{{--@section('content')--}}
{{--    <!-- HTML и код Blade для отображения подробной информации о товаре -->--}}
{{--    <h2>{{ $product['name'] }}</h2>--}}
{{--    <!-- сюда пихаем другие детали товара при необходимости -->--}}
{{--@endsection--}}

@section('content')
    <section class="bg-secondary-subtle" itemscope itemtype="http://schema.org/Product">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4 mt-5 mt-lg-0">
                    <div class="d-flex justify-content-between">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                                <li class="breadcrumb-item">
                                    <a href="/originalParts">
                                        Запчасти
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$str}}
                                </li>
                            </ol>
                        </nav>
                        {{-- $product['catalog']['id'] --}}
                        @role('admin')
                           <!--  <a href="/dashboard/product/details/{{$product}}">ред.</a> -->
                        @endrole
<!--тут код для ред.-->
                    </div>
                </div>


                <!-- product blade script for ui stock mysql bd catalog -->

                <div class="col-12 col-lg-6">
                    <div class="pe-0 pe-lg-5">
                        <img
                                src="{{$image}}"
                                class="w-100 rounded"
                                itemprop="image"
                                style="height: 450px;object-fit: cover"
                                alt="{{$str}}"
                        />
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h1 itemprop="name" class="fw-bold lh-1 display-5 mt-5 mt-lg-0">{{$str}}</h1>
                    <meta itemprop="brand" content="MERCEDES-BENZ"/>
                    <p class="d-flex align-items-center gap-2 fs-5 w-100 text text-secondary">
                        <!--we need include all code, like that--> 
{{--                                @if(empty($product['description']))--}}
{{--                                    @include('product.card.remdays')--}}
{{--                                @endif--}}
     <!--                    <span 
         class="badge rounded-pill text-bg-danger px-3" 
         data-bs-toggle="tooltip"
         data-bs-title="Доставка заказа осуществляется в течении 5 рабочих дней"
     >
          Срок поставки 5 дней
     </span> -->
                        
                        <strong itemprop="model">Артикул:</strong> {{$product['article']}}

                        <span
                                data-bs-toggle="tooltip"
                                data-bs-title="Деталь на заказ"
                                class="text-primary cp mb-1"
                        >
                            <x-icon-help color="#310062"/>
                        </span>
                        
                        
                        <button class="bi1 bi-copy1 copy-button" data-clipboard-text="{{$product['article']}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-copy" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                            </svg>
                        </button>

                    </p>

                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="price" content="{{$currency::rubl($product['price'], '')}}"/>
                        <meta itemprop="priceCurrency" content="RUB"/>
                        <div class="d-flex align-items-center justify-content-start gap-3">
                            <p class="fs-4 text m-0">{!!$currency::summa($product['price'])!!}</p>
                    {{-- был форматтер--}}
                            <div class="vr" v-if="count !== 1"></div>
                            <div v-html="resultSumma('{{$product['price']}}', count)" v-if="count !== 1"
                                 class="text text-success fw-bold"></div>
                        </div>
                    </div>
                    <div class="w-25">
                        @if ($images::text($product['article'])['description'])
                            <a href="#more" class="fs-6 text text-secondary d-block mb-3">Описание</a>
                        @else
                            <p class="fs-6 w-100 text text-secondary">Описание:</br>{{$product['description']}}</p>
                        @endif
                    </div>
                    <p class="label label-success">В наличии: {{$product['quantity']}}</p>
                    
                    <!--временная затычка вывода товара-->
{{--                    <p class="label label-success">В наличии: {{$product['quantity']}}</p>--}}
{{--                    <div id="more" class="col-12 mt-4">--}}
{{--                        <div class="description-pos" itemprop="description">--}}
{{--                            {!!$images::text($id)['description']!!}--}}
{{--                        </div>--}}
{{--                    </div>--}}


                    {{-- Проверка текущего URL --}}
                    @if(request()->is('product/mercedes-benz/3e5da43a-7ecd-11ee-0a80-0e300006386f'))
                        {{-- Блок, который нужно отобразить только на указанной странице --}}
                        <video id="video_calenval" controls preload="false" autoplay loop muted>
                            <source src="/img/val_cardc.mp4" type="video/mp4">
                        </video>
                        <div class="play"></div>
                    @endif


                    <div class="w-100">
                        @if ($quantity === '')
                            @if($product['quantity'] == 0)
                                <!-- <p class="label-danger">
                        </p>&#160; -->
                                <span class="badge bg-secondary text">Деталь на заказ</span>
                            @else
                                <!--<p :class="[{{$product['quantity']}}-count >= 0 || {{$product['quantity']}}-count == 1 ? 'label' : 'label-danger']"> -->
                                <!-- потом мне это пригодится -->
                                <!-- <p class="label label-success">В наличии: {{$product['quantity']}}</p> -->
                                <link itemprop="availability" href="https://schema.org/InStock">
                                <!--<template>
                            В наличии
                            <span v-html="{{$product['quantity']}}" v-if="count == 1"></span>
                            <span v-html="{{$product['quantity']}}-count" v-else></span>
                        </template> -->
                                </p>
                            @endif
                        @else
                            @if($product['volume'] == 0)
                                <!-- {{$product['quantity']}} -->
                                <!-- <p class="label-danger"> -->
                                <!-- Нет в наличии -->
                                </p>&#160;
                                <!-- - <span class="badge bg-secondary text">Деталь на заказ</span> -->
                            @else
                                <p :class="[{{$product['volume']}}-count >= 0 || {{$product['volume']}}-count == 1 ? 'label' : 'label-danger']">
                                    <link itemprop="availability" href="https://schema.org/InStock">
                                    <template>
                                        В наличии
                                        <span v-html="{{$product['volume']}}" v-if="count == 1"></span>
                                        <span v-html="{{$product['volume']}}-count" v-else></span>
                                    </template>
                                </p>
                            @endif
                        @endif
                    </div>
                    <hr style="color: #ddd"/>
                    <div class="d-grid d-lg-flex align-items-center gap-4 w-100">
                        @if($product['quantity'] == 0)
                            <button onclick="isUserSubscribe()"
                                    class="btn btn-lg btn-primary px-5 py-3 d-flex justify-content-center align-items-center gap-2">
                                <x-icon-add-card size="25px" color="#fff"/>
                                В корзину
                            </button>
                        @else
                            <div class="d-flex justify-content-center rounded p-3 bg-white">
                                <span v-on:click="inCrementOne()" class="btn py-1">
                                    <x-icon-add color="#000"/>
                                </span>
                                <span class="btn py-1" v-html="count"></span>
                                <button class="btn py-1" v-if="count == 1">
                                    <x-icon-remove color="#000"/>
                                </button>
                                <button class="btn py-1" v-on:click="deCrementOne()" v-else>
                                    <x-icon-remove color="#000"/>
                                </button>
                            </div>
                            @if($product['quantity'] == 0 )
                                @guest
                                    <div>
                                        <a href="/signin"
                                           class="btn btn-dark px-5 py-3 d-flex align-items-center gap-2 justify-content-center">
                                            <x-icon-add-card/>
                                            Предзаказ
                                        </a>
                                    </div>
                                @endguest
                                @auth
                                    <div
                                            id="preorders1"
                                            data-order="{{$product['id']}},{{$product['article']}},{{$product['name']}},1,{{$product['price']}}"
                                            v-on:click="addToOrder('s1')"
                                    >
                                        <button class="btn btn-dark px-5 py-3 d-flex align-items-center gap-2 justify-content-center">
                                            <x-icon-add-card/>
                                            Предзаказ
                                        </button>
                                    </div>
                                @endauth
                            @else
                                <div
                                        id="card<?=$product['id']?>"
                                        :data-card="['<?=$product['id']?>,<?=$product['article']?>,<?=$str?>,{{$product['stock_category_id']}},'+count+',<?=$product['price']?>,'+<?=$product['price']?>*count+',<?=$image;?>']"
                                        v-on:click="addToCard('<?=$product['id']?>')"
                                        class="btn btn-lg btn-primary px-5 py-3 d-flex align-items-center gap-2 justify-content-center"
                                >
                                    <x-icon-add-card size="25px"/>
                                    В корзину
                                </div>
                            @endif
                        @endif
                    </div>
                    {{-- onclick="getReviewYandex()" --}}
                    <div class="d-flex justify-content-start mt-3">
                        <div class="rating-area">
                            <input type="radio" id="star-5" name="rating" value="5">
                            <label for="star-5" data-bs-toggle="tooltip" data-bs-title="Оценка «5»"></label>
                            <input type="radio" id="star-4" name="rating" value="4">
                            <label for="star-4" data-bs-toggle="tooltip" data-bs-title="Оценка «4»"></label>
                            <input type="radio" id="star-3" name="rating" value="3">
                            <label for="star-3" data-bs-toggle="tooltip" data-bs-title="Оценка «3»"></label>
                            <input type="radio" id="star-2" name="rating" value="2">
                            <label for="star-2" data-bs-toggle="tooltip" data-bs-title="Оценка «2»"></label>
                            <input type="radio" id="star-1" name="rating" value="1">
                            <label for="star-1" data-bs-toggle="tooltip" data-bs-title="Оценка «1»"></label>
                        </div>
                    </div>
                </div>
                <!--<div id="more" class="col-12 mt-4">
                <div class="mt-5 pt-5 text" itemprop="description">
                {{--{!!$images::text($id)['description']!!}--}}
                </div>
            </div>-->
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Инициализация Clipboard.js для кнопки с классом 'copy-button'
        var clipboard = new ClipboardJS('.copy-button');

        // Обработчик успешного копирования
        clipboard.on('success', function (e) {
            // Показать всплывающее окно с сообщением
            var successAlert = document.createElement('div');
            successAlert.classList.add('alert', 'alert-success', 'fixed-top', 'mt-2', 'ml-auto', 'mr-4');
            successAlert.innerHTML = 'Артикул скопирован успешно: ' + e.text;

            document.body.appendChild(successAlert);

            // Скрыть всплывающее окно через 2 секунды (или любое другое удобное время)
            setTimeout(function () {
                successAlert.style.opacity = '0';
                successAlert.style.transition = 'opacity 0.5s ease-out';

                setTimeout(function () {
                    successAlert.remove();
                }, 500);
            }, 2000);

            e.clearSelection();
        });

        // Обработчик ошибки копирования
        clipboard.on('error', function (e) {
            // Показать всплывающее окно с сообщением об ошибке
            var errorAlert = document.createElement('div');
            errorAlert.classList.add('alert', 'alert-danger', 'fixed-top', 'mt-2', 'ml-auto', 'mr-4');
            errorAlert.innerHTML = 'Ошибка при копировании. Используйте обычный метод (Ctrl+C или Cmd+C)';

            document.body.appendChild(errorAlert);

            // Скрыть всплывающее окно через 2 секунды (или любое другое удобное время)
            setTimeout(function () {
                errorAlert.style.opacity = '0';
                errorAlert.style.transition = 'opacity 0.5s ease-out';

                setTimeout(function () {
                    errorAlert.remove();
                }, 500);
            }, 2000);
        });
    });
</script>
        
@endsection