@extends('layout/index', [
    'title' => config('app.name'),
    'keywords' => 'ремонт, ремонт машин, ремонт в москве, ремонт в мытищи, ремонт двигателя, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Интернет-магазин `Prospekt Parts` - уникальная торговая платформа, которая позволяет мгновенно, в режиме реального времени, получать информацию о реальных остатках и условиях поставки',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])
@section('title', 'Prospekt Parts')
@section('content')
 <section id="about" class="bg-hero coral position-relative overflow-hidden" style="
    background-image: url(/img/mainlogo.jpeg);
    background-size: cover;
    background-position: center center;
    box-shadow: inset 0px -48px 254px 86px #000000bf;
" href = "/products/mercedes-benz">
     
     <a href="/products/mercedes-benz" class="text-decoration-none " style="color:white">
    <div class="container h-100">
        
       <p class="d-none d-lg-inline copyright">© 2024 &middot; Все права защищены</p>
        <div class="row pt-4 h-100">

            <div class="col-12 col-lg-7 d-block d-lg-flex justify-content-start align-items-center align-self-center">
                <div style="position: relative;">
                </div>
          
        </div>
                <div class="d-flex flex-column gap-3 position-relative z-3 p-3 p-lg-0">
                    <h1 itemprop="description" class="fw-bold lh-1 display-4">
                         {{-- shock-wive --}}
                        <span class="text-primary">Оригинальные запчасти</span>,
                        комплектующие <br />Mercedes Benz
                        <br />
                        <span class="text-primary">В Наличии</span></br>
                         <span class="text-primary">Занимаемся Подбором</span>
                         {{-- shock-wive-inline --}}
                    </h1>
                    <p class="fs-6 w-100 text">
                        Широкий ассортимент инструментов и оборудования 
                        <br />для станций технического обслуживания.
                    </p>
                    <div class="d-grid d-lg-flex align-items-center gap-3 gap-lg-4 w-100">
                        <a href="/signup" class="btn btn-lg btn-primary px-5 py-3 d-flex justify-content-center align-items-center gap-2">
                            <x-icon-open-in-new size="25px" color="#fff" />
                            Зарегистрироваться
                        </a>
                        <a href="/products/mercedes-benz" class="btn btn-lg btn-dark px-5 py-3 d-flex justify-content-center align-items-center gap-2">
                            <x-icon-subdirectory-arrow-right size="25px" color="#fff" />
                            Склад Mercedes-Benz
                        </a>
                    </div>
                    <div class="d-flex align-items-center w-100 py-2">
                        <div class="border-end border-dark-subtle pe-3 pe-lg-4 lh-1">
                            <strong class="fs-1 text fw-bold">8+</strong>
                            <p class="m-0">Лет на рынке</p>
                        </div>
                        <div class="border-end border-dark-subtle px-3 px-lg-4 lh-1">
                            <strong class="fs-1 text fw-bold">10+</strong>
                            <p class="m-0">Производителей</p>
                        </div>
                        <div class="px-3 px-lg-4 lh-1">
                            <strong class="fs-1 text fw-bold">226K+</strong>
                            <p class="m-0">Запчастей</p>
                        </div>
                    </div>
                </div>
            </div>
<!--                     <div class="col-12 col-lg-5">
    <x-hero-card />
</div> -->
        </div>
        </a>
    </div>
</section>

    <section id="bestsellers" class="bg-secondary-subtle d-lg-block">
<div class="container" itemscope itemtype="https://schema.org/ItemList">
<div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/OilStock" class="text-decoration-none " style="color:white">
        <div class="DongBanner p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/oils.jpg);background-size: cover;background-position: center center;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><!-- <span class="text-danger">Коды Ошибок!</span> -->Mercedes-Benz Масло<br>В нашем ассортименте появились Мотороное, Трансмиссионное , Компрессорное Масло</h2>
            <div class="d-grid d-lg-flex gap-3">
                <!-- <a href="/signup" class="btn btn-lg btn-primary px-5 d-flex justify-content-center align-items-center gap-2">
                    <x-icon-add color="#fff" />
                    Участвовать
                </a> -->
                <a class="btn btn-lg btn-outline-light px-5" href="/OilStock">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>
            
            
