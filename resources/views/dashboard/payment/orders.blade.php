@extends('layout/main')
@section('title', 'Счета')

@section('content')

@if(session('message'))
    <x-alert type="success" close="false" message="{{ session('message') }}" />
@endif
<div class="row mt-2">
    <div class="col-md-12">
        <div class="card bg-white border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                <form>
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text bg-white border-end-0 border-light ps-2 pe-0">
                            <span class="material-symbols-outlined text-secondary fs-5">search</span>
                        </div> 
                        <input id="datatableSearch" type="search" placeholder="Поиск счетов..." class="form-control border-light border-start-0" />
                    </div>
                </form>
                <div class="dropdown">
                    <button id="showHideDropdown" data-bs-toggle="dropdown" class="d-flex align-items-center gap-1 btn btn-white btn-sm w-100">
                        <span class="material-symbols-outlined text-secondary fs-6">table</span>
                        Столбцы
                        <span class="badge bg-soft-dark text-dark rounded-circle ms-1">7</span>
                    </button> 
                    <div aria-labelledby="showHideDropdown" class="dropdown-menu dropdown-menu-end dropdown-card" style="width: 15rem">
                        <div class="card card-sm border-0">
                            <div class="card-body py-1 pe-0">
                                <div class="d-grid gap-2 ms-2">
                                    <label for="toggleColumn_order" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Заказ</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_order" checked="checked" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_date" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Дата</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_date" checked="checked" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_payment_status" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Статус платежа</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_payment_status" checked="checked" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_fulfillment_status" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span>Статус выполнения</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_fulfillment_status" checked="checked" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_payment_method" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Способ оплаты</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_payment_method" checked="checked" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_total" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Всего</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_total" class="form-check-input" />
                                        </span>
                                    </label> 
                                    <label for="toggleColumn_actions" class="row form-check form-switch">
                                        <span class="col-8 col-sm-9 ms-0">
                                            <span class="me-2">Действия</span>
                                        </span> 
                                        <span class="col-4 col-sm-3 text-end">
                                            <input type="checkbox" id="toggleColumn_actions" checked="checked" class="form-check-input" />
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="ps-3 text-muted">#</td>
                            <th scope="col" class="text-muted"><small class="ms-3">№ Заказа</small></th>
                            <th scope="col" class="text-muted"><small>Дата заказа</small></th>
                            <!-- <th scope="col" class="text-muted"><small>Контрагент</small></th> -->
                            <th scope="col" class="text-muted"><small>Сумма</small></th>
                            <th scope="col" class="text-muted"><small>План. дата оплаты</small></th>
                            <th scope="col" class="text-muted"><small>Оплачено</small></th>
                            <th scope="col" class="text-muted"><small>Статус</small></th>
                            <th scope="col" style="width: 190px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders['list'] as $ord)
                        <tr class="align-middle">
                            <td class="ps-3" style="vertical-align: middle">{{$loop->iteration}}.</td>
                            <td>
                                <a href="order/{{$ord['id']}}" class="ms-3 text-decoration-none fw-bold text-dark">
                                    #{{$ord['name']}}
                                </a>
                            </td>
                            <td>
                                <small class="text-secondary">
                                {{$time::parse($ord['created'])->locale('ru')->translatedFormat('d F Y, H:i')}}
                                </small>
                            </td>
                            <!-- <td><small>{{--$ord['agent']['name']--}}</small></td> -->
                            <td>
                                <small>
                                    {!!$currency::summa($ord['sum'])!!}
                                </small>
                            </td>
                            <td>
                                <small class="text-secondary">
                                @if($ord['paymentPlannedMoment'] === 'Нет данных')
                                    {{$time::parse($ord['moment'])->locale('ru')->translatedFormat('d F Y')}}
                                @else
                                    {{$time::parse($ord['paymentPlannedMoment'])->locale('ru')->translatedFormat('d F Y')}}
                                @endif
                                </small>
                            </td>
                            <td>
                                @php echo number_format(($ord['payedSum']) / 100, 2, '.', ' ') @endphp ₽
                            </td>
                            <td>
                                <x-badge color="{{$ord['state']['color']}}" text="{{$ord['state']['name']}}" />
                            </td>
                            <td>
                                <x-button 
                                    type="a" 
                                    size="sm" 
                                    color="dark"
                                    href="/dashboard/doc/{{$ord['id']}}/{{$ord['name']}}.pdf"
                                    text="Скачать в PDF" 
                                    icon="download" 
                                />
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0">
                <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                            <span class="text-secondary me-2">Показано:</span> 
                            {{$orders['count']}}
                            <!-- <div class="tom-select-custom">
                                <select id="datatableEntries" autocomplete="off" class="border-0 form-select text-secondary w-auto">
                                    <option value="12" selected="selected">12</option> 
                                    <option value="14">14</option> 
                                    <option value="16">16</option> 
                                    <option value="18">18</option>
                                </select>
                            </div>  -->
                            <span class="text-secondary mx-2">из</span> 
                            <span class="text-secondary">{{$orders['count']}}</span>
                        </div>
                    </div> 
                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- <nav id="datatablePagination">
                                <div id="datatable_paginate">
                                    <ul id="datatable_pagination" class="pagination m-0">
                                        <li class="paginate_item page-item disabled">
                                            <a id="datatable_previous" class="paginate_button previous page-link">
                                                <span aria-hidden="true">Пред.</span>
                                            </a>
                                        </li> 
                                        <li class="paginate_item page-item active">
                                            <a class="paginate_button page-link">1</a>
                                        </li> 
                                        <li class="paginate_item page-item">
                                            <a class="paginate_button page-link">2</a>
                                        </li> 
                                        <li class="paginate_item page-item">
                                            <a id="datatable_next" class="paginate_button next page-link">
                                                <span aria-hidden="true">След.</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </nav> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection