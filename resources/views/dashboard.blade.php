@php
    $options = [
        [
            'name' => 'По артикулу',
            'value' => 'article'
        ],
        [
            'name' => 'По наименованию',
            'value' => 'name'
        ]
    ];
    $size = session('search') ? session('search')['meta']['size'] : '';
    
@endphp
@extends('layout/main')

{{-- @section('title', $deal::status() === '1' ? 'Поиск запчастей' : 'Статус договора') --}}

@section('content')

    @if($deal::status() === '0')
        <x-alert type="info" message="Договор составлен. Нужно прислать подписанный договор с печатю. Два экземпляра" />   
        <strong class="d-grid mb-3">Варианты отправки документов:</strong>
        
        <ul class="d-grid gap-3">
            <li>Скан документов с подписью и печатью в PDF - <i>{!!$contact::getEmail('manager@prospekt-parts.com', ['text-dark'])!!}</i></li>
            <li>
                На бумаге, формата А4, почтой - <i>{{ config('app.address') }}</i> <br />
                <strong>Кому:</strong> ООО {{ config('app.name') }}
            </li>
        </ul>  
    @elseif($deal::status() === 'z')
        <x-alert type="danger" message="Договор не заключён" />    
    @elseif($deal::status() === '2')
        <x-alert type="danger" message="Договор расторгнут. Вы не можете пользоваться данной платформой" />    
    @elseif($deal::status() === '1')
        <form action="/dashboard/search" method="post" class="card shadow-sm border-0">
            @csrf
            <div id="type" class="card-body d-flex align-items-center gap-2">
<!--@foreach($options as $item)
<label class="border rounded d-lg-block d-none">
    <input type="radio" name="type" class="d-none" value="{{$item['value']}}" @if ($item['value'] === old('type')) checked @endif />
    <span>{{$item['name']}}</span>
</label>
@endforeach-->
                <label class="border rounded" data-bs-toggle="modal" data-bs-target="#vinModal">
                    <input type="radio" name="type" class="d-none" value="vin" />
                    <span>Запрос по VIN</span>
                </label>
                
                <a href="/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175/10/0" class="border rounded d-lg-block d-none" style="color:black; text-decoration: none;">
                    <input type="radio" name="type" class="d-none" value="stock" />
                    <span>Mercedes-Benz Склад</span>
                </a>
                
                
              <a href="/dashboard/dashboardErrorcode" class="border rounded d-lg-block d-none" style="color:black; text-decoration: none;">
                    <input type="radio" name="type" class="d-none" value="stock" />
                    <span>Коды Ошибок Mercedes-Benz/Actros</span>
                </a>
                
            </div>
<!-- <div id="filter" class="card-body pt-0 d-flex gap-2">
    <input 
        type="text" 
        name="text" 
        list="searchlist"
        class="form-control" 
        value="{{session('text') ? session('text') : old('text') }}" 
        v-on:change="onChange(search)"
        v-model="search"
        placeholder="Поиск..." 
    />
    {{-- @include('layout.main.ui.selest.list') --}}
    <x-button color="danger" icon="search" type="submit" text="Найти" />
</div>  -->
        </form>
    @endif



    @error('text')
        <p>Получен пустой запрос.</p>
    @enderror    
    @if(session('search'))
        @if($size === 0)
            <p>По запросу <strong>"{{session('text')}}"</strong> ничего не найдено</p>
        @else
        <p>{{$decl::search($size)}} 
            @if ($size !== 1)
                &#160;<span class="badge bg-danger rounded-pill">{{$size}}</span>
            @endif
        </p>        
        @endif
        <div class="row g-2" style = "width: 75%;">
            @foreach(session('search')['rows'] as $item)
            <div class="col-12" :class="[!isOpen ? 'col-lg-3' : 'col-lg-4']">
                <div class="card card-data border-0 shadow">
                    @include('layout.main.ui.card.card-admin-image')
                    <div class="card-body">
                        <h5 class="card-title fs-5 mb-3" style="height: 48px">
                            <a href="/dashboard/product/details/{{$item['id']}}" class="text-dark fw-bold text-decoration-none">
                                <?php
                                    $str = str_replace(
                                        mb_strtolower(session('text')), 
                                        '<mark class="rounded py-0">'.mb_strtolower(session('text')).'</mark>', 
                                        mb_strtolower($item['name'])
                                    );
                                    $str = mb_strtoupper(mb_substr($str, 0, 1)) . mb_substr($str, 1, mb_strlen($str));
                                    echo $str;
                                ?>
                            </a>
                        </h5>
                        @include('layout.main.ui.quantity.quantity-admin')
                        <div class="d-flex align-items-center justify-content-between">
                            @include('layout.main.ui.card.card-admin-article')
                            @include('layout.main.ui.button.card-admin-button')
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    @if(session('search'))
        @else
        
        
        <!-- slider -->
