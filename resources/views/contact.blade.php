@extends('layout/index', [
    'title' => 'Контакты | Проспект Партс',
    'keywords' => 'контакты, сервис, service, чинить, автосервис, мерседес бенц, актрос',
    'description' => 'Контактная информация компании ООО '.config('app.name'),
    'image' => 'https://prospekt-parts.com/img/5464765787695.jpg'
])

@section('title', 'Контакты')

@section('content')
<div class="w-100" style="background-image: url(/img/contactt.jpeg); background-position: center -313px; background-attachment: fixed; background-size: cover; height: 250px; text-shadow: 1px 2px 3px #000">
    <div class="d-flex align-items-center justify-content-center h-100" style="background-color: rgb(0 0 0 / 62%)">
        <h2 class="text-white pt-5 mb-0">Контакты</h2>
    </div>
</div>
<!-- <section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row text">
                    <div class="col-12 col-md-4">
                        
                    <div class="info_container">
                        <h3 class="text-dark mb-4">ООО {{ config('app.name') }}</h3>
                        <p><strong>ИНН:</strong> 9715447266</p>
                        <p><strong>ОГРН:</strong> 1237700266726</p>
                        <p><strong>КПП:</strong> 771501001</p>
                    </div> 
                    
                <div class="addres_container mt-2">
                  <div class="d-flex flex-column p-3 mb-2 bg-white">
                            <strong>Юридический адрес:</strong> 
                            <div class="d-flex gap-1 align-items-center">
                                <x-icon-location size="25px" color="#310062"/> {{ config('app.address') }}
                            </div>
                        </div>
                        <div class="d-flex flex-column p-3 bg-white">
                            <strong>Фактический адрес:</strong> 
                            <div class="d-flex gap-1 align-items-center">
                                <x-icon-location size="25px" color="#310062"/> 141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
                            </div>
                        </div>    
                        </div>
    <iframe src="https://yandex.ru/sprav/widget/rating-badge/8347363005?type=rating" width="150" height="50" frameborder="0"></iframe>        
                        {{-- &theme=dark --}}
                        <div class="d-flex align-items-center gap-3 mt-5">
                            <div class="border p-2" style="width:100px">
                                <img src="/img/qr.png" class="w-100" alt="QR код" />
                            </div>      
                            <div>
                                <strong>QR-code Визитка</strong>  
                                <p class="m-0">для мобильного телефона.</p> 
                                <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="badge bg-dark text-decoration-none" target="_blank" rel="noopener noreferrer">
                                    Оставить отзыв
                                </a>
                            </div>                          
                        </div>
                        <div class="d-block mt-3 mb-5 mb-lg-0">
                            <a href="/doc" class="text-muted">Юридическая информация</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        
                    <div class="row g-2 mb-2">
                        <div class="contact_container">
                        <h3 class="text-dark mb-4">Контакты</h3>
                        <strong>Связаться с менеджером:</strong> 
                        <p>8 (901) 733-18-66</p>
                        <p>8 (495) 198-53-63</p>
                        <strong>Связаться с теххподержкой:</strong>
                        <p>8 (926) 155-56-10</p>
                            <div class="col-12 col-lg-6">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>Связаться с менеджером:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        {!! $contact::getPhone(config('app.phone'), ['text-muted']) !!}
                                    </div>
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        {!! $contact::getPhone('84951985363', ['text-muted']) !!}
                                    </div> 
                                </div>                                
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>Связаться с тех.поддержкой:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        {!! $contact::getPhone('89261555610', ['text-muted']) !!}
                                    </div> 
                                </div> 
                            </div>
                            {{-- <div class="col-12 col-lg-4">
                                <div class="border rounded p-3 mb-2 bg-white">
                                    <strong>По корпоративным<br /> вопросам:</strong> 
                                    <div class="d-flex gap-2 mt-2">
                                        <x-icon-call size="22px" color="#310062"/>
                                        $contact::getPhone('84957682473', ['text-muted'])
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        </div>
                        
                        
                        
                 <div class="coop_container">
                        <div class="d-flex flex-column  p-3 mb-2 bg-white">
                            <div class="d-flex gap-3 align-items-center">
                                <img src="/img/contact/newsletter.png" style="width: 40px" alt="E-mail" />
                                <div class="d-grid">
                                    <strong>По вопросам сотрудничества: </strong> 
                                    {!! $contact::getEmail(config('app.email'), ['text-muted']) !!}                                    
                                </div>
                            </div>
                        </div>
                        
                    
                    <div class="d-flex flex-column  p-3 bg-white">
                            <div class="d-flex gap-3 align-items-center">
                              <img src="/img/contact/newsletter.png" style="width: 40px" alt="E-mail" />
                        <div class="d-grid">
                            <strong>Социальные сети: </strong> 
                        </div>
                <div class="nav-item">
            <strong> YouTube </strong>
                  <a href="https://www.youtube.com/channel/UC2TKwHpX4HAFbPwaxIqNDXw" target="_blank" class="btn btn-outline-danger">
            
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                      <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408z"></path>
                    </svg>
                    <span class="visually-hidden">Button</span>
                  </a>
                </div>    
                
                    
                    <div class="nav-item">
                     <strong></strong>
                    <a href="https://wa.me/79017331866" target="_blank"  class="btn btn-success">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                      <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
                    </svg>
                                      <span class="visually-hidden">Button</span>
                                    </a>         
                    </div>
                    </div>
                            </div>
                        
                        </div>
                        
                затычка
                <div class="d-flex flex-column border rounded p-3 mb-2 bg-white">
                    <strong>Юридический адрес:</strong> 
                    <div class="d-flex gap-1 align-items-center">
                        <x-icon-location size="25px" color="#310062"/> {{ config('app.address') }}
                    </div>
                </div>
                <div class="d-flex flex-column border rounded p-3 bg-white">
                    <strong>Фактический адрес:</strong> 
                    <div class="d-flex gap-1 align-items-center">
                        <x-icon-location size="25px" color="#310062"/> 141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
                    </div>
                </div>
                
                    </div>
                </div>                
            </div>
        </div>
    </div>
</section>

<div class="bg-light border-top">
    <p class="container mb-1 text">
        <strong>Фактический Адрес:</strong> 
        <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="text-dark" target="_blank" rel="noopener noreferrer">
            141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
        </a> 
    </p>
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Acb78d2e01e4906db46d1cb905adc20776626bb0d53f91909978164445bf6ffa7&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
</div> -->
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row text">
                    <!-- Information Blocks -->
                    <div class="col-12 col-md-4">
                        <div class="info_container">
                            <h3 class="text-dark mb-4">ООО {{ config('app.name') }}</h3>
                            <p><strong>ИНН:</strong> 9715447266</p>
                            <p><strong>ОГРН:</strong> 1237700266726</p>
                            <p><strong>КПП:</strong> 771501001</p>
                        </div>
                        <div class="addres_container mt-2">
                            <div class="d-flex flex-column p-3 mb-2 bg-white">
                                <strong>Юридический адрес:</strong>
                                <div class="d-flex gap-1 align-items-center">
                                    <x-icon-location size="25px" color="#310062"/> {{ config('app.address') }}
                                </div>
                            </div>
                            <div class="d-flex flex-column p-3 bg-white">
                                <strong>Фактический адрес:</strong>
                                <div class="d-flex gap-1 align-items-center">
                                    <x-icon-location size="25px" color="#310062"/> 141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-3 mt-5">
                            <div class="border p-2" style="width:100px">
                                <img src="/img/qr.png" class="w-100" alt="QR код" />
                            </div>
                            <div>
                                <strong>QR-code Визитка</strong>
                                <p class="m-0">для мобильного телефона.</p>
                                <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="badge bg-dark text-decoration-none" target="_blank" rel="noopener noreferrer">
                                    Оставить отзыв
                                </a>
                            </div>
                        </div>
                        <div class="d-block mt-3 mb-5 mb-lg-0">
                            <a href="/doc" class="text-muted">Юридическая информация</a>
                        </div>
                    </div>

                    <!-- Contacts and Cooperation -->
                    <div class="col-12 col-md-4">
                        <div class="contact_container">
                            <h3 class="text-dark mb-4">Контакты</h3>
                            <strong>Связаться с менеджером:</strong>
                            <p>8 (901) 733-18-66</p>
                            <p>8 (495) 198-53-63</p>
                        </div>
                        <div class="coop_container">
                            <div class="d-flex flex-column  p-3 mb-2 bg-white">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="d-grid">
                                        <strong>По вопросам сотрудничества: </strong>
                                        {!! $contact::getEmail(config('app.email'), ['text-muted']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-column  p-3 bg-white">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="nav-item">
                                        <a href="https://www.youtube.com/channel/UC2TKwHpX4HAFbPwaxIqNDXw" target="_blank" class="btn btn-outline-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                                                <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408z"></path>
                                            </svg>
                                            <span class="visually-hidden">Button</span>
                                        </a>
                                    </div>
                                    <div class="nav-item">
                                        <a href="https://wa.me/79017331866" target="_blank" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                                <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.099.133 1.4 2.14 3.396 2.997.476.206.847.33 1.137.422.477.152.911.131 1.256.08.383-.057 1.17-.48 1.336-.944.166-.464.166-.86.116-.944-.05-.084-.182-.133-.38-.232z"></path>
                                            </svg>
                                            <span class="visually-hidden">Button</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Block -->
                    <div class="col-12 col-md-4">
                       <!--  <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A7da231f7b2cd113e3d9f263139c6a477c70d0cfb435cb6b71d14f3ea1e15b264&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe> -->
                            <a href="https://yandex.ru/maps/-/CCUG7IeaKC" class="text-dark" target="_blank" rel="noopener noreferrer">
                                    141006, г.Мытищи, Московская область, 4536-й проезд, стр. 10
                                </a> 
    <iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3Acb78d2e01e4906db46d1cb905adc20776626bb0d53f91909978164445bf6ffa7&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection