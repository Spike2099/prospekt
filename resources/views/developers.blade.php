@extends('layout/index', [
    'title' => 'Информация для разработчиков | Проспект Транс',
    'keywords' => 'партнёры, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация для разработчиков',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Информация для разработчиков')

@section('content')
<div class="w-100" style="background-image: url(/img/abstract-polygonal.jpg);background-position: 0px -1005px;background-attachment: fixed;background-size: cover;height: 250px;text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: #00000059">
        <h2 class="text-white pt-5 mb-0">Информация для разработчиков</h2>
    </div>
</div>
<section class="bg-secondary-subtle">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold display-5 text-center mb-4">Документация для разработчиков &#128187;</h2>
                <hr class="bar" />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-5 mt-3">
                    <div class="card-body">
                        <a href="#api" onclick="isError()" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <x-icon-frame-source color="#777" size="30px" />
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">REST API v1</h5> 
                                <small class="text-muted">Основной API для интеграций</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-5 mt-3">
                    <div class="card-body">
                        <a href="#faq" onclick="isError()" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <x-icon-terminal color="#777" size="30px" />
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">F.A.Q.</h5> 
                                <small class="text-muted">Часто Задаваемые Вопросы</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card shadow-sm border-0 mb-5 mt-3">
                    <div class="card-body">
                        <a href="#help" onclick="isError()" class="d-flex align-items-center text-decoration-none">
                            <div class="p-2">
                                <x-icon-help color="#777" size="30px" />
                            </div> 
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold text-dark m-0">Помощь</h5> 
                                <small class="text-muted">Написать тикет</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection