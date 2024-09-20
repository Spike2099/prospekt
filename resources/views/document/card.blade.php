<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Карточка организации {{$card['name']}}</title>
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
    <div class="my-5">
        <p class="font-weight-bold text-center" style="font-size:18px">Карточка организации</p>
        <table class="table table-bordered border border-dark" style="font-size:13px">
            <tbody>
                @if (isset($card['legalTitle']))
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        Полное наименование юридического лица
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['legalTitle']}}
                    </td>
                </tr>
                @endif
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        Сокращённое наименование организации
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['name']}}
                    </td>
                </tr>
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        Юридический адрес
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['legalAddress']}}
                    </td>
                </tr>
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        Почтовый адрес
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['actualAddress']}}
                    </td>
                </tr>
                @if (isset($card['inn']))
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        ИНН
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['inn']}}
                    </td>
                </tr>
                @endif
                @if (isset($card['ogrn']))
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        ОГРН
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['ogrn']}}
                    </td>
                </tr>  
                @endif
                @if (isset($card['kpp']))
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        КПП
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['kpp']}}
                    </td>
                </tr>
                @endif
                @if (isset($card['okpo']))
                <tr class="font-weight-normal">
                    <td class="py-1 border-dark font-weight-bold" style="width:40%">
                        ОКПО
                    </td>
                    <td class="py-1 border-dark" style="width:60%">
                        {{$card['okpo']}}
                    </td>
                </tr>
                @endif
                @if (isset($card['accounts']['rows']))
                    @foreach ($card['accounts']['rows'] as $item)
                        <tr class="font-weight-normal">
                            <td class="py-1 border-dark font-weight-bold" style="width:40%">
                                Наименование банка
                            </td>
                            <td class="py-1 border-dark" style="width:60%">
                                {{$item['bankName']}}
                            </td>
                        </tr>                     
                        <tr class="font-weight-normal">
                            <td class="py-1 border-dark font-weight-bold" style="width:40%">
                                БИК банка
                            </td>
                            <td class="py-1 border-dark" style="width:60%">
                                {{$item['bic']}}
                            </td>
                        </tr>                     
                        <tr class="font-weight-normal">
                            <td class="py-1 border-dark font-weight-bold" style="width:40%">
                                Корреспондентский счёт
                            </td>
                            <td class="py-1 border-dark" style="width:60%">
                                {{$item['correspondentAccount']}}
                            </td>
                        </tr>                     
                        <tr class="font-weight-normal">
                            <td class="py-1 border-dark font-weight-bold" style="width:40%">
                                Расчётный счёт
                            </td>
                            <td class="py-1 border-dark" style="width:60%">
                                {{$item['accountNumber']}}
                            </td>
                        </tr>                     
                    @endforeach
                @endif
                @if (isset($card['description']))
                    <tr class="font-weight-normal">
                        <td class="py-1 border-dark font-weight-bold" style="width:40%">
                            Генеральный директор
                        </td>
                        <td class="py-1 border-dark" style="width:60%">
                            {{$card['description']}}
                        </td>
                    </tr>
                @endif
                @if (isset($card['email']))
                    <tr class="font-weight-normal">
                        <td class="py-1 border-dark font-weight-bold" style="width:40%">
                            Адрес электронной почты
                        </td>
                        <td class="py-1 border-dark" style="width:60%">
                            {{$card['email']}}
                        </td>
                    </tr>
                @endif
                @if (isset($card['phone']))
                    <tr class="font-weight-normal">
                        <td class="py-1 border-dark font-weight-bold" style="width:40%">
                            Телефон
                            @if (isset($card['fax']))
                             / Факс 
                            @endif
                        </td>
                        <td class="py-1 border-dark" style="width:60%">
                            {{ $contact::format_phone($card['phone']) }} 
                            @if (isset($card['fax']))
                             / {{ $contact::format_phone($card['fax']) }} 
                            @endif
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    
</body>
</html>