@php
    if(!isset($error)){
        $size = $search ? $search['meta']['size'] : 0;
        $stockSize = ($stockPositions ? count($stockPositions) : 0);
        $stockSize += ($stockPositionsNonOriginal ? count($stockPositionsNonOriginal) : 0);
        $stockSize += ($dongFeng ? count($dongFeng) : 0);
        $stockSize += ($colyman ? count($colyman) : 0);

        $description = isset($product['description']);
        }
@endphp
@extends('layout/main')
@section('title', 'Результат поиска: "'.$text.'"')

@section('content')
    <section class="bg-secondary-subtle catalog">
        <div class="container position-relative py-4 py-lg-2">
            @if (session('error'))
                <x-alert type="warning" header=" " message="{{session('error')}}"/>
            @endif
            @if($size === 0 && empty($analog))
                @include('layout.main.ui.empty.no-result', [
                    'text' => $text,
                    'link' => '/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0',
                    'dashboard' => true
                ])
            @else
                <p>{{$decl::search($size + $stockSize)}}
                    <span class="badge bg-danger text-white rounded-pill">{{$size + $stockSize}}</span>
                </p>

                @if($search || $stockPositions || $stockPositionsNonOriginal ||
                $dongFeng || $colyman)
                    <p>
                        Товар со Склада
                    </p>

                    <div class="row g-2">

                        <div class="container">
                            <!-- Header Row -->
                            <div class="row border-bottom py-3 d-flex align-items-center bg-light fw-bold">
                                <div class="col-12 col-md-1"></div> <!-- Empty column for image alignment -->
                                <div class="col-12 col-md-2">Бренд/артикул</div>
                                <div class="col-12 col-md-2">Наименование</div>
                                <div class="col-12 col-md-2">Наличие</div>
                                <div class="col-12 col-md-2">Сроки доставки</div>
                                <div class="col-12 col-md-1">Цена</div>
                                <div class="col-12 col-md-2"></div> <!-- Empty column for button alignment -->
                            </div>

                            @foreach($search['rows'] as $item)
                                @if(isset($item['article']))
                                    <div class="row border-bottom py-3 d-flex align-items-center">
                                        <!-- Image -->
                                        <div class="col-12 col-md-1 d-flex align-items-center">
                                            <div class="mb-0" style="width:65px; height:65px;">
                                                @include('layout.main.ui.card.card-image-dashboard')
                                            </div>
                                        </div>

                                        <!-- Бренд/Артикул -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                                <a itemprop="name"
                                                   href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                                   class="text-decoration-none">

                                                    Mercedes-Benz
                                                    {{--                                            {{$item['productFolder']['name']}}--}}
                                                </a><br>
                                                {{$item['article']}}
                                            </p>
                                        </div>

                                        <!-- Наименование -->
                                        <div class="col-12 col-md-2">
                                            <a itemprop="name"
                                               href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                               class="text-decoration-none">
                                                <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                            </a>
                                        </div>

                                        <!-- Наличие -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                                @if ($item['productFolder']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')
                                                    <span class="{{ $images::quantity($item['quantity'])['class'] }}">
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                                {{ $item['quantity'] }}
                                            </span>
                                                @else
                                                    <span class="{{ $item['quantity'] == 0 ? 'text-danger' : 'label ' }}">
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                                {{ $item['quantity'] == 0 ? 'Нет в наличии' : ' ' . $item['quantity'] }}
                                            </span>
                                                @endif
                                            </p>
                                        </div>

                                        <!-- Сроки Доставки -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                        <span class="badge rounded-pill text-bg-danger px-3"
                                              data-bs-toggle="tooltip"
                                              data-bs-title="Доставка заказа осуществляется в течении 1 или нескольких рабочих дней">
                                            В наличии
                                        </span>
                                            </p>
                                        </div>

                                        <!-- Цена -->
                                        <div class="col-12 col-md-1">
                                            <p class="mb-0">{!! $currency::summa($item['salePrices'][0]['value']) !!}</p>
                                        </div>

                                        <!-- Кнопка добавления в корзину -->
                                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                            <div>
                                                @if($item['quantity'] == 0)
                                                    <div onclick="isNotSignUp()"
                                                         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                        <x-icon-add-card size="25px" color="#fff"/>
                                                    </div>
                                                @else
                                                    <div id="card{{$item['id']}}"
                                                         data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},moysklad,1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
                                                         v-on:click="addToCard('{{$item['id']}}')"
                                                         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                        <x-icon-add-card size="25px" color="#fff"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>


                        <div class="container">
                            @foreach($stockPositions as $item)
                                @if(isset($item['article']))
                                    <div class="row border-bottom py-3 d-flex align-items-center">
                                        <!-- Image -->
                                        <div class="col-12 col-md-1 d-flex align-items-center">
                                            <div class="mb-0" style="width:65px; height:65px;">
                                                @include('layout.main.ui.card.card-image-dashboard')
                                            </div>
                                        </div>

                                        <!-- Бренд/Артикул -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                                <a itemprop="name"
                                                   href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                                   class="text-decoration-none">
                                                    Mercedes-Benz
                                                </a>
                                                {{$item['article']}}
                                            </p>
                                        </div>

                                        <!-- Наименование -->
                                        <div class="col-12 col-md-2">
                                            <a itemprop="name"
                                               href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                               class="text-decoration-none">
                                                <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                            </a>
                                        </div>

                                        <!-- Наличие -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                            <p itemprop="offers" itemscope itemtype="https://schema.org/Offer"
                                               class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}">
                                                <link itemprop="availability" href="https://schema.org/InStock">
                                                {{ $item['quantity'] == 0 ? 'Нет в наличии' : $item['quantity'] }}
                                            </p>
                                            </p>
                                        </div>

                                        <!-- Сроки Доставки -->
                                        <div class="col-12 col-md-2">
                                            <p class="mb-0">
                                        <span class="badge rounded-pill text-bg-danger px-3" data-bs-toggle="tooltip"
                                              data-bs-title="Доставка заказа осуществляется в течение 3-5 рабочих дней">
                                            Срок 3-5 дней
                                        </span>
                                            </p>
                                        </div>

                                        <!-- Цена -->
                                        <div class="col-12 col-md-1">
                                            <p class="mb-0">{!! $currency::summa($item['price'] * 100) !!}</p>
                                        </div>

                                        <!-- Кнопка добавления в корзину -->
                                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                            <div>
                                                @if($item['quantity'] == 0)
                                                    <div onclick="isNotSignUp()"
                                                         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                        <x-icon-add-card size="25px" color="#fff"/>
                                                    </div>
                                                @else
                                                    <div id="card{{$item['article']}}"
                                                         data-card="{{$item['article']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id']}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}"
                                                         v-on:click="addToCard('{{$item['article']}}')"
                                                         class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                        <x-icon-add-card size="25px" color="#fff"/>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>


                        <div class="container">
                            @foreach($stockPositionsNonOriginal as $item)
                                <div class="row border-bottom py-3 d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="col-12 col-md-1 d-flex align-items-center">
                                        <div class="mb-0" style="width:65px; height:65px;">
                                            @include('layout.main.ui.card.card-image-dashboard')
                                        </div>
                                    </div>
                                    <!--         <strong>Бренд/Артикул:</strong> -->
                                    <p class="mb-0">
                                        <a itemprop="name"
                                           href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                           class="text-decoration-none">
                                            {{ $item['brand'] ?? 'Brand' }} }
                                        </a>
                                        {{$item['article']}}
                                    </p>


                                    <!-- Наименование -->
                                    <div class="col-12 col-md-2">
                                        <!--     <strong>Наименование:</strong> -->
                                        <a itemprop="name"
                                           href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                           class="text-decoration-none">
                                            <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                        </a>
                                    </div>

                                    <!-- Наличие -->
                                    <div class="col-12 col-md-2">
                                        <!--   <strong>Наличие:</strong> -->
                                        <p class="mb-0">
                                        <p
                                                itemprop="offers"
                                                itemscope
                                                itemtype="https://schema.org/Offer"
                                                class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}"
                                        >
                                            <link itemprop="availability"
                                                  href="https://schema.org/InStock">
                                            {{ $item['quantity'] == 0 ? 'Нет в наличии' : $item['quantity'] }}
                                        </p>
                                        </p>
                                    </div>

                                    <!-- Сроки Доставки -->
                                    <div class="col-12 col-md-2">
                                        <!--         <strong>Сроки Доставки:</strong> -->
                                        <p class="mb-0">
                                        <span class="badge rounded-pill text-bg-danger px-3"
                                              data-bs-toggle="tooltip"
                                              data-bs-title="Доставка заказа осуществляется в течение 2 рабочих дней">
                                              Срок 2 дня
                                        </span>
                                        </p>
                                    </div>

                                    <!-- Цена -->
                                    <div class="col-12 col-md-1">
                                        <!--         <strong>Цена:</strong> -->
                                        <p class="mb-0">{!! $currency::summa($item['price'] * 100) !!}</p>
                                    </div>

                                    <!-- Кнопка добавления в корзину -->
                                    <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                        <div>
                                            @if($item['quantity'] == 0)
                                                <div onclick="isNotSignUp()"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @else
                                                <div id="card{{$item['article']}}"
                                                     data-card="{{$item['article']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id']}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}"
                                                     v-on:click="addToCard('{{$item['article']}}')"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- конец условия проверки session NonOriginal -->
                        <div class="container">
                            @foreach($dongFeng as $item)
                                <div class="row border-bottom py-3 d-flex align-items-center">
                                    <!-- Image -->
                                    <div class="col-12 col-md-1 d-flex align-items-center">
                                        <div class="mb-0" style="width:65px; height:65px;">
                                            @include('layout.main.ui.card.card-image-dashboard')
                                        </div>
                                    </div>
                                    <!-- Бренд/Артикул -->
                                    <div class="col-12 col-md-2">
                                        <!--     <strong>Бренд/Артикул:</strong> -->
                                        <p class="mb-0">
                                            <a itemprop="name"
                                               href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                               class="text-decoration-none">
                                                DongFeng
                                            </a>
                                            {{$item['article']}}
                                        </p>
                                    </div>

                                    <!-- Наименование -->
                                    <div class="col-12 col-md-2">
                                        <a itemprop="name"
                                           href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                           class="text-decoration-none">
                                            <!--     <strong>Наименование:</strong> -->
                                            <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                        </a>
                                    </div>

                                    <!-- Наличие -->
                                    <div class="col-12 col-md-2">
                                        <!--  <strong>Наличие:</strong> -->
                                        <p class="mb-0">
                                        <p
                                                itemprop="offers"
                                                itemscope
                                                itemtype="https://schema.org/Offer"
                                                class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}"
                                        >
                                            <link itemprop="availability"
                                                  href="https://schema.org/InStock">
                                            {{ $item['quantity'] == 0 ? 'Нет в наличии' : $item['quantity'] }}
                                        </p>
                                        </p>
                                    </div>

                                    <!-- Сроки Доставки -->
                                    <div class="col-12 col-md-2">
                                        <!--         <strong>Сроки Доставки:</strong> -->
                                        <p class="mb-0">
                                        <span class="badge rounded-pill text-bg-danger px-3"
                                              data-bs-toggle="tooltip"
                                              data-bs-title="Доставка заказа осуществляется в течение 2 рабочих дней">
                                              Срок 2 дня
                                        </span>
                                        </p>
                                    </div>

                                    <!-- Цена -->
                                    <div class="col-12 col-md-1">
                                        <!--        <strong>Цена:</strong> -->
                                        <p class="mb-0">{!! $currency::summa($item['price'] * 100) !!}</p>
                                    </div>

                                    <!-- Кнопка добавления в корзину -->
                                    <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                        <div>
                                            @if($item['quantity'] == 0)
                                                <div onclick="isNotSignUp()"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @else
                                                <div id="card{{$item['article']}}"
                                                     data-card="{{$item['article']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id']}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}"
                                                     v-on:click="addToCard('{{$item['article']}}')"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- <div> пока что тут -->
                        <div class="container">
                            @foreach($colyman as $item)
                                <!--  <div class="row border-bottom py-3"> -->
                                <div class="row border-bottom py-3 d-flex align-items-center">


                                    <div class="col-12 col-md-1 d-flex align-items-center">
                                        <div class="mb-0" style="width:65px; height:65px;">
                                            @include('layout.main.ui.card.card-image-dashboard')
                                        </div>
                                    </div>


                                    <!-- Бренд/Артикул -->
                                    <div class="col-12 col-md-2">
                                        <!--      <strong>Бренд/Артикул:</strong> -->
                                        <p class="mb-0">
                                            <a itemprop="name"
                                               href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                               class="text-decoration-none">
                                                Mercedes-Benz
                                            </a>
                                            {{$item['article']}}
                                        </p>
                                    </div>

                                    <!-- Наименование -->
                                    <div class="col-12 col-md-2">
                                        <a itemprop="name"
                                           href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                           class="text-decoration-none">
                                            <!--    <strong>Наименование(Турция):</strong> -->
                                            <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                        </a>
                                    </div>

                                    <!-- Наличие -->
                                    <div class="col-12 col-md-2">
                                        <!--  <strong>Наличие:</strong> -->
                                        <p class="mb-0">
                                        <p
                                                itemprop="offers"
                                                itemscope
                                                itemtype="https://schema.org/Offer"
                                                class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}"

                                        >
                                            <link itemprop="availability"
                                                  href="https://schema.org/InStock">
                                            {{ $item['quantity'] == 0 ? 'Нет в наличии' : 'Склад Турция ' . $item['quantity'] }}
                                        </p>
                                        </p>
                                    </div>

                                    <!-- Сроки Доставки -->
                                    <div class="col-12 col-md-2">
                                        <!--        <strong>Сроки Доставки:</strong> -->
                                        <p class="mb-0">
                                            @include('colyman.card.remdays')
                                        </p>
                                    </div>

                                    <!-- Цена -->
                                    <div class="col-12 col-md-1">
                                        <!--            <strong>Цена:</strong> -->
                                        <p class="mb-0">{!! $currency::summa($item['price'] * 100) !!}</p>
                                    </div>

                                    <!-- Кнопка добавления в корзину -->
                                    <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                        <div>
                                            @if($item['quantity'] == 0)
                                                <div onclick="isNotSignUp()"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @else
                                                <div id="card{{$item['id']}}"
                                                     data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'colyman'}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}"
                                                     v-on:click="addToCard('{{$item['id']}}')"
                                                     class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                    <x-icon-add-card size="25px" color="#fff"/>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!--                     <div class="row g-2">



                        <div> пока что тут

                    </div> -->
                @endif



                @if (!empty($analog))
                    @if(!empty($analog['notFound']))
                        @php
                            $notfound = implode(", ", $analog['notFound']);
                        @endphp
                                <!--                        <x-alert type="info" header=" "
     message="Аналоги"/> -->

                        <!--                                  message="По запросу <strong>{{session('text')}}</strong> также есть аналоги - <strong>{{$notfound}}</strong>,<br>Для их заказа свяжитесь с менеджером"/> -->
                    @endif


                    <div class="row border-bottom py-3 d-flex align-items-center bg-light fw-bold">
                        <div class="col-12 col-md-2"> <!-- Empty column for image alignment -->
                        </div>
                        <!--                <div class = "alert-light" role ="alert" type="light-alert" header=" "
                                 message="Аналоги:"/> -->
                        <div class="col-12 col-md-2">
                            <!--  <strong class="text-analog">Аналоги:</strong> -->
                        </div>
                    </div>
                    <div class="row g-2">
                        @if (!empty($analog['rows']) && count($analog['rows']) > 0)
                            @foreach($analog['rows'] as $item)
                                @if (isset($dashboard))
                                    @if(isset($item['article']))
                                        <div class="container">
                                            <div class="row border-bottom py-3 d-flex align-items-center">
                                                <!-- Изображение -->
                                                <div class="col-12 col-md-1">
                                                    @include('layout.main.ui.card.card-image-dashboard')
                                                </div>

                                                <!-- Бренд/Артикул -->
                                                <div class="col-12 col-md-2">
                                                    <!--       <strong>Бренд/Артикул:</strong> -->
                                                    <p class="mb-0">
                                                        <a itemprop="name"
                                                           href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                                           class="text-decoration-none">
                                                            Mercedes-Benz
                                                        </a>
                                                        {{$item['article']}}
                                                    </p>
                                                </div>

                                                <!-- Наименование -->
                                                <div class="col-12 col-md-2">
                                                    <a itemprop="name"
                                                       href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                                       class="text-decoration-none">
                                                        <!--          <strong>Наименование:</strong> -->
                                                        <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                                    </a>
                                                </div>

                                                <!-- Наличие -->
                                                <div class="col-12 col-md-2">
                                                    <!--  <strong>Наличие:</strong> -->
                                                    <p class="mb-0">
                                                        {{--                    @if ($item['productFolder']['id'] === '8854033a-48ad-11ed-0a80-0c87007f4175')--}}
                                                        {{--                        <span class="{{ $images::quantity($item['quantity'])['class'] }}">--}}
                                                        {{--                            <link itemprop="availability" href="https://schema.org/InStock">--}}
                                                        {{--                            {{ $images::quantity($item['quantity'])['text'] }}--}}
                                                        {{--                        </span>--}}
                                                        {{--                    @else--}}
                                                        <span class="{{ $item['quantity'] == 0 ? 'text-danger' : 'label' }}">
                            <link itemprop="availability" href="https://schema.org/InStock">
                            {{ $item['quantity'] == 0 ? 'Нет в наличии' :  $item['quantity'] }}
                        </span>
                                                        {{--                    @endif--}}
                                                    </p>
                                                </div>

                                                <!-- Сроки Доставки -->
                                                <div class="col-12 col-md-2">
                                                    <!--    <strong>Сроки Доставки:</strong> -->
                                                    <p class="mb-0">
                    <span class="badge rounded-pill text-bg-danger px-3"
                          data-bs-toggle="tooltip"
                          data-bs-title="Доставка заказа осуществляется в течении 2 рабочих дней">
                        Срок 2 дня
                    </span>
                                                    </p>
                                                </div>

                                                <!-- Цена -->
                                                <div class="col-12 col-md-1">
                                                    <!--     <strong>Цена:</strong> -->
                                                    <p class="mb-0">{!! $currency::summa($item['salePrices'][0]['value']) !!}</p>
                                                </div>

                                                <!-- Кнопка добавления в корзину -->
                                                <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                                    <div>
                                                        @if($item['quantity'] == 0)
                                                            <div onclick="isNotSignUp()"
                                                                 class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                                <x-icon-add-card size="25px" color="#fff"/>
                                                            </div>
                                                        @else
                                                            <div id="card{{$item['id']}}"
                                                                 data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},moysklad,1,{{$item['salePrices'][0]['value']}},{{$item['salePrices'][0]['value']}},{{$images::src($item['id'])}}"
                                                                 v-on:click="addToCard('{{$item['id']}}')"
                                                                 class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                                <x-icon-add-card size="25px" color="#fff"/>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        @if (!empty($analog['db']) && count($analog['db']) > 0)
                            @foreach($analog['db'] as $item)
                                @if(isset($item['article']))
                                    <div class="container">
                                        <div class="row border-bottom py-3 d-flex align-items-center">
                                            <!-- Изображение -->
                                            <div class="col-12 col-md-1">
                                                @include('layout.main.ui.card.card-image-dashboard')
                                            </div>

                                            <!-- Бренд/Артикул -->
                                            <div class="col-12 col-md-2">
                                                <!--   <strong>Бренд/Артикул:</strong> -->
                                                <p class="mb-0">
                                                    <a itemprop="name"
                                                       href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"
                                                       class="text-decoration-none">
                                                        Mercedes-Benz
                                                    </a>
                                                    {{$item['article']}}
                                                </p>
                                            </div>

                                            <!-- Наименование -->
                                            <div class="col-12 col-md-2">
                                                <!--  <strong>Наименование:</strong> -->
                                                <a itemprop="name"
                                                   href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}}"
                                                   class="text-decoration-none">
                                                    <p class="mb-0">{{ mb_convert_case($item['name'], MB_CASE_TITLE, "UTF-8") }}</p>
                                                </a>
                                            </div>

                                            <!-- Наличие -->
                                            <div class="col-12 col-md-2">
                                                <!--    <strong>Наличие:</strong> -->
                                                <p class="mb-0">
                    <span itemprop="offers" itemscope itemtype="https://schema.org/Offer"
                          class="{{$item['quantity'] == 0 ? 'label-danger' : 'label'}}">
                        <link itemprop="availability" href="https://schema.org/InStock">
                        {{$item['quantity'] == 0 ? 'Нет в наличии' : ($item['link'] == 'product' ? $item['quantity'] : 'Склад Турция')}}
                    </span>
                                                </p>
                                            </div>

                                            <div class="col-12 col-md-2">
                                                <!--     <strong>Сроки Доставки:</strong> -->
                                                <p class="mb-0">
                                                    @include(($item['stock_category_id'] == 'colyman' ? 'colyman' : 'product') . '.card.remdays')
                                                </p>
                                            </div>
                                            {{--            <div class="col-12 col-md-2">--}}
                                            {{--                <!--    <strong>Сроки Доставки:</strong> -->--}}
                                            {{--                <p class="mb-0">--}}
                                            {{--                    <span class="badge rounded-pill text-bg-danger px-3"--}}
                                            {{--                          data-bs-toggle="tooltip"--}}
                                            {{--                          data-bs-title="Доставка заказа осуществляется в течении 2 рабочих дней">--}}
                                            {{--                        Срок {{$item['stock_category_id'] == 'colyman' ? '1-2 месяца' : '5 дней'}}--}}
                                            {{--                    </span>--}}
                                            {{--                </p>--}}
                                            {{--            </div>--}}

                                            <!-- Цена -->
                                            <div class="col-12 col-md-1">
                                                <!--        <strong>Цена:</strong> -->
                                                <p class="mb-0">{!!$currency::summa($item['price'] * 100)!!}</p>
                                            </div>

                                            <!-- Кнопка добавления в корзину -->
                                            <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                                                <div>
                                                    @if($item['quantity'] == 0)
                                                        <div onclick="isNotSignUp()"
                                                             class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                            <x-icon-add-card size="25px" color="#fff"/>
                                                        </div>
                                                    @else
                                                        <div id="card{{$item['id']}}"
                                                             data-card="{{$item['id']}},{{$item['article']}},{{$item['name']}},{{$item['stock_category_id'] ?? 'colyman'}},1,{{$item['price']* 100}},{{$item['price']* 100}},{{$images::src($item['article'])}}"
                                                             v-on:click="addToCard('{{$item['id']}}')"
                                                             class="btn btn-primary text d-flex align-items-center justify-content-center gap-2 py-2">
                                                            <x-icon-add-card size="25px" color="#fff"/>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        @endif
                    </div>
                @endif

            @endif

        </div>
