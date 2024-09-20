@extends('layout/main')
@section('title', 'Заказы')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
        <div class="mb-2 mb-md-0">
            <form>
                <div class="input-group input-group-merge input-group-flush">
                    <div class="input-group-prepend input-group-text bg-white border-end-0 border-light ps-2 pe-0">
                        <span class="material-symbols-outlined text-secondary fs-5">search</span>
                    </div>
                    <input id="datatableSearch" type="search" placeholder="Поиск заказов" class="form-control border-light border-start-0" />
                </div>
            </form>
        </div>
        <div class="d-grid d-sm-flex gap-2">
         
        </div>
    </div>
    <div class="table-responsive datatable-custom">
        
    <div id="datatable_wrapper" class="dataTables_wrapper no-footer">
        <table class="table table-hover table-thead-bordered mb-2">
            <thead class="bg-light">
                <tr>
                    <th class="ps-3 text-muted" style="width: 24px;">
                        <label>#</label>
                    </th>
                    <th class="text-muted"><small>Артикул</small></th>
                    <th class="text-muted"><small>Наименование товара</small></th>
                    <th class="text-muted"><small>Количество</small></th>
                    <th class="text-muted"><small>Кто заказал</small></th>
                     <th class="text-muted"><small>Склад</small></th>
                    <th class="text-muted"><small>Цена</small></th>
                    <th class="text-muted"><small>Дата и время покупки</small></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentOrderId = null;
                @endphp
                @foreach($orders as $order)
                    @foreach($order->items as $item)
                        @if($currentOrderId !== $order->id)
                            @php
                                $currentOrderId = $order->id;
                            @endphp
                            <!-- Выводим разделитель для нового заказа -->
                            <tr style="background-color: #f2f2f2;">
                                <td colspan="8" style="text-align: left; font-weight: bold;">
                                    Заказ #{{ $order->id }} от {{ $order->creation_date }}
                                </td>
                            </tr>
                        @endif
            
                        <tr>
                            <td class="ps-3" style="vertical-align: middle">{{ $loop->iteration }}.</td>
                            <td style="vertical-align: middle">{{ $item->article }}</td>
                            <td style="vertical-align: middle">{{ $item->name }}</td>
                            <td style="vertical-align: middle">{{ $item->quantity }}</td>
                            <td style="vertical-align: middle">{{ $order->customer->name ?? 'Не указан' }}</td>
                            <td style="vertical-align: middle">{{ $item->stock_category_id ?? 'Склад не указан' }}</td>
                            <td style="vertical-align: middle">{{ number_format($item->price, 2, '.', ' ') }} руб.</td>
                            <td style="vertical-align: middle">{{ $order->creation_date }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>



        </table>
    </div>

    </div>
    <div class="card-footer bg-white border-0 pt-0">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                    <span class="text-secondary me-2">Показано:</span> 
                    <div class="tom-select-custom">
                        <select id="datatableEntries" autocomplete="off" class="border-0 form-select text-secondary w-auto">
                            <option value="12" selected="selected">12</option>
                            <option value="14">14</option>
                            <option value="16">16</option>
                            <option value="18">18</option>
                        </select>
                    </div>
                    <span class="text-secondary me-2">из</span> <span class="text-secondary">20</span>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="d-flex justify-content-center justify-content-sm-end">
                    <nav id="datatablePagination" aria-label="Activity pagination">
                        <div id="datatable_paginate" class="dataTables_paginate paging_simple_numbers">
                            <ul id="datatable_pagination" class="pagination m-0">
                                <li class="paginate_item page-item disabled">
                                    <a id="datatable_previous" class="paginate_button previous page-link">
                                        <span aria-hidden="true">←</span>
                                    </a>
                                </li>
                                <li class="paginate_item page-item active">
                                    <a class="paginate_button page-link">1</a>
                                </li>
                                       <!-- <li class="paginate_item page-item">
                                           <a class="paginate_button page-link">2</a>
                                       </li> -->
                                <li class="paginate_item page-item">
                                    <a id="datatable_next" class="paginate_button next page-link">
                                        <span aria-hidden="true">→</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>                 
@endsection