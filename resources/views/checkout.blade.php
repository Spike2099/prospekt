@extends('layout/index', [
    'title' => 'Оформление заказа | Проспект Транс',
    'keywords' => 'заказ, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация о заказе.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Оформление заказа')

@section('content')
<div class="w-100 bg-primary" style="height: 170px">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0 mt-1">Оформление заказа</h2>
    </div>
</div>
<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 text">
                {{-- <input type="text" name="name" :value="window.atob(decodeURIComponent(JSON.stringify()))" /> --}}
                <pre><?php var_dump(urlencode($order));?></pre>
                
            </div>
        </div>
    </div>
</section>
@endsection