@extends('layout/main')
@section('title', 'Отгрузка №'.$demand['name'])

@section('breadcrumbs')
<div class="d-flex gap-2">
    <a href="/dashboard/payment/record" class="text-muted">Отчёты</a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">Детали отчёта</span>
</div>
@endsection

@section('content')
<div class="d-flex align-items-center gap-3 d-print-none">
    @if(isset($demand['state']['color']))
    <x-badge color="{{$demand['state']['color']}}" text="{{$demand['state']['name']}}" />
    @endif
    <span class="d-flex align-items-center gap-1 text-secondary">
        <span class="material-symbols-outlined fs-5">calendar_month</span>
        {{$time::parse($demand['created'])->locale('ru')->translatedFormat('d F Y, H:i')}}
    </span>
</div>
<div class="card border-0 shadow-sm mt-4">
    <div 
        class="card-header border-0 rounded-bottom bg-white fw-bold cp d-flex align-items-center justify-content-between collapsed" 
        data-bs-toggle="collapse" 
        data-bs-target="#recipient"
    >
        <b>Получатель:</b> 
        <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="collapse" id="recipient">
        <div class="card-body text-muted border-top border-muted">
            <p><b>Компания:</b> {{$demand['agent']['name']}}</p>
            <hr />
            <p class="m-0"><b>Контактное лицо:</b> {{$demand['agent']['description']}}</p>
            <p class="m-0"><b>E-mail:</b> {{$demand['agent']['email']}}</p>
            <p class="m-0"><b>Tелефон:</b> {{$demand['agent']['phone']}}</p>        
            <hr />

            <p><b>Юридический адрес:</b> {{$demand['agent']['legalAddress']}}</p>
            <p><b>Фактический адрес:</b> {{$demand['agent']['actualAddress']}}</p>
        </div>        
    </div>
</div>


<div class="card border-0 shadow-sm mt-4">
    <div 
        class="card-header border-0 rounded-bottom bg-white fw-bold cp d-flex align-items-center justify-content-between collapsed" 
        data-bs-toggle="collapse" 
        data-bs-target="#provider"
    >
        <b>Поставщик:</b> 
        <span class="material-symbols-outlined">expand_more</span>
    </div>
    <div class="collapse" id="provider">
        <div class="card-body text-muted border-top border-muted">
            <p class="m-0"><b>Компания:</b> {{$demand['organization']['name']}}</p>
            <p class="m-0"><b>Юридический адрес:</b> {{$demand['organization']['legalAddress']}}</p>
            <p class="m-0"><b>E-mail:</b> {!!$contact::getEmail('manager@prospekt-parts.com')!!}</p>
            <hr />
            <h5>РЕКВИЗИТЫ:</h5>
            <p class="m-0">
                <b>Банк:</b> 
                {{$demand['organizationAccount']['bankName']}}, 
                {{$demand['organizationAccount']['bankLocation']}}
            </p>
            <p class="m-0"><b>БИК:</b> {{$demand['organizationAccount']['bic']}}</p>
            <p class="m-0"><b>Номер счёта:</b> {{$demand['organizationAccount']['accountNumber']}}</p>
            <p class="m-0"><b>Кор.счёт:</b> {{$demand['organizationAccount']['correspondentAccount']}}</p>
        </div>        
    </div>

</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white fw-bold">
        Позиции заказа: 
        <span class="badge bg-soft-danger text-danger rounded-circle ms-1">
            {{$demand['positions']['meta']['size']}}
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
            @foreach($demand['positions']['rows'] as $item)
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
            <tr>
                <td class="border-0" colspan="4"></td>
                <td class="border-0 text-end fw-bold">Итого:</td>
                <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($demand['sum'])!!}</td>
            </tr>                  
            <tr>
                <td class="border-0" colspan="4"></td>
                <td class="border-0 text-end fw-bold">В том числе НДС 20%:</td>
                <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($demand['vatSum'])!!}</td>
            </tr>   
            <tr>
                <td class="border-0" colspan="4">
                    @if($demand['state']['name'] === 'Не оплачено')
                        <x-button
                            type="button" 
                            color="dark" 
                            text="Оплатить" 
                            icon="credit_card" 
                            data-bs-toggle="modal" 
                            data-bs-target="#manager" 
                        />
                    @else
                        <x-button
                            type="button" 
                            color="light" 
                            text="Отгрузка" 
                            icon="credit_score"
                        />
                    @endif
                </td>
                <td class="border-0 text-end fw-bold">Всего к оплате:</td>
                <td class="border-0 text-end pe-4 fw-bold">{!!$currency::summa($demand['sum'])!!}</td>
            </tr>               
        </tbody>
    </table>

</div>

<pre><?php // var_dump($demand);?></pre>
@endsection