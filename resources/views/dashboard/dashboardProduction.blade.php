@extends('layout/main')
@section('title', 'Товары')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">Продукция</span>
    </div>
@endsection

@section('content')
<div class="w-100" style="background-image: url(/img/Skladd.jpeg); background-position: center -180px; background-attachment: fixed; background-size: cover; height: 250px; text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">Фотографии с производства</h2>
    </div>
</div>

<section class="bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 text">
                <!-- Ваш текущий контент -->

                <h2 class="fw-bold text-center mb-4">Медиа {{ config('app.name') }} <img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
                <hr class="bar" />
                
                <p class="text-justify textt">
                    <strong>Фотографии нашей продукции</strong></br>— Мы крупнейший дистрибьютор автомобильных запасных частей, 
                    компонентов и расходных материалов на рынке Восточной Европы.
                </p>
            </div>
        </div>
    
        <!-- Добавление блока галереи -->
        <div class="row justify-content-center mt-5">
            <div class="gallery44">
                <!-- Здесь добавьте изображения ваших фотографий с соответствующими путями -->
                <img src="/img/ss.jpg" alt="Photo 1" onclick="openModal(this)"/>
                <img src="/img/vcv.jpg" alt="Photo 2"onclick="openModal(this)" />
                <img src="/img/vv.jpg" alt="Photo 1" onclick="openModal(this)" />
                
                <img src="/img/sww.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/dsd.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/zz.jpg" alt="Photo 1" onclick="openModal(this)" />
                
                <img src="/img/DSC05158.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05216.jpg" alt="Photo 1" onclick="openModal(this)" />
    
                <img src="/img/DSC05206.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05214.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05221.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05232.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05236.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05241.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05244.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05252.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05255.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05265.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05276.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05281.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05282.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05288.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05175.jpg" alt="Photo 1" onclick="openModal(this)" />
                <img src="/img/DSC05154.jpg" alt="Photo 1" onclick="openModal(this)" />
                

            </div>
        </div>
    </div>
</section>

<div id="myModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
</div>

@endsection