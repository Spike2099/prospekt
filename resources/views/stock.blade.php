@php
    $stock = count($product['rows']) !== 0 ?  $product['rows'][0]['productFolder'] : '';
    $title = $stock === '' ? 'Пусто' : $stock['name'];
@endphp

@extends('layout/index', [
    'title' => $title.' | Проспект Партс',
    'keywords' => 'ремонт в москве, ремонт машин в мытищи, ремонт двигателя, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Каталог '.$title.', широкий ассортимент комплектующих и расходных материалов для грузовых автомобилей',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', $title.' | Проспект Партс')

@section('content')
<section class="bg-secondary-subtle catalog">
    <div class="container position-relative py-4 py-lg-2">
        <div class="row" itemscope itemtype="https://schema.org/Product">
            <div class="d-flex justify-content-between">
                <h2 class="text fw-bold text-dark">{{$title}}

<!-- <h1 class="text fw-bold text-dark" style ="padding-top: 34px;">В данный момент позиции нет , но вы можете предзаказать товар. Обратитесь к менеджеру по поводу информации.</h1> -->
                
                </h2>
                <div class="d-print-none">
                    <div id="loadingpage" class="text"></div>
                </div>
            </div>
            <div class="col-12"><hr /></div>
            <div class="col-12 d-flex align-items-center justify-content-between py-3">
                <p class="text text-muted m-0">
                    
                    Всего {{$product['meta']['size']}} {{$decl::cart($product['meta']['size'])}}
                </p>
                <div>
                    <select id="selectOffset" class="form-select" onchange="selectOffset()">
                        @foreach ([12, 24, 48, 64, 100] as $key)
                            <option value="/stock/{{$id}}/{{$key}}/0" @if($key == $limit) selected @endif >
                                {{$key}}
                            </option>
                        @endforeach
                    </select>                        
                </div>
                <div class="btn-group">
                    <button class="btn border-0" :class="[design === 'grid' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isGrid()">
                        <x-icon-grid size="27px" />
                    </button>
                    <button class="btn border-0" :class="[design === 'line' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isLine()">
                        <x-icon-line size="27px" />
                    </button>
                </div>
            </div>
        </div>
        <div class="row g-2 grid-design"> 
            @include('layout.main.ui.card.card-empty')
        </div>
        <div class="row g-2" itemscope itemtype="https://schema.org/Product">
            @foreach ($product["rows"] as $item)
                <template v-if="design === 'line'">
                    <div class="col-12 line">
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
                                <div>
                                @include('layout.main.ui.button.card-button')
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
                            <option value="/stock/{{$id}}/{{$key}}/0" @if($key == $limit) selected @endif >
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
                                <a class="page-link text-primary border-0" href="/stock/{{$id}}/{{$previous['limit']}}/{{$previous['offset']}}">
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
                                <a class="page-link text-primary border-0" href="/stock/{{$id}}/{{$next['limit']}}/{{$next['offset']}}">
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
    </div>

</script>
    
</section>
@endsection