@endsection
{{--        @php--}}
{{--            $size = isset($error) || $search === null ? 0 : $search['meta']['size'];--}}
{{--        --}}
{{--            $stock = isset($product['rows'][0]['productFolder']) ? $product['rows'][0]['productFolder'] : null;--}}
{{--            --}}
{{--            $stockSize = (session('stockPositions') ? count(session('stockPositions')) : 0);--}}
{{--            $stockSize += (session('stockPositionsNonOriginal') ? count(session('stockPositionsNonOriginal')) : 0);--}}
{{--            $stockSize += (session('dongFeng') ? count(session('dongFeng')) : 0);--}}
{{--            $stockSize += (session('colyman') ? count(session('colyman')) : 0);--}}

{{--        @endphp--}}
{{--        @extends('layout/main')--}}
{{--        @section('title', 'Результат поиска: "'.$text.'"')--}}

{{--        @section('content')--}}
{{--            <hr/>--}}
{{--            @if (isset($error) && $size !== 0)--}}
{{--                <x-alert type="danger" message="{{$error}}"/>--}}
{{--            @endif--}}
{{--            @if($size === 0 && empty($analog))--}}
{{--                @include('layout.main.ui.empty.no-result', [--}}
{{--                    'text' => $text,--}}
{{--                    'link' => '/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0',--}}
{{--                    'dashboard' => true--}}
{{--                ])--}}
{{--            @else--}}
{{--                <p class="text-muted">{{$decl::search($size)}}--}}
{{--                    <span class="badge bg-soft-danger text-danger rounded-pill">{{$size}}</span></p>--}}
{{--                <div class="row g-2">--}}
{{--                    @foreach($search['rows'] as $item)--}}
{{--                        <div class="col-lg-3 col-12">--}}
{{--                            <div class="card card-data border-0 shadow">--}}
{{--                                @include('layout.main.ui.card.card-admin-image')--}}
{{--                                <div class="card-body">--}}
{{--                                    <h5 class="card-title fs-5 mb-3">--}}
{{--                                        <a--}}
{{--                                                href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"--}}
{{--                                                title="{{$item['name']}}"--}}
{{--                                                class="text-dark fw-bold text-decoration-none w-100 text-truncate d-inline-block"--}}
{{--                                        >--}}
{{--                                            {{$item['name']}}--}}
{{--                                        </a>--}}
{{--                                    </h5>--}}
{{--                                    @include('layout.main.ui.quantity.quantity-admin')--}}
{{--                                    <div class="d-flex align-items-center justify-content-between">--}}
{{--                                        @include('layout.main.ui.card.card-admin-article')--}}
{{--                                        @include('layout.main.ui.button.card-admin-button')--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                @if (!empty($analog))--}}
{{--                    @if(!empty($analog['notFound']))--}}
{{--                        @php--}}
{{--                            $notfound = implode(", ", $analog['notFound']);--}}
{{--                        @endphp--}}
{{--                        <x-alert type="info" header=" "--}}
{{--                                 message="По запросу <strong>{{$text}}</strong> также есть аналоги - <strong>{{$notfound}}</strong>,<br>Для их заказа свяжитесь с менеджером"/>--}}
{{--                    @endif--}}
{{--                    <x-alert type="warning" header=" "--}}
{{--                             message="По запросу <strong>{{$text}}</strong> есть аналоги:"/>--}}
{{--                    <div class="row g-2">--}}
{{--                        @if (!empty($analog['rows']) && count($analog['rows']) > 0)--}}
{{--                            @foreach($analog['rows'] as $item)--}}
{{--                                <div class="col-lg-3 col-12">--}}
{{--                                    <div class="card card-data border-0 shadow">--}}
{{--                                        @include('layout.main.ui.card.card-admin-image')--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h5 class="card-title fs-5 mb-3">--}}
{{--                                                <a--}}
{{--                                                        href="/dashboard/product/details/{{$item['id']}}"--}}
{{--                                                        title="{{$item['name']}}"--}}
{{--                                                        class="text-dark fw-bold text-decoration-none w-100 text-truncate d-inline-block"--}}
{{--                                                >--}}
{{--                                                    {{$item['name']}}--}}
{{--                                                </a>--}}
{{--                                            </h5>--}}
{{--                                            @include('layout.main.ui.quantity.quantity-admin')--}}
{{--                                            <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                @include('layout.main.ui.card.card-admin-article')--}}
{{--                                                @include('layout.main.ui.button.card-admin-button')--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                        @if (!empty($analog['db']) && count($analog['db']) > 0)--}}
{{--                            @foreach($analog['db'] as $item)--}}
{{--                                <div class="col-lg-3 col-12">--}}
{{--                                    <div class="card card-data border-0 shadow">--}}
{{--                                        @include('layout.main.ui.card.card-admin-image')--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h5 class="card-title fs-5 mb-3">--}}
{{--                                                <a--}}
{{--                                                        href="/dashboard/{{isset($item['link']) && $item['link'] === 'turkishProduct' ? 'turkishProduct' : 'product'}}/details/{{$item['id']}}"--}}
{{--                                                        title="{{$item['name']}}"--}}
{{--                                                        class="text-dark fw-bold text-decoration-none w-100 text-truncate d-inline-block"--}}
{{--                                                >--}}
{{--                                                    {{$item['name']}}--}}
{{--                                                </a>--}}
{{--                                            </h5>--}}
{{--                                            @include('layout.main.ui.quantity.quantity-admin')--}}
{{--                                            <div class="d-flex align-items-center justify-content-between">--}}
{{--                                                @include('layout.main.ui.card.card-admin-article')--}}
{{--                                                @include('layout.main.ui.button.card-admin-button')--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--    @endif--}}
{{--    @endif--}}
{{--@endsection--}}