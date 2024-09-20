@extends('layout/index', [
    'title' => 'Об акции | Проспект Партс',
    'keywords' => 'сервис, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация об акции.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Акция')

@section('content')
<div class="w-100 bg-primary" style="height: 170px">
    <div class="d-flex justify-content-center align-items-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0 mt-1">Акция</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 text">
                <h2 class="fw-bold text-center mb-4">Условия проведения акции: <img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
                <hr class="bar" />
                <p class="text-justify">
                    Для участия в акции требуется сделать заказ на сайте через корзину в <u>личном кабинете</u>.
                    <br />
                    <span class="text-danger">Внимание!</span> Принять участие в акции можно только <u>один</u> раз.
                                        
                </p>
                <p>
                    <b>Порядок получения Подарков:</b>
                    <br />
                    Подарки передаются Участнику <u>вместе</u> с приобретенными товарами.
                </p>
                <p class="text-center py-4">
                    <a href="#more" class="btn fs-4 text btn-primary px-4">
                        Посмотреть комплект
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="more" class="bg-light">
    <div class="container">
        <div class="row g-2">
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img src="/img/promo/box_parcel_icon_192626.png" alt="Запчасти" class="w-100 px-3 pb-2 mb-4" style="cursor: default; filter: saturate(100%); height: auto; opacity: 1" /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: underline 3px rgb(49, 0, 98); cursor: default;">Запчасти</h5> 
                        <p class="text-muted">Толстовка будет внутри</p>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img src="/img/promo/set1.png" alt="Толстовка (Вид спереди)" class="w-100" style="cursor: default; filter: saturate(100%); height: auto; opacity: 1" /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: underline 3px rgb(49, 0, 98); cursor: default;">Толстовка</h5> 
                        <p class="text-muted">Вид спереди</p>
                    </div>
                </div>
            </div> 
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm">
                    <div class="card-body text-center pt-5">
                        <img src="/img/promo/set2.png" alt="Толстовка (Вид сзади)" class="w-100" style="cursor: default; filter: saturate(100%); height: auto; opacity: 1" /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: underline 3px rgb(49, 0, 98); cursor: default;">Толстовка</h5> 
                        <p class="text-muted">Вид сзади</p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="text-center col-12 mt-4">
                <p class="fs-3 text">
                    <sub class="text-danger fs-1">*</sub> Комплект, который вы получите, принимая участие в акции.
                </p>
                @guest
                <div class="d-flex justify-content-center mt-4">
                    <a href="/signup" class="btn btn-primary px-5 py-3 d-flex justify-content-center align-items-center gap-2 fs-4">
                        <x-icon-open-in-new size="25px" />
                        Участвовать в акции
                    </a>                                
                </div>
                @endguest
            </div>
        </div>
    </div>
</section>

@endsection