<div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/dongfengParts" class="text-decoration-none " style="color:white">
        <div class="DongBanner p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/dongfengbanner.jpg);background-size: cover;background-position: center center;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><!-- <span class="text-danger">Коды Ошибок!</span> -->Dong Feng<br>Наш партнёр и мировой лидер работает вместе с нами</h2>
            <div class="d-grid d-lg-flex gap-3">
                <!-- <a href="/signup" class="btn btn-lg btn-primary px-5 d-flex justify-content-center align-items-center gap-2">
                    <x-icon-add color="#fff" />
                    Участвовать
                </a> -->
                <a class="btn btn-lg btn-outline-light px-5" href="/dongfengParts">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/errorcode" class="text-decoration-none " style="color:white">
        <div class="p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/banner.jpg);background-size: cover;background-position: center bottom;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><span class="text-danger">Коды Ошибок!</span>Список кодов<br>Неисправностей MERCEDES BENZ ACTROS</h2>
            <div class="d-grid d-lg-flex gap-3">
                <!-- <a href="/signup" class="btn btn-lg btn-primary px-5 d-flex justify-content-center align-items-center gap-2">
                    <x-icon-add color="#fff" />
                    Участвовать
                </a> -->
                <a class="btn btn-lg btn-outline-light px-5" href="/errorcode">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>

<div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/dealer" class="text-decoration-none " style="color:white">
        <div class="DongBanner p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/worklogo-min.jpg);background-size: cover;background-position: center center;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><!-- <span class="text-danger">Коды Ошибок!</span> -->Размещайте на нашем сайте<br>ваши запчасти и зарабатывайте !</h2>
            <div class="d-grid d-lg-flex gap-3">
                <a class="btn btn-lg btn-outline-light px-5" href="/dealer">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>


<!-- <div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/production" class="text-decoration-none " style="color:white">
        <div class="DongBanner p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/compr.gif);background-size: cover;background-position: center center;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><span class="text-danger">Коды Ошибок!</span>Качественные<br>Оригинальные детали , а также Аналоги сделаны на лучших заводах, теперь и на наших складах</h2>
            <div class="d-grid d-lg-flex gap-3">
                <a class="btn btn-lg btn-outline-light px-5" href="/production">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div> -->

            <div class="row">
<!--             <div class="ProductGrid mb-5">
<div class="ProductGrid mb-5"> -->
<div class="ProductGrid mb-5 row g-2">
    <div class="col-md-3 col-12" data-description="POWERHUB Тормозные диски/колодки">
        <a href="stock/81cf7449-727a-11ee-0a80-130600173515/10/0">
            <img src="/img/goods/promo/powerhub.png" alt="Powerhub" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="GMS Водяные насосы">
        <a href="stock/a2a12edf-1642-11ee-0a80-13ab00041ab9/10/0"> 
            <img src="/img/goods/promo/gms.png" alt="GMS" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="POWERHUB Фильтры">
        <a href="stock/d295833c-8399-11ee-0a80-0fb9000b7477/10/0">
            <img src="/img/goods/promo/powerhubF.png" alt="POWERHUB-FILTER" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="SUOTEPOWER Турбины">
        <a href="stock/c07653f3-5d3d-11ee-0a80-0418001257ed/10/0">
            <img src="/img/goods/promo/suotepower.png" alt="SUOTE" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="MVS Маховики">
        <a href="stock/ef56740b-77e0-11ee-0a80-0cfa001004ff/10/0">
            <img src="/img/goods/promo/mvs.png" alt="MVS" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="SUNEX запчасти скоро будут в Наличии!">
        <a href="stock/6f6ad146-794c-11ee-0a80-0290001d2dad/10/0">
            <img src="/img/goods/promo/sunex.png" alt="SUNEX" class="w-100 h-100  rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="DONGFA Коленвалы">
        <a href="stock/e0cb6ca7-7a53-11ee-0a80-02dc001281c2/10/0">
            <img src="/img/goods/promo/dongfa.png" alt="DONGFA" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="PROXMANN Гильзы">
        <a href="stock/3880dce6-9da5-11ee-0a80-084c0025ddf8/10/0">
            <img src="/img/goods/promo/proxman.png" alt="PROXMANN" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
</div>
    <!--     </div> -->
<!--             
        </div> -->
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 text-center">
                    <h2 class="fw-bold display-5">Хиты продаж <img src="/img/index/fire.png" style="width: 35px" alt="Хиты продаж" /></h2>
                    <p class="text-muted text">
                        Самые ходовые товары из Германии с проверенным ГТД. 
                        У нас только новые запчасти от производителя. 
                        Мы специально не стали обрабатывать фотографии, чтобы вы видели оригинальное качество запчастей.
                    </p>
                </div>
            </div>
            
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
              
            <div class="row g-2 py-4" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
                @foreach ($bestsellers as $best)
                <div class="col-12 col-lg-3">
                    <div class="card card-data border-0 shadow order">
                        <a href="/product/mercedes-benz/<?=$best['href'];?>" class="card-body pb-0 position-relative">
                            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="d-flex align-items-center gap-1 z-3 position-absolute px-2 rounded-2 bg-light m-2">
                                <x-icon-favorite color="#b02a37" />
                                <small><?=$best['raiting'];?> рейтинг</small> 
                                <meta itemprop="worstRating" content="1" />
                                <meta itemprop="ratingValue" content="<?=$best['raiting'];?>" />
                                <meta itemprop="bestRating" content="5" />
                            </div>
                            <img 
                                itemprop="image"
                                src="<?=$best['image'];?>" 
                                class="card-img-top rounded"
                                alt="<?=$best['name'];?>, Проспект Транс" 
                            />
                        </a>
                        <div class="card-body pb-0">
                            <h5 class="card-title fw-bold fs-6" style="height: 38px">
                                <a itemprop="name" href="/product/mercedes-benz/<?=$best['href'];?>"><?=$best['name'];?></a>
                            </h5>
                            <hr style="color: #ddd" />
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="d-flex justify-content-between">
                                <div class="lh-sm">
                                    <small class="text-muted d-block w-100">Марка</small>
                                    <strong itemprop="brand" class="text-secondary">Mercedes-Benz</strong>
                                </div>
                                <div class="lh-sm">
                                    <meta itemprop="priceCurrency" content="RUB">
                                    <link itemprop="availability" href="http://schema.org/InStock">
                                    <small class="text-muted d-block w-100">Артикул</small>
                            
                                    <strong itemprop="model" class="text-secondary">
                                        <?=$best['article'];?>
                                    </strong>
                                </div>
                            </div>
                            <hr class="mb-1" style="color: #ddd" />
                        </div>
<!--                         <div class="card-footer border-top-0 bg-white d-grid">
    <div 
        id="card{{$loop->iteration}}" 
        data-card="{{$best['href']}},{{$best['article']}},{{$best['name']}},1,{{$best['price']}},{{$best['price']}},{{$best['image']}}" 
        v-on:click="addToCard({{$loop->iteration}})"
        class="btn btn-primary mb-2 text d-flex align-items-center justify-content-center gap-2 py-2"
    >
        <x-icon-add-card size="25px" color="#fff" />
        <strong>В корзину</strong> 
    </div>
</div> -->
                    </div>
                </div>                                
                @endforeach
            </div>
            
            </div>
            
            
            <div class="carousel-item active">
            <div class="row g-2 py-4" itemprop="itemListElement" itemscope itemtype="http://schema.org/Product">
                @foreach ($bestsellers2 as $best)
                <div class="col-12 col-lg-3">
                    <div class="card card-data border-0 shadow order">
                        <a href="/product/mercedes-benz/<?=$best['href'];?>" class="card-body pb-0 position-relative">
                            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating" class="d-flex align-items-center gap-1 z-3 position-absolute px-2 rounded-2 bg-light m-2">
                                <x-icon-favorite color="#b02a37" />
                                <small><?=$best['raiting'];?> рейтинг</small> 
                                <meta itemprop="worstRating" content="1" />
                                <meta itemprop="ratingValue" content="<?=$best['raiting'];?>" />
                                <meta itemprop="bestRating" content="5" />
                            </div>
                            <img 
                                itemprop="image"
                                src="<?=$best['image'];?>" 
                                class="card-img-top rounded"
                                alt="<?=$best['name'];?>, Проспект Транс" 
                            />
                        </a>
                        <div class="card-body pb-0">
                            <h5 class="card-title fw-bold fs-6" style="height: 38px">
                                <a itemprop="name" href="/product/mercedes-benz/<?=$best['href'];?>"><?=$best['name'];?></a>
                            </h5>
                            <hr style="color: #ddd" />
                            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="d-flex justify-content-between">
                                <div class="lh-sm">
                                    <small class="text-muted d-block w-100">Марка</small>
                                    <strong itemprop="brand" class="text-secondary">Mercedes-Benz</strong>
                                </div>
                                <div class="lh-sm">
                                    <meta itemprop="priceCurrency" content="RUB">
                                    <link itemprop="availability" href="http://schema.org/InStock">
                                    <small class="text-muted d-block w-100">Артикул</small>
                            
                                    <strong itemprop="model" class="text-secondary">
                                        <?=$best['article'];?>
                                    </strong>
                                </div>
                            </div>
                            <hr class="mb-1" style="color: #ddd" />
                        </div>
<!--                         <div class="card-footer border-top-0 bg-white d-grid">
    <div 
        id="card{{$loop->iteration}}" 
        data-card="{{$best['href']}},{{$best['article']}},{{$best['name']}},1,{{$best['price']}},{{$best['price']}},{{$best['image']}}" 
        v-on:click="addToCard({{$loop->iteration}})"
        class="btn btn-primary mb-2 text d-flex align-items-center justify-content-center gap-2 py-2"
    >
        <x-icon-add-card size="25px" color="#fff" />
        <strong>В корзину</strong> 
    </div>
</div> -->
                    </div>
                </div>                                
                @endforeach
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
            
            
            </div>
            
            
            
            <div class="row">
                <div class="col-8 offset-2 text-center mt-4">
                    <a href="/products/mercedes-benz" class="btn btn-lg btn-dark px-5">
                        Показать всё &#160; &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="spareparts" class="bg-white d-lg-block d-none">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3 text-center">
                    <h2 class="fw-bold display-5">Запасные части</h2>
                    <p class="text-muted text">
                        В наличии и под заказ есть запчасти
                        на следующие бренды для грузовых автомобилей по всей России: 
                        <i>Mercedes-Benz</i>, 
                        <i>Volvo</i>, 
                        <i>Renault Trucks</i>,
                        <i>Dong Feng</i>
                    </p>
                </div>
            </div>
            <div class="row pt-4 spates d-flex flex-wrap">
                <div class="col mb-4">
                   <a href="https://prospekt-parts.com/products/mercedes-benz" style="text-decoration: none; color: inherit;">  
                    <div class="card card-data border-light shadow-lg">
                        <div class="card-body text-center pt-5">
                            <img src="/img/actros___kopiya.png" style="cursor: default;height: auto;opacity: 1" class="w-100" alt="Mercedes-Benz">
                            <h5 class="fw-bold mt-3" style="cursor: default;text-decoration: 3px underline #8630a3;">Mercedes-Benz</h5>
                        </div>
                    </div>
                    </a>
                </div>
                
                <div class="col mb-4">
                    <a href="https://prospekt-parts.com/dongfengParts" style="text-decoration: none; color: inherit;">  
                    <div class="card card-data border-light shadow-lg">
                        <div class="card-body text-center pt-5">
                            <img src="/img/Dongfeng.jpeg" style="cursor: default;height: auto;opacity: 1" class="w-100" alt="Dong Feng">
                            <h5 class="fw-bold mt-3" style="cursor: default;text-decoration: 3px underline #8630a3;">Dong Feng</h5>
                        </div>
                    </div>
                    </a>
                </div>
        
                <div class="col mb-4">
                    <div class="card card-data border-light shadow-lg">
                        <div class="card-body text-center pt-5">
                            <img src="/img/volvo.png" style="cursor: default;height: auto;opacity: 1" class="w-100" alt="Volvo">
                            <h5 class="fw-bold mt-3" style="cursor: default;text-decoration: 3px underline #8630a3;">Volvo</h5>
                        </div>
                    </div>
                </div>
                <div class="col mb-4">
                    <div class="card card-data border-light shadow-lg">
                        <div class="card-body text-center pt-5">
                            <img src="/img/Renault.png" style="cursor: default;height: auto;opacity: 1" class="w-100" alt="Renault Trucks">
                            <h5 class="fw-bold mt-3" style="cursor: default;text-decoration: 3px underline #8630a3;">Renault Trucks</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="brand" class="bg-secondary-subtle pb-3">
        <div class="container">
            <div class="row">
                     <h2 class="fw-bold display-6 text">Товары в наличии</h2>
                <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center col-12">
                    <!-- <h2 class="fw-bold display-6">Товары в наличии</h2> -->
                    <div>
                        {{-- <select class="form-control px-5 d-lg-block d-none" name="brand">
                            <option value="Mercedes-Benz">Mercedes-Benz</option>
                            <option value="Volvo">Volvo</option>
                            <option value="Renault Trucks">Renault Trucks</option>
                        </select> --}}
                    </div>
                </div>
            </div>
            <div itemscope itemtype="https://schema.org/Product" class="row g-2 py-4 ng position-relative">
                @foreach ($listorder as $item)
                    <div class="col-lg-3 col-12">
                        <div class="card card-data border-0 shadow order">
                            <a href="/product/mercedes-benz/<?=$item['href'];?>" class="card-body pb-0 position-relative">
                                <div 
                                    itemprop="aggregateRating" 
                                    itemscope 
                                    itemtype="https://schema.org/AggregateRating" 
                                    class="d-flex align-items-center gap-1 z-3 position-absolute px-2 rounded-2 bg-light m-2"
                                >
                                    <x-icon-favorite color="#b02a37" />
                                    <small><?=$item['raiting']?> рейтинг</small> 
                                    <meta itemprop="worstRating" content="1" />
                                    <meta itemprop="ratingValue" content="<?=$item['raiting'];?>" />
                                    <meta itemprop="bestRating" content="5" />
                                </div>
                                <img 
                                    itemprop="image"
                                    src="<?=$item['image']?>"
                                    class="card-img-top rounded" 
                                    alt="<?=$item['name']?>, Проспект Транс"
                                />
                            </a>
                            <div class="card-body">
                                <h5 class="card-title fw-bold fs-6">
                                    <a itemprop="name" href="/product/mercedes-benz/<?=$item['href'];?>"><?=$item['name']?></a>
                                </h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <p itemprop="offers" itemscope itemtype="https://schema.org/Offer" class="label">
                                            <link itemprop="availability" href="https://schema.org/InStock" />В наличии
                                        </p>                                           
                                    </div>
                                    <div class="rating-result" style="bottom: 0">
                                        <?php $count = rand(4, 5); ?>
                                        <?php for ($i = 1; $i <= floor($count); $i++) { ?>
                                            <span class="active"></span>
                                        <?php } ?>
                                        <?php for ($i = 1; $i <= 5-floor($count); $i++) { ?>
                                            <span></span>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                                <hr style="color: #ddd">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center gap-2">
                                        <div>
                                            <img 
                                                src="/img/mercedes-benz.png" 
                                                alt="Mercedes-Benz" 
                                                style="width: 37px;height: 37px"
                                            />
                                        </div>
                                       <!--  asdasd -->
                                        <div class="lh-sm">
                                            <small class="text-muted d-block w-100">
                                                <?=$item['article']?>
                                                
                                            </small>
                                            <strong class="text-secondary">Mercedes-Benz</strong>
                                        </div>
                                    
                                    <div class="lh-sm">
                                            <small class="text-muted d-block w-100 mb-4">
                                                <?=$item['price']?> ₽
                                            </small>
                                         <!--    <strong class="text-secondary">Mercedes-Benz</strong> -->
                                        </div>
                                        
                                          <!--  asdasd -->
                                          
                                          
                                          
                                    </div>
                                    <div>
                                        <div 
                                            onclick="startGoods()"
                                            class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2"
                                        >
                                            <x-icon-add-card size="25px" color="#fff" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                                
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 text-center mt-3 mb-5">
                    <a href="/products/mercedes-benz" class="btn btn-lg btn-dark px-5">
                        Показать всё &nbsp; →
                    </a>
                </div>
            </div>
            <div class="row">
                
            </div>                        
        </div>
    </section>

    <section id="advantages" class="bg-secondary-subtle">
        <div class="container position-relative spates">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <img 
                        src="/img/stacey-gabrielle-koenitz-rozells.jpg" 
                        style="filter: saturate(250%);opacity: 0.5" 
                        alt="Наши преимущества" 
                        class="w-100 rounded mb-5 mb-lg-0" 
                    />
                </div>
                <div class="col-12 col-lg-7">
                    <div class="ps-4">
                        <h2 class="display-3 mb-4">Наши преимущества</h2>
                        <ul class="d-grid gap-4 list-unstyled">
                            <li class="d-flex feat">
                                <span class="mt-2 me-4">
                                    <x-icon-switch-access-shortcut-add size="40px" color="#310062" />
                                </span>
                                <div>
                                    <strong class="fs-2 text-secondary">Запасные части</strong>
                                    <p class="fs-5 text">1) Мы поставляем только оригинальные новые запчасти</p> 
                                </div>
                            </li>
                            <li class="d-flex feat">
                                <span class="mt-2 me-4">
                                    <x-icon-shield-with-heart size="40px" color="#310062" />
                                </span>
                                <div>
                                    <strong class="fs-2 text-secondary">Репутация</strong>
                                    <p class="fs-5 text">2) У нас очень хорошая репутация, нам доверяют многие компании</p>
                                </div>
                            </li>
                            <li class="d-flex feat">
                                <span class="mt-2 me-4">
                                    <x-icon-currency-rubler size="40px" color="#310062" />
                                </span>
                                <div>
                                    <strong class="fs-2 text-secondary">Цены</strong>
                                    <p class="fs-5 text">3) Мы не занимаемся перепродажами, поэтому у нас приемлемые цены</p>
                                </div>
                                
                            </li>
                            <li class="d-flex feat">
                                <span class="mt-2 me-4">
                                    <x-icon-pallet size="40px" color="#310062" />
                                </span>
                                <div>
                                    <strong class="fs-2 text-secondary">Доставка</strong>
                                    <p class="fs-5 text">4) Работаем со всеми транспортными компаниями</p>
                                </div>
                            </li>
                        </ul>                                    
                    </div>

                </div>
            </div>

            <div class="row mt-5">
                <div class="col-12 col-lg-6">
                    <div class="p-5 bg-primary text-white rounded text-center mb-4 mb-lg-0">
                        <h4 class="fw-lighter text-warning">Скоро для мобильного</h4>
                        <h3 class="fw-bold text">Скачать и установить</h3>
                        <p class="text">Наш сервис на следующих платформах:</p>
                        <div class="d-flex justify-content-center flex-column flex-lg-row gap-3 pt-3">
                            <button class="d-flex justify-content-center gap-2 btn btn-dark px-4 py-2" disabled>
                                <x-icon-google-play size="40px" color="#fff" />
                                <div class="d-flex align-self-center flex-column lh-sm text-start">
                                    <small class="text">Скачать на</small>
                                    <strong class="fw-bold text">Google Play</strong> 
                                </div>
                            </button>
                            <button class="d-flex justify-content-center gap-2 btn btn-dark px-4 py-2" disabled>
                                {{-- <img src="/img/apple_store.svg" style="width: 40px" alt="App Store" /> --}}
                                <x-icon-apple-store size="40px" color="#fff" />
                                <div class="d-flex align-self-center flex-column lh-sm text-start">
                                    <small class="text">Скачать на</small>
                                    <strong class="fw-bold text">App Store</strong> 
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 z-3 position-relative">
                    <div class="p-5 bg-white text-dark rounded text-center shadow">
                        <h4 class="fw-lighter text-primary">Наши партнёры</h4>
                        <h3 class="fw-bold text">В наличии и под заказ</h3>
                        <p class="text">мы работаем со следующими брендами:</p>
                        <div class="d-flex row justify-content-center gap-5 pt-4 brand" style="opacity: 0.6">
                            <img src="/img/logo-daf.png" class="col-6 col-lg-3" style="width: 100px" alt="DAF">
                            <img src="/img/renault.svg" class="col-6 col-lg-3" style="width: 60px;" alt="Renault">
                            <img src="/img/volvo.svg" class="col-6 col-lg-3" style="width: 62px;" alt="Volvo">
                            <img src="/img/mercedes-benz.svg" class="col-6 col-lg-3" style="width: 74px;" alt="Mercedes Benz">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection