@php
    $stock = count($product['rows']) !== 0 ?  $stockId : '';
    $title = $stock === '' ? 'Пусто' : $stock;
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
                            <option value="/MercedesBenzNew/{{$key}}/0" @if($key == $limit) selected @endif >
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
                                    @include('newproduct.card.image')
                                </div>
                            <div class="text-start">
                                    @include('newproduct.card.title')
                                </div>
                            </div>
                            <div class="w-25">
                                    @include('newproduct.card.quantity')
                            </div>
                            <div class="px-4">
                                    @include('newproduct.card.car-logo')
                            </div>
                        <div>
                        </button> 
                        </div>
                            <div>
                                    @include('newproduct.card.button')
                            </div>
                        </div>
                    </div>                        
                </template>
                <template v-else>
                    <div class="col-lg-3 col-12">
                        
                        <div class="card card-data border-0 shadow-sm order">
                            @include('newproduct.card.image')
                             @include('newproduct.card.remdays')
                        <div class="card-body">
                            <div style="height: 40px">
                            @include('newproduct.card.title')
                            </div>
                            <hr style="color: #ddd">
                            @include('newproduct.card.quantity')
                            <hr style="color: #ddd">
                            <div class="d-flex align-items-center justify-content-between">
                                @include('newproduct.card.car-logo')
                                <div>
                                @include('newproduct.card.button')
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </template>
            @endforeach
            
            @if ($offset < $product['meta']['size'])
            <div class="mt-5 d-flex align-items-center justify-content-between">
                <div>
                    <select id="selectOffsetBottom" class="form-select" onchange="selectOffsetBottom()">
                        @foreach ([12, 24, 48, 64, 100] as $key)
                            <option value="/stockMercedesBenz/{{$key}}/0"
                            
                            @if($key == $limit) selected @endif >
                                {{$key}}
                            </option>
                        @endforeach
                        
                    </select>                        
                </div>
                <nav>
                    <ul class="pagination m-0">
                        @if ($offset != 0)
                            <li class="page-item p-0">
                                <a class="page-link text-primary border-0"
                                   href="/MercedesBenzNew/{{$limit}}/{{$offset - $limit}}">
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

                        @if (($offset + $limit) < $product['meta']['size'])
                            <li class="page-item p-0">
                                <a class="page-link text-primary border-0"
                                   href="/MercedesBenzNew/{{$limit}}/{{$offset + $limit}}">
                                    Далее <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        @else
                            <li class="page-item p-0 disabled">
                                <a class="page-link border-0">
                                    <span>&laquo;</span> Далее
                                </a>
                            </li>
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

    
</section>

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