@extends('layout/main')
@section('title', 'Предзаказ №'.$pre['name'])

@section('breadcrumbs')
<div class="d-flex gap-2">
    <a href="/dashboard/payment/preorders" class="text-muted">Предзаказы</a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">Детали предзаказа</span>
</div>
@endsection

@section('content')
<div class="d-flex align-items-center">
    <x-badge color="{{$pre['state']['color']}}" text="{{$pre['state']['name']}}"/>
    <span class="d-flex align-items-center gap-2 ms-2 ms-sm-3 text-secondary">
        <span class="material-symbols-outlined">calendar_month</span> 
        {{$time::parse($pre['created'])->locale('ru')->translatedFormat('d F Y, H:i:s')}}
    </span>
</div>

<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-white fw-bold">
                Позиции заказа: 
                <span class="badge bg-soft-danger text-danger rounded-circle ms-1">
                    {{$pre['positions']['meta']['size']}}
                </span>
            </div>
            <table class="table table-hover m-0">
                <thead class="bg-light">
                    <tr>
                        <th scope="col" class="text-muted ps-4">№</th>
                        <th scope="col" class="text-muted">Товары</th>
                        <th scope="col" class="text-muted text-center">Кол-во</th>
                        <th scope="col" class="text-muted">Ед.</th>
                        <th scope="col" class="text-muted text-end">Цена</th>
                        <th scope="col" class="text-muted text-end pe-4">Сумма</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pre['positions']['rows'] as $item)
                    <tr class="align-middle cp" onclick="getStartLink(`/dashboard/product/details/{{$item['assortment']['id']}}`)">
                        <td class="ps-4">{{$loop->iteration}}</td>
                        <td>
                            <small>
                                <b>{{$item['assortment']['code']}}</b>&#160;&#160;
                                {{$item['assortment']['name']}}                    
                            </small>
                        </td>
                        <td class="text-center">{{$item['quantity']}}</td>
                        <td class="text-start">шт.</td>
                        <td class="text-end">
                            <small>
                            @php echo number_format(($item['price']) / 100, 2, '.', ' ') @endphp ₽
                            </small>
                        </td>
                        <td class="text-end pe-4">
                            <small>
                            @php echo number_format(($item['price']*$item['quantity']) / 100, 2, '.', ' ') @endphp ₽
                            </small>
                        </td>
                    </tr>
                    @endforeach  
                    <tr style="font-size:13px">
                        <td class="border-0" colspan="4"></td>
                        <td class="border-0 text-end fw-bold">Итого:</td>
                        <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($pre['sum'])!!}</td>
                    </tr>                  
                    <tr style="font-size:13px">
                        <td class="border-0" colspan="4"></td>
                        <td class="border-0 text-end fw-bold">В том числе НДС 20%:</td>
                        <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($pre['vatSum'])!!}</td>
                    </tr>   
                    <tr style="font-size:13px">
                        <td class="border-0" colspan="4"></td>
                        <td class="border-0 text-end fw-bold">Всего к оплате:</td>
                        <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($pre['sum'])!!}</td>
                    </tr>               
                </tbody>
            </table>
        </div>
        @if(isset($pre['deliveryPlannedMoment']))
        <p class="d-flex gap-2 align-items-center mt-4">
            <span class="material-symbols-outlined text-muted">update</span> 
            <b>Запланированное время доставки:</b>  
            {{$time::parse($pre['deliveryPlannedMoment'])->locale('ru')->translatedFormat('d F Y, H:i')}}
        </p>
        @endif
    </div>
</div>
@endsection