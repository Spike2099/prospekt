@php
    $result = array_merge($listorder, $bestsellers, $alllist);
    $size = session('search') ? session('search')['meta']['size'] : '';
    $stock = count($product['rows']) !== 0 ?  $stockId : '';
    $title = $stock === '' ? 'Пусто' : $stock;
@endphp

@extends('layout/index', [
    'title' => 'Каталог запчастей Mercedes-Benz | Проспект Партс',
    'keywords' => 'ремонт в москве, ремонт машин в мытищи, ремонт двигателя, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Каталог запчастей Mercedes-Benz, широкий ассортимент комплектующих и расходных материалов для грузовых автомобилей',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Каталог запчастей Mercedes-Benz | Проспект Партс')

@section('content')
    <section class="bg-secondary-subtle catalog">
        <div class="container position-relative py-4 py-lg-2">
            @if (session('error'))
                <x-alert type="warning" header=" " message="{{session('error')}}"/>
            @endif
            @if(session('search'))
                @if($size === 0)
                    {{--replacement--}}
                    @include('layout.main.ui.empty.no-result', ['text' => session('text'), 'analog' => session('analog')])
                @else
                    <p>{{$decl::search($size)}} 
                    <span class="badge bg-danger text-white rounded-pill">{{$size}}</span>
                    </p>
                    <div class="row g-2">
                      
                        @foreach(session('search')['rows'] as $item)
                            @if(isset($item['article']))
                            
                                <div class="col-lg-3 col-12">
                                    <div class="card card-data border-0 shadow order">
                                        <a href="/product/mercedes-benz/{{$item['id']}}"
                                           class="card-body pb-0 position-relative">
                                            <div
                                                    itemprop="aggregateRating"
                                                    itemscope
                                                    itemtype="https://schema.org/AggregateRating"
                                                    class="d-flex align-items-center gap-1 z-3 position-absolute rounded-2 m-2"
                                            >
                                                @include('layout.main.ui.badge.stock', ['stock' => $item['productFolder']['id']])
                                                <meta itemprop="worstRating" content="1">
                                                <meta itemprop="ratingValue" content="4.9">
                                                <meta itemprop="bestRating" content="5">
                                            </div>
                                            <img
                                                    loading="lazy"
                                                    itemprop="image"
                                                    src="{{$images::src($item['id'])}}"
                                                    class="card-img-top rounded"
                                                    alt="{{$item['name']}}, Проспект Транс, {{$item['pathName']}}"
                                            />
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold fs-6" style="height: 39px">
                                                <a itemprop="name" href="/product/mercedes-benz/{{$item['id']}}">
                                                    {{mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8")}}
                                                </a>
                                            </h5>
                                            <hr style="color: #ddd">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    @if ($item['productFolder']['id'] === 'stockMercedesBenz')
                                                        <p
                                                                itemprop="offers"
                                                                itemscope
                                                                itemtype="https://schema.org/Offer"
                                                                class="{{$images::quantity($item['quantity'])['class']}}"
                                                        >
                                                            <link itemprop="availability"
                                                                  href="https://schema.org/InStock">
                                                            {{$images::quantity($item['quantity'])['text']}}
                                                           
                                                        </p>
                                                    @else
                                                        <p
                                                                itemprop="offers"
                                                                itemscope
                                                                itemtype="https://schema.org/Offer"
                                                                class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}"
                                                        >
                                                            <link itemprop="availability"
                                                                  href="https://schema.org/InStock">
                                                            {{$item['quantity'] == 0 ? 'Нет в наличии' : 'В наличии '.$item['quantity']}}
                                                        </p>
                                                    @endif
                                                </div>
                                                <strong>
                                                    {!!$currency::summa($item['salePrices'][0]['value'])!!}
                                                </strong>
                                            </div>
                                            <hr style="color: #ddd">
                                            <div class="d-flex align-items-center justify-content-between">
                                            
                                            
                                       <!--<div class="d-flex align-items-center gap-2">
                                               <div>
                                       <img src="/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 37px;
                                                       height: 37px">
                                                   </div>
                                                
                                                   <div class="lh-sm">
                                                       <small class="text-muted d-block w-100">
                                                           {{$item['article']}} 
                                                      
                                                   </small>
                                                   <strong class="text-secondary">Mercedes-Benz</strong>
                                               </div>
                                       </div>-->
                                            
                                                
                                                @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                                                
                                                <!-- вот здесь добавить кнопку копирования после поиска -->
                                                <div>
                                                    @if($item['quantity'] == 0)
                                                    
                                                    
                                                        <div onclick="isNotSignUp()"
                                                             class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                            <x-icon-add-card size="25px" color="#fff"/>
                                                        </div>
                                                        
                                                    @else
                                                      <div
                                                         id="card{{$item['id']}}"
                                                        data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
                                                        v-on:click="addToCard('{{$item['id']}}')"
                                                        class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2"
                                                        >
                                                            <x-icon-add-card size="25px" color="#fff"/>
                                                        </div>
                                                        
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    @if (!empty(session('analog')['rows']) && count(session('analog')['rows']) > 0)
                        <x-alert type="warning" header=" " message="По запросу <strong>{{session('text')}}</strong> есть аналоги:"/>
                        <div class="row g-2">
                            @foreach(session('analog')['rows'] as $item)
                                @if (isset($dashboard))
                                    @include('layout.main.ui.empty.dashboard.card')
                                @else
                                    @include('layout.main.ui.empty.index.card')
                                @endif
                            @endforeach
                        </div>
                    @endif
                @endif
                
            @else
                <div class="row" itemscope itemtype="https://schema.org/Product">
                    <div class="d-flex justify-content-between">
                        <h2 class="text fw-bold text-dark">{{$stock['name'] ?? 'Name not available' }}</h2>
                        <div class="d-print-none">
                            <div id="loadingpage" class="text"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <hr/>
                    </div>
                    <div class="col-12 d-flex align-items-center justify-content-between py-3">
                        <p class="text text-muted m-0">

                            Всего {{$product['meta']['size']}} {{$decl::cart($product['meta']['size'])}}

                        </p>
                        <div>
                            <select id="selectOffset" class="form-select" onchange="selectOffset()">
                                @foreach ([12, 24, 48, 64, 100] as $key)
                              
                                    <option value="/products/mercedes-benz/{{$key}}/0"
                                            @if($key == $limit) selected @endif >
                                        {{$key}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="btn-group">
                            <button class="btn border-0" :class="[design === 'grid' ? 'bg-dark-subtle' : 'bg-white']"
                                    v-on:click="isGrid()">
                                <x-icon-grid size="27px"/>
                            </button>
                            <button class="btn border-0" :class="[design === 'line' ? 'bg-dark-subtle' : 'bg-white']"
                                    v-on:click="isLine()">
                                <x-icon-line size="27px"/>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-2 grid-design">
                    @include('layout.main.ui.card.card-empty')
                </div>

                <div class="row g-2" itemscope itemtype="https://schema.org/Product">
                    <!--@include('product.card.image') и тд. -->
                    @foreach ($product["rows"] as $item)
                        <template v-if="design === 'line'">
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between bg-white py-2 px-3 shadow-sm mb-1 rounded">
                                    <div class="d-flex gap-3 w-50 align-items-center">
                                        <div style="width: 50px;height: 50px;overflow: hidden;background: #ddd;border-radius: 5px">
                                            @include('layout.main.ui.card.card-image')
                                        </div>
                                        <div class="text-start">
                                            @include('layout.main.ui.card.card-title')
                                        </div>
                                    </div>
                                    <div class="w-25">
                                        @include('layout.main.ui.quantity.quantity')
                                    </div>
                                    <div class="px-4">
                                        @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                                    </div>
                                    <div>
                                        @include('layout.main.ui.button.card-button')
                                    </div>
                                    
                                    <div>
                                    <button class="copy-button" data-clipboard-text="{{ $item['article'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a2 2 0 0 1 2-2h1v1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-lg-3 col-12">
                                <div class="card card-data border-0 shadow-sm order">
                                
                                    @include('layout.main.ui.card.card-image')
                                    <div class="card-body">
                                        <div style="height: 39px">
                                            @include('layout.main.ui.card.card-title')
                                        </div>
                                        <hr style="color: #ddd">
                                        @include('layout.main.ui.quantity.quantity')
                                        <hr style="color: #ddd">
                                        
                    <div class="d-flex align-items-center justify-content-between">
                                @include('layout.main.ui.logo.car-logo', ['stock' => $item['productFolder']])
                    <button class="bi bi-copy copy-button" data-clipboard-text="{{$item['article']}}">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-copy" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M4 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 5a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1h1v1a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h1v1z"/>
                        </svg>
                    </button>
                                <div class="d-flex align-items-center">
                                    @include('layout.main.ui.button.card-button')
                                    
                                    <!-- Кнопка для копирования артикула -->
                                </div>
                            </div>

                                    </div>
                                </div>
                            </div>
                        </template>
                    @endforeach


                    @if (isset($product['meta']['nextHref']) || $offset > 0)
                        <div class="mt-5 d-flex align-items-center justify-content-between">
                            <div>
                                <select id="selectOffsetBottom" class="form-select" onchange="selectOffsetBottom()">
                                    @foreach ([12, 24, 48, 64, 100] as $key)
                                        <option value="/products/mercedes-benz/{{$key}}/0"
                                                @if($key == $limit) selected @endif >
                                            {{$key}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <nav>
                                <ul class="pagination m-0">
                                    @if (isset($product['meta']['previousHref']))
                                            <?php
                                            $url_previous = parse_url($product['meta']['previousHref'], PHP_URL_QUERY);
                                            parse_str($url_previous, $previous);
                                            ?>
                                        <li class="page-item p-0">
                                            <a class="page-link text-primary border-0"
                                               href="/products/mercedes-benz/{{$previous['limit']}}/{{$previous['offset']}}">
                                                <span>&laquo;</span> Назад
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item p-0 disabled">
                                            <a class="page-link border-0">
                                                <span>&laquo;</span> Назад
                                            </a>
                                        </li>
                                    @endif

                                    @if (isset($product['meta']['nextHref']))
                                            <?php
                                            $url_next = parse_url($product['meta']['nextHref'], PHP_URL_QUERY);
                                            parse_str($url_next, $next);
                                            ?>
                                        <li class="page-item p-0">
                                            <a class="page-link text-primary border-0"
                                               href="/products/mercedes-benz/{{$next['limit']}}/{{$next['offset']}}">
                                                Далее <span aria-hidden="true">&raquo;</span>
                                            </a>
                                        </li>
                                    @else
                                    @endif
                                </ul>
                            </nav>
                            <div>
                                Показано:
                                <span>
                                @if($product['meta']['size']-$offset < $limit)
                                        {{$offset+$product['meta']['size']-$offset}}
                                    @else
                                        {{$offset == 0 ? $limit : $limit+$offset}}
                                @endif
                            </span> из
                                <span>{{$product['meta']['size']}}</span>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
    
    
    <!-- Добавьте этот скрипт после подключения Clipboard.js -->
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