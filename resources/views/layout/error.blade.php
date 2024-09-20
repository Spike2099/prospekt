<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') {{ $errorCode }}</title>
    <link rel="shortcut icon" href='/img/favicon.png' type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body class="bg-dark">
    <div class="d-flex flex-column justify-content-center vh-100">
        <div class="text-center text-black align-self-center">
            <span class="text-danger material-symbols-outlined fs-1">warning</span>
            <h1 class="text-danger">{{ $title }} {{ $errorCode }}</h1>
            <p class="text-xl text-white">               
                {!! $text !!}
                <div>
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary px-5">Назад</a>
                </div>
            </p>
        </div>
    </div>
</body>
</html>