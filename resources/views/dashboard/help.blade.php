@extends('layout/main')
@section('title', 'Помощь')

@section('content')
<h6 class="text-muted">Вы можете связаться с нами по всем вашим вопросам.</h6>
<h6 class="text-muted">Все наши актуальные контакты.</h6>
<div class="row mt-4">
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex flex-column rounded">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="/img/contact/newsletter.png" style="width: 40px" alt="E-mail" />
                        <div class="d-grid gap-2">
                            <strong>По вопросам сотрудничества: </strong> 
                            {!! $contact::getEmail(config('app.email'), ['text-muted']) !!}                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Связаться с менеджером:</strong> 
                    <div class="d-flex gap-2 mt-2">
                        <x-icon-call size="22px" color="#310062"/>
                        {!! $contact::getPhone(config('app.phone'), ['text-muted']) !!}
                    </div>
                </div> 
            </div>
        </div>
    </div>    
    <div class="col-12 col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Связаться с тех.поддержкой:</strong> 
                    <div class="d-flex gap-2 mt-2">
                        <x-icon-call size="22px" color="#310062"/>
                        {!! $contact::getPhone('89261555610', ['text-muted']) !!}
                    </div> 
                </div> 
            </div>
        </div>
    </div>
    
    
    <div class="addres-ur col-12 col-lg-4 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Юридический Адрес компании:</strong> 
                    <div class="d-flex gap-2 mt-2">
                       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960" width="25px" height="25px"><path fill="#310062" d="M480.089 566Q509 566 529.5 545.411q20.5-20.588 20.5-49.5Q550 467 529.411 446.5q-20.588-20.5-49.5-20.5Q451 426 430.5 446.589q-20.5 20.588-20.5 49.5Q410 525 430.589 545.5q20.588 20.5 49.5 20.5ZM480 897q133-121 196.5-219.5T740 504q0-117.79-75.292-192.895Q589.417 236 480 236t-184.708 75.105Q220 386.21 220 504q0 75 65 173.5T480 897Zm0 79Q319 839 239.5 721.5T160 504q0-150 96.5-239T480 176q127 0 223.5 89T800 504q0 100-79.5 217.5T480 976Zm0-472Z"></path></svg>
                       <!--  {!! $contact::getPhone('89151389077', ['text-muted']) !!} --> 127282, Россия, г Москва, ул Тихомирова, 12 к 2, 156

                    </div> 
                </div> 
            </div>
        </div>
    </div>
    
        <div class="addres-ur col-12 col-lg-4 mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div>
                    <strong>Фактический адрес компании:</strong> 
                    <div class="d-flex gap-2 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960" width="25px" height="25px"><path fill="#310062" d="M480.089 566Q509 566 529.5 545.411q20.5-20.588 20.5-49.5Q550 467 529.411 446.5q-20.588-20.5-49.5-20.5Q451 426 430.5 446.589q-20.5 20.588-20.5 49.5Q410 525 430.589 545.5q20.588 20.5 49.5 20.5ZM480 897q133-121 196.5-219.5T740 504q0-117.79-75.292-192.895Q589.417 236 480 236t-184.708 75.105Q220 386.21 220 504q0 75 65 173.5T480 897Zm0 79Q319 839 239.5 721.5T160 504q0-150 96.5-239T480 176q127 0 223.5 89T800 504q0 100-79.5 217.5T480 976Zm0-472Z"></path></svg>
                       <!--  {!! $contact::getPhone('89151389077', ['text-muted']) !!} --> 141006, г.Мытищи , 4536-й проезд, стр. 10

                    </div> 
                </div> 
            </div>
        </div>
    </div>
    

</div>
@endsection