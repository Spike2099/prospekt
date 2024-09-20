@extends('layout/index', [
    'title' => 'Клиентам | Проспект Транс',
    'keywords' => 'сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Полезная информация для клиентов.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Клиентам')

@section('content')
<div class="w-100" style="background-image: url(/img/sklad.jpg);background-position: center -180px;background-attachment: fixed;background-size: cover;height: 250px;text-shadow: 1px 2px 3px #000">
    <div style="height: 100%;display: flex;justify-content: center;align-items: center;background-color: #00000059">
        <h2 class="text-white pt-5 mb-0">Полезная информация для клиентов</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1 text">
                <div class="row d-flex align-items-center">
                    <div class="col-12 col-lg-6">
                        <h2 class="fw-bold mb-4">Удобный сервис для ПК и ноутбуков.</h2>
                        <hr class="bar ms-0">
                        <p>Теперь вам не нужно созваниваться с менеджером и диктовать артикул, 
                        чтобы узнать наличие товара. Весь ассортимент запчастей доступен 
                        для оформления заказов. Вы можете указать то количество, которое 
                        вам нужно. Мы прилагаем все усилия, для того чтобы быстро принимать 
                        и оформлять заказы, доводя весь процесс до автоматизма. 
                        Вам не нужно больше ждать ответа от специалиста. 
                        Весь процесс виден в личном кабинете в режиме реального времени.</p>
                    </div>
                    <div class="col-12 col-lg-6">
                        <img src="/img/laptop.png" class="w-100" alt="laptop" />
                    </div>
                </div>
                <div class="row d-flex align-items-center">
                    <div class="col-12 col-lg-4">
                        <img src="/img/phone-static.png" class="w-100" alt="laptop">
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="ps-0 ps-lg-5 ms-0 ms-lg-5">
                            <h2 class="fw-bold mb-4">Пользуйтесь нашим сервисом прямо с телефона.</h2>
                            <hr class="bar ms-0">
                            <p>Мы учли тот факт, что не всегда есть ПК или ноутбук под рукой, но сотовый телефон есть у многих с собой. Было бы здорово заказать запчасть без лишних движений, особенно когда это нужно срочно и прямо сейчас. С нашим сервисом, оформлять заказы и отслеживать их стало на много проще. </p>
                            <em class="fs-4">Приятного пользования!</em>
                            @guest
                            <div class="d-flex mt-4">
                                <a href="/signup" class="btn btn-primary px-5 py-3 d-flex justify-content-center align-items-center gap-2">
                                    <x-icon-open-in-new size="25px" color="#fff" />
                                    Зарегистрироваться
                                </a>                                
                            </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection