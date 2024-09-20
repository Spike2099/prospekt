<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Счет покупателю №{{$order['name']}}</title>
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
    <div class="my-5 px-5">       
        <table class="table table-bordered border border-dark" style="font-size:12px">
            <tbody>
                <tr>
                    <td class="px-1 py-0 border-bottom-0 border-dark" colspan="2" style="width:55%">
                        {{$order['organization']['accounts']['rows'][1]['bankName']}}&#160;
                        {{$order['organization']['accounts']['rows'][1]['bankLocation']}}
                    </td>
                    <td class="px-1 py-0 border-dark" style="width:70px">БИК</td>
                    <td class="px-1 py-0 border-bottom-0 border-dark">
                        {{$order['organization']['accounts']['rows'][1]['bic']}}
                    </td>
                </tr>
                <tr>
                    <td class="px-1 pb-0 pt-2 border-top-0 border-dark" colspan="2" valign="bottom">
                        <small>Банк получателя</small>
                    </td>
                    <td class="px-1 py-0 border-dark">Сч. №</td>
                    <td class="px-1 py-0 border-top-0 border-dark">
                        {{$order['organization']['accounts']['rows'][1]['correspondentAccount']}}
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-0 border-dark">
                        ИНН &nbsp; {{$order['organization']['inn']}}
                    </td>
                    <td class="px-1 py-0 border-dark">КПП &nbsp; {{$order['organization']['kpp']}}</td>
                    <td class="px-1 py-0 border-dark" rowspan="2">Сч. №</td>
                    <td class="px-1 py-0 border-dark" rowspan="2">
                        {{$order['organization']['accounts']['rows'][1]['accountNumber']}}
                    </td>
                </tr>
                <tr>
                    <td class="px-1 py-0 border-dark" colspan="2">
                        <p class="mb-1">{{$order['organization']['name']}}</p>
                        <small>Получатель</small>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="p-0" class="font-weight-bold">
            Счёт на оплату №{{$order['name']}} от {{$time::parse($order['created'])->locale('ru')->translatedFormat('d F Y')}} г.
        </p>
        <hr class="border border-dark" />
        <table class="table table-borderless m-0">
            <tbody>
                <tr>
                    <td class="font-weight-normal px-1" style="font-size:12px;width:100px">Поставщик<br />(Исполнитель):</td>
                    <td class="font-weight-bold" style="font-size:12px;">
                        {{$order['organization']['name']}}, 
                        ИНН {{$order['organization']['inn']}}, 
                        КПП {{$order['organization']['kpp']}}, 
                        {{$order['organization']['legalAddress']}}
                    </td>
                <tr> 
                <tr>
                    <td class="font-weight-normal px-1" style="font-size:12px;">Покупатель<br />(Заказчик):</td>
                    <td class="font-weight-bold" style="font-size:12px;">
                        {{$order['agent']['name']}}, 
                        {{isset($order['agent']['inn']) ? 'ИНН '.$order['agent']['inn'].', ' : ''}}
                        {{isset($order['agent']['kpp']) ? 'КПП '.$order['agent']['kpp'].', ' : ''}} 
                        {{$order['agent']['actualAddress']}}
                    </td>
                <tr>  
                <tr>
                    <td class="font-weight-normal px-1" style="font-size:12px">Основание:</td>
                    <td class="font-weight-bold" style="font-size:12px;">
                    @if(isset($order['contract']))
                        Договор №{{$order['contract']['name']}}&#160; 
                        от {{date_format(date_create($order['customerOrder']['created']), 'd.m.Y')}}
                        &#160;/ Заказ MS-{{$order['customerOrder']['name']}}
                    @else
                        Без договора
                    @endif
                    </td>
                <tr> 
            </tbody>
        </table>
        <table class="table tables table-bordered border-0">
            <thead style="font-size:12px;border-left: 2px solid #000;border-right: 2px solid #000">
                <tr class="border-dark">
                <th class="px-1 py-0 text-center border-dark border-bottom-0">№</th>
                <th class="px-1 py-0 text-center border-dark border-bottom-0">Товары (работы, услуги)</th>
                <th class="px-1 py-0 text-center border-dark border-bottom-0">Кол-во</th>
                <th class="px-1 py-0 text-center border-dark border-bottom-0">Ед.</th>
                <th class="px-1 py-0 text-center border-dark border-bottom-0">Цена</th>
                <th class="px-1 py-0 text-center border-dark border-bottom-0">Сумма</th>
                </tr>
            </thead>
            <tbody style="font-size:12px">
                @foreach($order['positions']['rows'] as $invoice)
                <tr class="font-weight-normal" style="font-size:12px;border-left: 2px solid #000 !important;border-right: 2px solid #000">
                    <td class="px-1 py-0 text-center border-dark">{{ $loop->iteration }}</td>
                    <td class="px-1 py-0 border-dark"><b>{{$invoice['assortment']['article']}}</b>&#160; {{$invoice['assortment']['name']}}</td>
                    <td class="px-1 py-0 text-right border-dark">{{$invoice['quantity']}}</td>
                    <td class="px-1 py-0 border-dark">шт</td>
                    <td class="px-1 py-0 text-right border-dark">
                        @php echo number_format(($invoice['price']) / 100, 2, '.', ' ') @endphp
                    </td>
                    <td class="px-1 py-0 text-right border-dark">
                        @php echo number_format(($invoice['price']*$invoice['quantity']) / 100, 2, '.', ' ') @endphp
                    </td>
                </tr>
                @endforeach 
                <tr class="border-0 font-weight-bold tables-top">
                    <td colspan="2" class="border-0"></td>
                    <td colspan="3" class="border-0 text-right px-1">
                        <p class="mb-1">Итого:</p>
                        <div class="mb-1">В том числе НДС 20%:</div>
                        <p class="m-0">Всего к оплате:</p>
                    </td>
                    <td class="border-0 text-right px-1">
                        <p class="mb-1">@php echo number_format(($order['sum']) / 100, 2, '.', ' ') @endphp</p>
                        <p class="mb-1">@php echo number_format(($order['vatSum']) / 100, 2, '.', ' ') @endphp</p>
                        <p class="m-0">@php echo number_format(($order['sum']) / 100, 2, '.', ' ') @endphp</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <p class="font-weight-normal m-0" style="font-size:12px;">
            Всего {{$order['positions']['meta']['size']}} {{$decl::name($order['positions']['meta']['size'])}}, 
            на сумму @php echo number_format(($order['sum']) / 100, 2, '.', ' ') @endphp руб.
        </p>
        <p class="mb-2 font-weight-bold" style="font-size:13px;">{!! $currency::rub(number_format(($order['sum']) / 100, 2, '.', '')) !!}</p>
        <p class="font-weight-normal m-0" style="font-size:12px;">
            Оплатить не позднее&#160;
            {{$timer::addDays($order['moment'], 3)}}
        </p>
        <p class="font-weight-normal" style="font-size:12px;">
            Оплата данного счёта означает согласие с условиями поставки товара. 
            Уведомление об оплате обязательно, в противном случае не гарантируется наличие товарана складе. 
            Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, 
            при наличии доверенности и паспорта.<br />
        </p>
        <hr class="border border-dark" />
        <table class="table table-bordered border-0 mt-4">
            <tbody>
                <tr class="border-0">
                    <td class="px-1 py-0 border-0 font-weight-bold" style="font-size:12px;width: 15%">
                        Руководитель
                    </td>
                    <td  style="font-size:11px" class="px-1 py-0 text-right border-top-0 border-left-0 border-right-0 border-dark font-weight-normal">
                        {{$decl::nc($order['organization']['director'])}}
                    </td>
                    <td class="border-0" style="width: 2%"></td>
                    <td class="px-1 py-0 border-0 font-weight-bold" style="font-size:12px;width: 15%">
                        Бухгалтер
                    </td>
                    <td  style="font-size:11px" class="px-1 py-0 text-right border-top-0 border-left-0 border-right-0 border-dark font-weight-normal">
                        {{$decl::nc($order['organization']['director'])}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>