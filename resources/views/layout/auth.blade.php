<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ config('app.name') }}</title>
    <link rel="shortcut icon" href='/img/favicon.png' type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/jost.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pt.sans.narrow.css') }}" />

    @if ($_SERVER['REQUEST_URI'] === '/signin' || $_SERVER['REQUEST_URI'] === '/forgot-password')
    @else
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}" />    
    @endif
    
    <meta name="keywords" content="CRM, продажи, оптом" />
    <meta name="description" content="Официальный сервис «Prospekt Parts» по оптовым продажам запчастей" />
    <meta name="theme-color" content="#310062" />
    <meta name="msapplication-navbutton-color" content="#310062" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#310062" />

    <meta name="robots" content="noindex,nofollow,noarchive" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Prospekt Parts" />
    <meta property="og:image" content="/img/apple_touth_icon.jpg" />
    <meta property="og:title" content="{{ config('app.name') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:description" content="Официальный сервис «Prospekt Parts» по оптовым продажам запчастей" /> 
    
    <style>
        body, html {
            font-family: 'Nunito Sans', sans-serif;
        }
        a, .text-primary {
            color: #5051c2 !important;
        }
        .btn-primary {
            background-color: #5051c2;
            border-color: #5051c2;
        }
        .h2, h2 {
            font-size: 1.5rem !important;
        } 
        .alert small {color: #673ab7}  
        .form-control:focus {
            border-color: #212529 !important;
            outline: none !important;
            box-shadow: none !important;
        }
        #auth .alert div {font-size: 11px;}
        [v-cloak] { display:none; }
    </style>
</head>
<body class="bg-light">
    <section id="auth" class="vh-100" v-cloak>
        <div class="container h-100">
            <div class="d-flex align-items-center row h-100">
                <div class="col-md-4 offset-md-4 py-5">
                    <div class="card border-0 shadow-sm bg-white">
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                    <div class="text-center text-muted mt-2">
                        <small>
                            Если у вас есть вопросы, мы всегда рады помочь. <br />
                            Свяжитесь с нами {{ $contact::format_phone('89261009684') }} <br />
                            <a 
                                href="/contact" 
                                class="text-muted text-decoration-none" 
                                style="border-bottom: 1px dotted #999"
                            >
                                Контакты
                            </a>
                        </small>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @if ($_SERVER['REQUEST_URI'] === '/signin' || $_SERVER['REQUEST_URI'] === '/forgot-password')
    @else
    <script async src="{{ asset('js/jquery.min.js') }}"></script>
    <script async src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @endif
    @if ($_SERVER['REQUEST_URI'] === '/signup')
    <script src="{{ asset('js/cleave.js') }}"></script>
    <script src="{{ asset('js/cleave-phone.ru.js') }}"></script>
    @endif
    <script src="{{ asset('js/vue.js') }}"></script>
    <script src="{{ asset('js/defina.min.js') }}"></script>
</body>
</html>