<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Договор поставки запасных частей №{{$contract['name']}}</title>
    <link rel="shortcut icon" href="{{ asset('img/prospectdesktopicon.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" />
    <style type="text/css">
        @page {
            margin: 20px;
        }
        @font-face {
            font-family: 'Prospekt-Trans';           
            src: local('Prospekt-Trans'), url('/fonts/arialuni.ttf') format('ttf');
            font-weight: normal;
            font-style: normal;

        }   
        .tables {border-top: 2px solid #000 !important} 
        .tables-top {border-top: 2px solid #000 !important}
        * {
            font-family: 'Prospekt-Trans', "DejaVu Sans", sans-serif !important;
        }
    </style>
</head>
<body>
    <div class="p-4">
        {{-- $type --}}
        @include('layout.contract.contract')
    </div>
</body>
</html>