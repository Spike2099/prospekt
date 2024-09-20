@extends('layout/index', [
    'title' => 'О Компании | Проспект Партс',
    'keywords' => 'сервис, service, компания, автосервис, мерседес бенц, актрос',
    'description' => 'Информация о компании.',
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'О Компании')

@section('content')
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> -->

<div class="w-100" style="background-image: url(/img/sklad.jpg);background-position: center -180px;background-attachment: fixed;background-size: cover;height: 250px;text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">О Компании</h2>
    </div>
</div>
<section class="bg-white">
   <!--  <div class="container">
       <div class="row">
           <div class="col-12 col-lg-8 offset-lg-2 text">
               <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                   <img src="/img/guayaquillib/renault.png" alt="Renault" style="width: 40px" />
                   <img src="/public/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 40px" />
                   <img src="/img/guayaquillib/volvo.png" alt="Volvo" style="width: 40px" />
               </div>
               <h2 class="fw-bold text-center mb-4">ООО {{ config('app.name') }} <img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
               <hr class="bar" />
               <p class="text-justify">
                   <strong>Prospekt Parts</strong> — крупнейший дистрибьютор оригинальных автомобильных запасных частей, 
                   компонентов и расходных материалов на рынке Восточной Европы. Также присутствует большое количество <strong>Аналогов.</strong> 
                   Компания ведет отсчет своей истории с 2019 года и на сегодняшний день располагает 
                   развитой филиальной сетью в Российской Федерации и Турции.                    
               </p>
               <p class="text-justify">
                   В ассортименте компании представлены запасные части для наиболее распространенных грузовых автомобилей, 
                   созданных в соответствии со стандартами Евро 4 и Евро 5.
               </p>
               <p class="text-justify">
                   Интернет-магазин «Prospekt Parts» предлагает широкий выбор запасных частей для грузовых автомобилей 
                   европейских марок. Товарное предложение включает более <strong>200 000 тысяч</strong> артикулов запасных частей для 
                   европейских автомобилей — <em>Volvo</em>, <em>Renault</em>, <em>DAF</em>, <em>Mercedes-Benz</em>, <em>MAN</em>.
               </p>
               <p class="text-justify">
                   Гарантируем, <strong>поиск запчастей</strong> и/или расходных материалов, будет для вас <u>лёгким и быстрым</u>.  
                   Чтобы получить нужную позицию, введите номер артикула или наименование детали и наша поисковая система
                   найдёт все запрашиваемые варианты. Мы оказываем онлайн консультацию по подбору имеющихся в наличии
                   запасных частей для грузовых автомобилей. Для позиций, которых нет в наличии, мы оформляем предзаказ,
                   на случай, когда вы можете подождать получение товара.
               </p>
               <p><strong>P.S.</strong> Все запчасти с быстрой доставкой находятся в Московской области, г. Мытищи.
               </p>
           </div>
       </div>
   </div> -->
   <div class="container-block">
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2 text">
            <div class="d-flex align-items-center justify-content-center gap-4 mb-5">
                <img src="/img/guayaquillib/renault.png" alt="Renault" style="width: 40px" />
                <img src="/public/img/mercedes-benz.png" alt="Mercedes-Benz" style="width: 40px" />
                <img src="/img/guayaquillib/volvo.png" alt="Volvo" style="width: 40px" />
            </div>
            <h2 class="fw-bold text-center mb-4">ООО {{ config('app.name') }} <img src="/img/about/offer.png" style="width: 80px" alt="offer" /></h2>
            <hr class="bar" />
            <div class="row">
                <div class="col-md-6">
                    <img src="/img/carr.png" alt="mercedes" style="width: 100%; height: auto;" />
                </div>
                <div class="col-md-6">
                    <p class="text-justify">
                        <strong>Prospekt Parts</strong> — крупнейший дистрибьютор оригинальных автомобильных запасных частей, 
                        компонентов и расходных материалов на рынке Восточной Европы. Также присутствует большое количество <strong>Аналогов.</strong> 
                        Компания ведет отсчет своей истории с 2019 года и на сегодняшний день располагает 
                        развитой филиальной сетью в Российской Федерации и Турции.                    
                    </p>
                    <p class="text-justify">
                        В ассортименте компании представлены запасные части для наиболее распространенных грузовых автомобилей, 
                        созданных в соответствии со стандартами Евро 4 и Евро 5.
                    </p>
                    <p class="text-justify">
                        Интернет-магазин «Prospekt Parts» предлагает широкий выбор запасных частей для грузовых автомобилей 
                        европейских марок. Товарное предложение включает более <strong>200 000 тысяч</strong> артикулов запасных частей для 
                        европейских автомобилей — <em>Volvo</em>, <em>Renault</em>, <em>DAF</em>, <em>Mercedes-Benz</em>, <em>MAN</em>.
                    </p>
                    <p class="text-justify">
                        Гарантируем, <strong>поиск запчастей</strong> и/или расходных материалов, будет для вас <u>лёгким и быстрым</u>.  
                        Чтобы получить нужную позицию, введите номер артикула или наименование детали и наша поисковая система
                        найдёт все запрашиваемые варианты. Мы оказываем онлайн консультацию по подбору имеющихся в наличии
                        запасных частей для грузовых автомобилей. Для позиций, которых нет в наличии, мы оформляем предзаказ,
                        на случай, когда вы можете подождать получение товара.
                    </p>
                    <p><strong>P.S.</strong> Все запчасти с быстрой доставкой находятся в Московской области, г. Мытищи.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

   
</section>

<section class="bg-body-tertiary" style="
    padding-top: 50px;">
    
    <div class="container">
        <div class="row">
            <div class="text-center col-12">
               <!--  <h2 class="text-primary m-0 text">Мы занимаемся</h2>  -->
                <h2 class="fw-bold">Основная деятельность компании</h2> 
                <hr class="bar mb-5">
            
            <video controls class="w-100 ratio-16x9 rounded">
              <source src="/img/mediaProspektParts.mp4" type="video/mp4" />
            </video>
            </div>
        </div>
        
        <div class="row g-2" style="
    padding-top: 20px;">
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/goods.png" 
                            alt="Продажа" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%);height: auto; opacity: 1" 
                        /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Продажа</h5>
                        <p class="text-muted">
                            только оригинальных запасных частей для грузовых автомобилей
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm  h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/manufacturer.png" 
                            alt="Диагностика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%);height: auto; opacity: 1" 
                        /> 
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Диагностика</h5>
                        <p class="text-muted">
                            и ремонт грузовых автомобилей импортного производства.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm  h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/actros___kopiya.png" 
                            alt="Импорт" 
                            class="w-75 mb-1" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Импорт</h5>
                        <p class="text-muted">
                            оригинальных запчастей для грузовых автомобилей мы закупаем напрямую у изготовителей.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/logistic.png" 
                            alt="Логистика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Логистика</h5>
                        <p class="text-muted">
                            Сами оформляем контракт и осуществляем логистику.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm  h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/customs.png" 
                            alt="Логистика" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Таможенное оформление</h5>
                        <p class="text-muted">
                            Поэтому у каждого нашего товара есть <abbr title="Грузовая Таможенная Декларация" class="initialism">ГТД</abbr>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card card-data border-0 shadow-sm  h-100">
                    <div class="card-body text-center pt-5">
                        <img 
                            src="/img/about/storing.png" 
                            alt="Складирование товара" 
                            class="w-50" 
                            style="cursor: default;filter: saturate(100%); height: auto; opacity: 1" 
                        />
                        <h5 class="fw-bold mt-3" style="text-decoration: 3px underline #310062;cursor: default">Складирование товара</h5>
                        <p class="text-muted">
                            У нас собственные складские помещения.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center col-12 mt-4 col-lg-8 offset-lg-2">
                <p class="fs-3 text">
                    <sub class="text-danger fs-1">*</sub> 
                    Для наших клиентов это означает оптимальные цены на качественные запасные части из Европы.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection