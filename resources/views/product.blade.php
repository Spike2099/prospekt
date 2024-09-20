@php
    $str = mb_convert_case($product['name'], MB_CASE_TITLE, "UTF-8");
    $result = array_merge($listorder, $bestsellers, $alllist);
    $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
    //$image = $images::src($id);
    $price = $currency::rubl($product['salePrices']);
    $keywords = $seo::keywords($images::text($id)['description']);
    $description = isset($product['description']) ? 
        $product['article'] . ' | ' . $product['description'] : 
        $product['article']. ', MERCEDES-BENZ \ '.$price;
        
    $stock = $product['catalog']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175' ? 
        '/products/mercedes-benz' : 
        '/stock/'.$product['catalog']['id'];
    $quantity = $product['catalog']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175' ?
        '' : $product['volume'];

    $path = './img/goods/'.$product['article'].'.jpg';
    $image = (file_exists($path)) ? trim($path, '.') : '/img/placeholder.png';
    
@endphp

@extends('layout/index', [
    'title' => $str,
    'keywords' => $keywords.', деталь, ремонт, ремонт машин в мытищи, сервис, запчасти, чинить, автосервис, мерседес бенц, актрос',
    'description' => $description,
    'image' => $url.$image
])

@section('title', $str.' | Проспект Партс')

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
                                    <a href="{{$stock}}">
                                        {{$product['catalog']['name']}}
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{$str}}
                                </li>
                            </ol>
                        </nav>    
                        {{-- $product['catalog']['id'] --}}
                        @role('admin')
                            <a href="/dashboard/product/details/{{$id}}">ред.</a>
                        @endrole
                    </div>
                </div>
                
                
<!-- product blade script for ui stock mysql bd catalog -->
                
                <div class="col-12">
                    @if ($product['catalog']['id'] === '416a3aff-0f66-11ee-0a80-0d9c00124798')
                 <!--<x-alert 
                     type="warning" 
                     header="Внимание: " 
                     message="Доставка предзаказа осуществляется <strong>в течении 5 рабочих дней!</strong>"
                 /> -->
                    @elseif ($product['catalog']['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
              <!--           <x-alert 
                  type="warning" 
                  header="Внимание: " 
                  message="Доставка заказа осуществляется <strong>в течении 28 рабочих дней!</strong>"
              /> -->
                    @else
                    @endif
                </div>
                <div class="col-12 col-lg-6">
                    <div class="pe-0 pe-lg-5">
                        <img 
                            src="{{$image}}" 
                            class="w-100 rounded" 
                            itemprop="image"
                            style="height: 540px;object-fit: cover"
                            alt="{{$str}}" 
                        />
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h1 itemprop="name" class="fw-bold lh-1 display-5 mt-5 mt-lg-0">{{$str}}</h1>
                    <meta itemprop="brand" content="MERCEDES-BENZ" />
                    <p class="d-flex align-items-center gap-2 fs-5 w-100 text text-secondary">
                        
                        <p class="textarticle" itemprop="model">Артикул:</strong> {{$product['article']}}
                        
                        <span 
                            data-bs-toggle="tooltip" 
                            data-bs-title="Деталь на заказ"
                            class="text-primary cp mb-1" 
                        >
                            <x-icon-help color="#310062" />
                        </span>
              
                    </p>
                    <p class="description-block">Применяемость артикула можно проверить у наших менеджеров</br> по телефону: <strong>+7 901 733-18-66</strong></p>
                    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                        <meta itemprop="price" content="{{$currency::rubl($product['salePrices'], '')}}" /> 
                        <meta itemprop="priceCurrency" content="RUB" /> 
                        <div class="d-flex align-items-center justify-content-start gap-3">
                            <p class="textprice fs-4 text m-0">Цена: {!!$currency::summa($product['salePrices'])!!}</p>
                            <div class="vr" v-if="count !== 1"></div>
                            <div v-html="resultSumma('{{$product['salePrices']}}', count)" v-if="count !== 1" class="text text-success fw-bold"></div>                        
                        </div>                        
                    </div>
                    <div class="w-25">
                        @if ($images::text($id)['description'])
                            <a href="#more" class="fs-6 text text-secondary d-block mb-3">Описание</a>
                        @else
                            <p class="fs-6 w-100 text text-secondary"><!-- Оригинальные номера:</br> -->{{$product['description']}}</p>
                             <meta itemprop="brand" content="Оригинальные запчасти Мерседес Бенц, доставка и отправка в регионы" /> 
                        @endif
                    </div>
                    
                    <!--временная затычка вывода товара-->
                    @if($product['quantity'] == 0)
                        <p class="label label-danger">В наличии: {{$product['quantity']}}</p>
                    @else
                        <p class="label label-success">В наличии: {{$product['quantity']}}</p>
                    @endif

                     <div id="more" class="col-12 mt-4">
                        <div class="description-pos" itemprop="description">
                            {!!$images::text($id)['description']!!}
                        </div>
                    </div>
                
   
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
                    <hr style="color: #ddd" />
                    <div class="d-grid d-lg-flex align-items-center gap-4 w-100">
                        @if($product['quantity'] == 0)
                            <button onclick="isUserSubscribe()" class="btn btn-lg btn-primary px-5 py-3 d-flex justify-content-center align-items-center gap-2">
                                <x-icon-add-card size="25px" color="#fff" />
                                В корзину
                            </button>   
                        @else
                            <div class="d-flex justify-content-center rounded p-3 bg-white">
                                <span v-on:click="inCrementOne()" class="btn py-1">
                                    <x-icon-add color="#000" />
                                </span>
                                <span class="btn py-1" v-html="count"></span>
                                <button class="btn py-1" v-if="count == 1">
                                    <x-icon-remove color="#000" />
                                </button>
                                <button class="btn py-1" v-on:click="deCrementOne()" v-else>
                                    <x-icon-remove color="#000" />
                                </button>
                            </div>
                            @if($product['quantity'] == 0 || $product['salePrices'] == '0')
                                @guest
                                    <div>
                                        <a href="/signin" class="btn btn-dark px-5 py-3 d-flex align-items-center gap-2 justify-content-center">
                                            <x-icon-add-card />
                                            Предзаказ
                                        </a>
                                    </div>
                                @endguest
                                @auth
                                    <div  
                                        id="preorders1"
                                        data-order="{{$product['id']}},{{$product['article']}},{{$product['name']}},1,{{$product['salePrices']}}"
                                        v-on:click="addToOrder('s1')"
                                    >
                                        <button class="btn btn-dark px-5 py-3 d-flex align-items-center gap-2 justify-content-center">
                                            <x-icon-add-card />
                                            Предзаказ
                                        </button>
                                    </div>
                                @endauth
                            @else
                                <div 
                                id="card<?=$id?>"
                                :data-card="JSON.stringify([
                                    '<?=$id?>',
                                    '<?=$product['article']?>',
                                    '<?=$str?>',
                                    '<?= isset($product['category_id']) ? $product['category_id'] : 0 ?>',
                                    count,
                                    <?=$product['salePrices']?>,
                                    '<?=$image;?>'
                                ])"
                                v-on:click="addToCard('<?=$id?>', count )"
                                class="btn btn-lg btn-primary px-5 py-3 d-flex align-items-center gap-2 justify-content-center"
                            >
                                    <x-icon-add-card size="25px" />
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
                    
                    <p class="description-block">
                    Доставка и отправка транспортными компаниями.</br>Оригинальные запасные части в наличии и на заказ</b>
                    для Вашего Mercedes Benz.
                    </p>
                    
                    
                </div>
<div id="more" class="col-12 mt-4">
    <div class="mt-2 pt-2 text" itemprop="description">
    Предлагаем вашему вниманию широкий выбор оригинальных запасных частей для автомобилей. Всегда в наличии продукция от ведущих мировых производителей. Наши специалисты помогут вам подобрать необходимые комплектующие, предоставят профессиональную консультацию и ответят на все интересующие вопросы. Мы гарантируем высокое качество продукции и оперативную доставку. Заказывайте оригинальные запасные части у нас и будьте уверены в надёжности вашего автомобиля!
    </div>
</div>
            </div>
            
            
            <div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/signin" class="text-decoration-none " style="color:white">
        <div class="DongBanner p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/worklogo-min.jpg);background-size: cover;background-position: center center;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><!-- <span class="text-danger">Коды Ошибок!</span> -->Действует акция на первый заказ<br>И также скидка новому пользователю ,успейте зарегестрироваться и сэкономить до 5% на первой покупке</h2>
            <div class="d-grid d-lg-flex gap-3">
                <a class="btn btn-lg btn-outline-light px-5" href="/signin">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>
            
        </div>

<!-- Затычка карусели -->

<!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-flex justify-content-around">
                
                <a href="/product/mercedes-benz/2d667681-328f-11ee-0a80-1016000f76fa" style="text-decoration: none;"  class="border-class">
                    <img src="/img/goods/A0003238185.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt=""> 
                    <div class="text-center mt-2">A0003238185</div>
                </a>
              <a href="/product/mercedes-benz/0585bb51-3213-11ee-0a80-139a002d8414" style="text-decoration: none;" class="border-class">
                    <img src="/img/goods/A4700908352.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A4700908352</div>
                </a>
              
                <a href="/product/mercedes-benz/062178a5-3213-11ee-0a80-139a002d8458" style="text-decoration: none;" class="border-class">
                    <img src="/img/goods/A9604200120.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A9604200120</div>
                </a>
                
                <a href="/product/mercedes-benz/933734e7-6e75-11ee-0a80-14270010b11b" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A9360903755.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A9360903755</div>
                </a>
                
                <a href="/product/mercedes-benz/069710e6-3213-11ee-0a80-139a002d848c" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A4710902755.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A4710902755</div>
                </a>
            
                <a href="/product/mercedes-benz/07320620-3213-11ee-0a80-139a002d84d0" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A0290742502.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A0290742502</div>
                </a>
                
                <a href="/product/mercedes-benz/5a59097f-3291-11ee-0a80-06990010561c" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A9438900319.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A9438900319</div>
                </a>
            
                </a>
                
            
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-flex justify-content-around">
                
                <a href="/product/mercedes-benz/081bb31f-3213-11ee-0a80-139a002d8538" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A4720780480.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A4720780480</div>
                </a>
                
                <a href="/product/mercedes-benz/0849fff3-3213-11ee-0a80-139a002d854a" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A5410161620.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A5410161620</div>
                </a>
                
                <a href="/product/mercedes-benz/08f449f4-3213-11ee-0a80-139a002d85af" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A0169975746.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A0169975746</div>
                </a>
                
              <a href="/product/mercedes-benz/856b2840-3213-11ee-0a80-008300270a52" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A0060179721.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A0060179721</div>
                </a>
                
                <a href="/product/mercedes-benz/0c0219a3-3213-11ee-0a80-139a002d87c9" style="text-decoration: none;"class="border-class">
                    <img src="/img/goods/A0018206745.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
                    <div class="caption text-center mt-2">A0018206745</div>
                </a>
                
        <a href="/product/mercedes-benz/07725742-3213-11ee-0a80-139a002d84ec" style="text-decoration: none;">
            <img src="/img/goods/A9616902244.jpg" class="d-block" style="width: 150px; height: 150px; object-fit: cover;" alt="">
            <div class="caption text-center mt-2">A9616902244</div>
        </a>      
        
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Следующий</span>
    </button>
</div> -->

<!-- <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-flex justify-content-around">
                <div class="product-card">
                    <a href="/product/mercedes-benz/2d667681-328f-11ee-0a80-1016000f76fa" class="product-link">
                        <img src="/img/goods/A0003238185.jpg" class="product-image" alt=""> 
                        <div class="product-caption">
<div class="product-title">Втулка Резиновая Стойки С</div>
                            <div class="product-title">A0003238185</div>
                            <div class="product-price">1102.00  ₽</div>
