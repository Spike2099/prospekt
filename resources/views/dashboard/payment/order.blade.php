@php
    error_reporting (E_ALL ^ E_NOTICE);
    $total = $order['positions']['meta']['size'];
@endphp

@extends('layout/main')
@section('title', 'Счет №'.$order['name'])

@section('breadcrumbs')
<div class="d-flex gap-2">
    <a href="/dashboard/payment/orders" class="text-muted">Счета</a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">Детали счёта</span>
</div>
@endsection
@section('content')

@if(isset($order['state']['name']))
<x-badge color="{{$order['state']['color']}}" text="{{$order['state']['name']}}" />
@endif
<div class="row mt-2">
    <div class="col-lg-12 mb-5 mb-lg-0">
        <div class="card border-0 shadow-sm card-lg mb-5">
            <div class="card-body">
                <div class="row justify-content-lg-between">
                    <div class="col-sm order-2 order-sm-1 mb-3">
                        <div class="mb-2">
                            <img src="/img/color_logo.png" alt="Logo" style="width: 10rem" />
                        </div> 
                        <!-- <h1 class="h2 text-primary">Front Inc.</h1> -->
                    </div>
                    <div class="col-sm-auto order-1 order-sm-2 text-sm-end mb-3">
                        <div class="mb-3">
                            <h2>
                                @if(isset($order['customerOrder']['id']))
                                <abbr style="text-decoration: underline dotted">
                                    <a 
                                        href="/dashboard/payment/reports/{{$order['customerOrder']['id']}}" 
                                        class="text-decoration-none text-dark" 
                                        data-bs-toggle="tooltip" style="cursor: help"
                                        title="Перейти к заказу"
                                    >
                                        #{{$order['name']}}
                                    </a>                                    
                                </abbr>
                                @else
                                <abbr>#{{$order['name']}}</abbr>
                                @endif
                            </h2>
                            ООО "ПРОСПЕКТ ТРАНС"
                        </div> 
                        <address class="row text-muted">
                            <div class="col-6"></div>  
                            <div class="col-6">{{ config('app.address') }}</div>
                        </address>
                    </div>
                </div>

                <div class="row justify-content-md-between mb-3">
                    <div class="col-md">
                        <strong>Плательщик:</strong> 
                        <h5>{{$order['agent']['name']}}</h5>
                        @if (isset($order['agent']['legalAddress']))
                            <address class="row text-muted">
                                <div class="col-6">
                                    {{$order['agent']['legalAddress']}}
                                </div>
                                <div class="col-6"></div>
                            </address>                            
                        @endif
                    </div> 
                    <div class="col-md text-md-end">
                        <dl class="row">
                            <dt class="col-sm-8">Дата счета:</dt> 
                            <dd class="col-sm-4">{{date_format(date_create($order['created']), 'd/m/Y')}}</dd>
                            
                        </dl> 
                        <dl class="row">
                            <dt class="col-sm-8">Срок оплаты:</dt> 
                            <dd class="col-sm-4">
                                @if(isset($order['paymentPlannedMoment']))
                                {{date_format(date_create($order['paymentPlannedMoment']), 'd/m/Y')}}
                                @else
                                {{date_format(date_create($order['moment']), 'd/m/Y')}}
                                @endif
                            </dd>
                            <!-- moment -->
                        </dl>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-nowrap table-align-middle">
                        <thead class="thead-light">
                            <tr class="border-bottom border-light text-muted">
                                <th>#</th> 
                                <th>Наименование</th>
                                <th class="text-center">Кол-во</th> 
                                <!-- <th>Доступно</th>  -->
                                <th>НДС</th>
                                <th class="text-center">Скидка</th>
                                <th class="text-end">Цена</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order['positions']['rows'] as $invoice)
                            <tr class="border-bottom border-light">
                                <td>{{$loop->iteration}}</td> 
                                <th>
                                    <div>
                                        <span class="me-2">{{$invoice['assortment']['article']}}</span>
                                        <span class="fw-light">{{$invoice['assortment']['name']}}</span>
                                    </div>
                                </th>
                                <td class="text-center">{{$invoice['quantity']}} шт</td>
                                <td class="table-text-end">{{$invoice['vat']}}%</td>
                                <td class="text-center">{{$invoice['discount']}}%</td>
                                <td class="text-end fw-bold">
                                    @php echo number_format(($invoice['price']) / 100, 2, '.', ' ') @endphp ₽
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr class="my-4" /> 
                <div class="row justify-content-md-end mb-3">
                    <div class="col-md-4 col-lg-5">
                        <div class="mb-3 text-secondary">
                            <p>Если у вас есть какие-либо вопросы относительно этого счета, используйте следующую контактную информацию:</p>
                            <p>{{ $contact::format_phone(config('app.phone')) }}<br />
                            {{ config('app.email') }}</p>
                        </div> 
                    </div>
                    <div class="col-md-8 col-lg-7">
                        <dl class="row text-sm-end">
                            <dt class="col-sm-6 text-muted">Промежуточный итог:</dt> 
                            <dd class="col-sm-6">
                                @php echo number_format(($order['sum']) / 100, 2, '.', ' ') @endphp ₽
                            </dd> 
                            <dt class="col-sm-6 text-muted">Кол-во:</dt> 
                            <dd class="col-sm-6">{{$total}}</dd> 
                            <dt class="col-sm-6 text-muted">НДС:</dt> 
                            <dd class="col-sm-6">
                                @php echo number_format(($order['vatSum']) / 100, 2, '.', ' ') @endphp ₽
                            </dd> 
                            <dt class="col-sm-6 text-muted">Итого:</dt> 
                            <dd class="col-sm-6 fw-bold">
                                @php echo number_format(($order['sum']) / 100, 2, '.', ' ') @endphp ₽
                            </dd>  
                        </dl>
                    </div>
                </div>
                Всего {{$total}} {{$decl::name($total)}}, 
                на сумму {!! $currency::rub(number_format(($order['sum']) / 100, 2, '.', '')) !!} 
                <hr />
                <p class="small mb-0">© 2021 {{ config('app.name') }}.</p>

            </div>
        </div>

        <div class="d-flex justify-content-end d-print-none gap-3">
            <x-button 
                type="a" 
                size="sm" 
                color="dark"
                href="javascript:;" onclick="window.print(); return false;" 
                text="Распечатать" 
                icon="print" 
            />    
            <x-button 
                type="a" 
                size="sm" 
                color="danger"
                href="/dashboard/doc/{{$id}}/{{time()}}.pdf" 
                text="Скачать в PDF" 
                icon="picture_as_pdf" 
            />   
            
        </div>
    </div>
</div>
@endsection