<!--     <div class="row mb-4">
    
    <div class="col-12 col-lg-4">
        <a href="/dashboard/promo/Gearax">
            <img src="/img/goods/promo/powerhub.jpg" alt="Gearax" class="w-100 rounded shadow-sm" />
        </a>
    </div>
    <div class="col-12 col-lg-4">
        <a href="/dashboard/promo/GMS">
            <img src="/img/goods/promo/gms.jpg" alt="GMS" class="w-100 rounded shadow-sm" />
        </a>
    </div>
</div>  -->

<!--<div class="slider">
    <div class="row">
        <div class="ErrorPage col-12 pb-5">
            <a href="/dashboard/dashboardErrorcode" class="text-decoration-none" style="color:white">
                <div class="CustomBanner1 p-5 bg-dark text-white rounded">
                    <h2 class="display-3 mb-4 fw-bold">
                        <span class="text-danger">Коды Ошибок!</span> Список кодов<br>Неисправностей MERCEDES BENZ ACTROS
                    </h2>
                    <div class="d-grid d-lg-flex gap-3">
                        <a class="btn btn-lg btn-outline-light px-4" href="/dashboard/dashboardErrorcode">
                            Подробнее
                        </a>
                    </div>
                    
                </div>
            </a>
            
        </div>
    </div>
    <div class="row">
        <div class="ErrorPage col-12 pb-5">
            <a href="/dealer" class="text-decoration-none" style="color:white">
                <div class="CustomBanner2 p-5 bg-dark text-white rounded">
                    <h2 class="display-3 mb-4 fw-bold">
                        Размещайте на нашем сайте<br>ваши запчасти и зарабатывайте!
                    </h2>
                    <div class="d-grid d-lg-flex gap-3">
                        <a class="btn btn-lg btn-outline-light px-4" href="/dealer">
                            Подробнее
                        </a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="slider-nav">
        <button class="prev">Назад</button>
        <button class="next">Вперед</button>
    </div>
</div>-->

<!-- <div class="slider">
    
<div class="row">
    <div class="ErrorPage col-12 pb-5">
      <a href="/dashboard/dashboardErrorcode" class="text-decoration-none " style="color:white">
        <div class="p-5 bg-dark text-white rounded" 
        style="background-image: url(/img/banner.jpg);background-size: cover;background-position: center bottom;box-shadow: inset 0px -48px 254px 86px #000000bf">
            <h2 class="display-3 mb-4 fw-bold"><span class="text-danger">Коды Ошибок!</span>Список кодов<br>Неисправностей MERCEDES BENZ ACTROS</h2>
            <div class="d-grid d-lg-flex gap-3">
                <a href="/signup" class="btn btn-lg btn-primary px-5 d-flex justify-content-center align-items-center gap-2">
                    <x-icon-add color="#fff" />
                    Участвовать
                </a>
                <a class="btn btn-lg btn-outline-light px-4" href="/dashboard/dashboardErrorcode">
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
            <h2 class="display-3 mb-4 fw-bold"><span class="text-danger">Коды Ошибок!</span>Размещайте на нашем сайте<br>ваши запчасти и зарабатывайте !</h2>
            <div class="d-grid d-lg-flex gap-3">
                <a class="btn btn-lg btn-outline-light px-4" href="/dealer">
                    Подробнее
                </a>
            </div>
        </div>
        </a>
    </div>
</div>
        <div class="slider-nav">
            <button class="prev">Назад</button>
            <button class="next">Вперед</button>
        </div>
</div> -->

        <div class="slider">
    <div class="row">
        <div class="ErrorPage col-12 pb-5">
            <a href="/dashboard/dashboardErrorcode" class="text-decoration-none" style="color:white">
                <div class="CustomBanner p-5 bg-dark text-white rounded CustomBanner1">
                    <h2 class="display-3 mb-4 fw-bold">
                        <span class="text-danger">Коды Ошибок!</span> Список кодов<br>Неисправностей MERCEDES BENZ ACTROS
                    </h2>
                    <div class="button-container">
                        <a class="btn btn-lg btn-outline-light px-4" href="/dashboard/dashboardErrorcode">Подробнее</a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="ErrorPage col-12 pb-5">
            <a href="/dealer" class="text-decoration-none" style="color:white">
                <div class="CustomBanner p-5 bg-dark text-white rounded CustomBanner2">
                    <h2 class="display-3 mb-4 fw-bold">Размещайте на нашем сайте<br>ваши запчасти и зарабатывайте!</h2>
                    <div class="button-container">
                        <a class="btn btn-lg btn-outline-light px-4" href="/dealer">Подробнее</a>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="slider-nav">
        <button class="prev">Назад</button>
        <button class="next">Вперед</button>
    </div>
</div>



<div class="ProductGrid mb-5 row g-2">
    <div class="col-md-3 col-12" data-description="POWERHUB Тормозные диски/колодки">
        <a href="/dashboard/catalog/category/81cf7449-727a-11ee-0a80-130600173515/10/0">
            <img src="/img/goods/promo/powerhub.png" alt="Powerhub" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="GMS Водяные насосы">
        <a href="/dashboard/catalog/category/a2a12edf-1642-11ee-0a80-13ab00041ab9/10/0"> 
            <img src="/img/goods/promo/gms.png" alt="GMS" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="POWERHUB Фильтры">
        <a href="/dashboard/catalog/category/d295833c-8399-11ee-0a80-0fb9000b7477/10/0">
            <img src="/img/goods/promo/powerhubF.png" alt="POWERHUB-FILTER" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="SUOTEPOWER Турбины">
        <a href="/dashboard/catalog/category/c07653f3-5d3d-11ee-0a80-0418001257ed/10/0">
            <img src="/img/goods/promo/suotepower.png" alt="SUOTE" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="MVS Маховики">
        <a href="/dashboard/catalog/category/ef56740b-77e0-11ee-0a80-0cfa001004ff/10/0">
            <img src="/img/goods/promo/mvs.png" alt="MVS" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="SUNEX запчасти скоро будут в Наличии!">
        <a href="/dashboard/catalog/category/6f6ad146-794c-11ee-0a80-0290001d2dad/10/0">
            <img src="/img/goods/promo/sunex.png" alt="SUNEX" class="w-100 h-100  rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="DONGFA Коленвалы">
        <a href="/dashboard/catalog/category/e0cb6ca7-7a53-11ee-0a80-02dc001281c2/10/0">
            <img src="/img/goods/promo/dongfa.png" alt="DONGFA" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
    <div class="col-md-3 col-12" data-description="PROXMANN Гильзы">
        <a href="/dashboard/catalog/category/3880dce6-9da5-11ee-0a80-084c0025ddf8/10/0">
            <img src="/img/goods/promo/proxman.png" alt="PROXMANN" class="w-100 h-100 rounded shadow-sm object-cover-fit">
        </a>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        var currentSlide = 0;
        var slides = $('.slider').find('.row');
        var totalSlides = slides.length;
        var autoSlideInterval = 5000; // Интервал автоматического переключения в миллисекундах
        var autoSlideTimer;

        function showSlide(index){
            slides.hide();
            slides.eq(index).fadeIn('slow');
        }

        function nextSlide(){
            currentSlide = (currentSlide + 1) % totalSlides;
            showSlide(currentSlide);
        }

        function prevSlide(){
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(currentSlide);
        }

        function startAutoSlide(){
            autoSlideTimer = setInterval(nextSlide, autoSlideInterval);
        }

        function stopAutoSlide(){
            clearInterval(autoSlideTimer);
        }

        $('.next').click(function(){
            nextSlide();
            stopAutoSlide();
        });

        $('.prev').click(function(){
            prevSlide();
            stopAutoSlide();
        });

        // Плавное переключение между слайдами и автоматическое переключение
        showSlide(currentSlide);
        startAutoSlide();
    });
</script>


<!-- <div class="ProductGrid mb-5 row g-2">
    
                <div class="col-md-3 col-12">
                    <a href="/dashboard/catalog/category/81cf7449-727a-11ee-0a80-130600173515/10/0">
                        <img src="/img/goods/promo/powerhub.png" alt="Powerhub" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>
                
                <div class="col-md-3 col-12">
                    <a href="/dashboard/catalog/category/a2a12edf-1642-11ee-0a80-13ab00041ab9/10/0"> 
                        <img src="/img/goods/promo/gms.png" alt="GMS" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>

            <div class="col-md-3 col-12">
                <a href="/dashboard/catalog/category/d295833c-8399-11ee-0a80-0fb9000b7477/10/0">
                       <img src="/img/goods/promo/powerhubF.png" alt="POWERHUB-FILTER" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>

                <div class="col-md-3 col-12">
                    <a href="/dashboard/catalog/category/c07653f3-5d3d-11ee-0a80-0418001257ed/10/0">
                        <img src="/img/goods/promo/suotepower.png" alt="SUOTE" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>
                
            <div class="col-md-3 col-12">
                    <a href="/dashboard/catalog/category/ef56740b-77e0-11ee-0a80-0cfa001004ff/10/0">
                        <img src="/img/goods/promo/mvs.png" alt="MVS" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>
                
            <div class="col-md-3 col-12">
                <a href="/dashboard/catalog/category/6f6ad146-794c-11ee-0a80-0290001d2dad/10/0">
                       <img src="/img/goods/promo/sunex.png" alt="SUNEX" class="w-200 h-200  rounded shadow-sm object-cover-fit">
                    </a>
                </div>
                
            <div class="col-md-3 col-12">
                <a href="/dashboard/catalog/category/e0cb6ca7-7a53-11ee-0a80-02dc001281c2/10/0">
                       <img src="/img/goods/promo/dongfa.png" alt="DONGFA" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div>
                
           <div class="col-md-3 col-12">
                <a href="/dashboard/catalog/category/3880dce6-9da5-11ee-0a80-084c0025ddf8/10/0">
                       <img src="/img/goods/promo/proxman.png" alt="PROXMANN" class="w-200 h-200 rounded shadow-sm object-cover-fit">
                    </a>
                </div> 
            </div> -->
            
            
    @endif

    @role('admin')
        <hr />
        <strong>Admin-Панель</strong> 
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/accounts" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">inventory</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Счета</h5> 
                                <small class="text-muted">Список всех счетов</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/orders" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">order_approve</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Заказы</h5> 
                                <small class="text-muted">Список всех заказов</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>            
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-lg-5 mb-0 mt-3">
                    <div class="card-body">
                        <a href="/dashboard/users" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <span class="material-symbols-outlined text-secondary fs-1">group</span>
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Пользователи</h5> 
                                <small class="text-muted">Список всех пользователей</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endrole

    
    <!-- @role('customer')
        <p>Project Manager Panel</p> 
    @endrole
    @role('admin')
        <strong>Admin Panel</strong> 
    @endrole -->


    <div class="modal fade" id="vinModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content border-0" novalidate @submit.prevent="Save" v-if="!send">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Заказ по VIN номеру</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <div class="mt-2">
                        <input 
                            type="text" 
                            class="form-control" 
                            :class="[error.vin && vin === '' ? 'is-invalid' : '']"
                            v-model="vin" 
                            placeholder="Укажите VIN номер" 
                        />
                        <div class="invalid-feedback d-block m-0" v-if="error.vin && vin === ''">
                            Пожалуйста, укажите VIN номер модели
                        </div>
                    </div>
                    <div class="mt-2">
                        <textarea 
                            rows="5" 
                            class="form-control" 
                            :class="[error.spares && spares === '' ? 'is-invalid' : '']"
                            v-model="spares" 
                            placeholder="Укажите список запчастей"
                        >
                        </textarea>
                        <div class="invalid-feedback d-block m-0" v-if="error.spares && spares === ''">
                            Пожалуйста, напишите через запятую, какие запчасти вам нужны
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="btn btn-outline-light text-dark" data-bs-dismiss="modal">Отмена</div>
                    <button type="submit" class="btn btn-dark px-4 d-flex align-items-center gap-2 justify-content-center" v-if="loading">
                        <span class="material-symbols-outlined spin">autorenew</span>
                        Отправляю...
                    </button>
                    <x-button color="dark" icon="forward" type="submit" text="Отправить менеджеру" v-on:click="Send" v-else />
                </div>
            </form>
            <div class="modal-content border-0" v-else>
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5">Заказ по VIN номеру</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-0">
                    <x-alert type="success" message="Ваша заявка принята." close="false" />
                </div>
            </div>
        </div>
    </div>

@if($deal::status() === 'z')
    <div data-bs-backdrop="static" data-bs-keyboard="false" class="modal fade show" aria-modal="true" role="dialog" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 fw-bold">Здравствуйте</h1>
                </div>
                <div class="modal-body py-0">
                    <p>
                        В настоящий момент, вы не можете пользоваться нашей платформой,
                        так как у вас не заключён договор. Чтобы начать пользоваться, нажмите кнопку:
                    </p>
                </div>
                <div class="modal-footer border-0">
                    <x-button type="a" href="/dashboard/document/agreement" color="dark" icon="quick_reference" text="Заключить договор" />
                </div>
            </div>
        </div>
    </div>
    <div class="modal-backdrop fade show"></div>
@endif
@endsection