<button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/069710e6-3213-11ee-0a80-139a002d848c" class="product-link">
                        <img src="/img/goods/A4710902755.jpg" class="product-image" alt=""> 
                        <div class="product-caption">
<div class="product-title">Втулка Резиновая Стойки С</div>
                            <div class="product-title">A4710902755</div>
                            <div class="product-price">10 093.00 ₽</div>
<button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                
                
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/0585bb51-3213-11ee-0a80-139a002d8414" class="product-link">
                        <img src="/img/goods/A4700908352.jpg" class="product-image" alt=""> 
                        <div class="product-caption">
           <div class="product-title">Картридж Фильтра Топливного Mb Actros/Antos Mp4</div>
                            <div class="product-title">A4700908352</div>
                            <div class="product-price">15 000.00 ₽</div>
                           <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                
            <div class="product-card">
                    <a href="/product/mercedes-benz/933734e7-6e75-11ee-0a80-14270010b11b" class="product-link">
                        <img src="/img/goods/A9360903755.jpg" class="product-image" alt=""> 
                        <div class="product-caption">
             <div class="product-title">Комплект Топливный Фильтров Mb Econic</div>
                            <div class="product-title">A9360903755</div>
                            <div class="product-price">9 000.00 ₽</div>
                        <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
            
                
                       <div class="product-card">
                    <a href="/product/mercedes-benz/0c0219a3-3213-11ee-0a80-139a002d87c9" class="product-link">
                        <img src="/img/goods/A0018206745.jpg" class="product-image" alt=""> 
                        <div class="product-caption">
             <div class="product-title">Комплект Топливный Фильтров Mb Econic</div>
                            <div class="product-title">A0018206745</div>
                            <div class="product-price">4 200.00 ₽</div>
                        <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
        
        
                Repeat for other product cards
            </div>
        </div>
        
    <div class="carousel-item">
            <div class="d-flex justify-content-around">
                
               <div class="product-card">
                    <a href="/product/mercedes-benz/081bb31f-3213-11ee-0a80-139a002d8538" class="product-link">
                        <img src="/img/goods/A4720780480.jpg" class="product-image" alt="">
                        <div class="product-caption">
<div class="product-title">Прокладка</div>
                            <div class="product-title">A4720780480</div>
                            <div class="product-price">2040.00 ₽</div>
<button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/0849fff3-3213-11ee-0a80-139a002d854a" class="product-link">
                        <img src="/img/goods/A5410161620.jpg" class="product-image" alt="">
                        <div class="product-caption">
            <div class="product-title">Прокладка</div>
                            <div class="product-title">A5410161620</div>
                            <div class="product-price">9 500.00 ₽</div>
                  <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/08f449f4-3213-11ee-0a80-139a002d85af" class="product-link">
                        <img src="/img/goods/A0169975746.jpg" class="product-image" alt="">
                        <div class="product-caption">
            <div class="product-title">Сальник</div>
                            <div class="product-title">A0169975746</div>
                            <div class="product-price">4 350.00 ₽</div>
                       <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/856b2840-3213-11ee-0a80-008300270a52" class="product-link">
                        <img src="/img/goods/A0060179721.jpg" class="product-image" alt="">
                        <div class="product-caption">
                        <div class="product-title">Форсунка Топливная Mb Actros Euro5</div>
                            <div class="product-title">A0060179721</div>
                            <div class="product-price">9 989.00 ₽</div>
                            <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>
                
                <div class="product-card">
                    <a href="/product/mercedes-benz/07320620-3213-11ee-0a80-139a002d84d0" class="product-link">
                        <img src="/img/goods/A0290742502.jpg" class="product-image" alt="">
                        <div class="product-caption">
                        <div class="product-title">Форсунка Топливная Mb Actros Euro5</div>
                            <div class="product-title">A0290742502</div>
                            <div class="product-price">29 220.00 ₽</div>
                            <button class="add-to-cart">В корзину</button>
                        </div>
                    </a>
                </div>

        </div>
        </div>
        Repeat for other carousel items
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Предыдущий</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Следующий</span>
    </button>
</div> -->

@endsection