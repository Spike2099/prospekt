{{-- @php
    $table = $xml::parse('img/goods/promo/'.$stock.'/GEARAX.xlsx');
    $tables = $xml::parse('img/goods/promo/'.$stock.'/GEARAX.xlsx', true);
@endphp --}}

@extends('layout/main')
@section('title', $model['header'])

@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>   
    <span class="text-secondary">/</span>
    <span class="text-muted">Промо-материалы</span>    
    <span class="text-secondary">/</span>
    <span class="text-muted">{{$model['brand']}}</span>    
</div>
@endsection

@section('content') 
    <div class="row">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="text-muted m-0">Всего {{$product['meta']['size']}} {{$decl::cart($product['meta']['size'])}}</h6> 
                @include('layout.main.ui.selest.select-admin')
                <div>
                    <div class="btn-group">
                        <button class="btn border-0" :class="[design === 'grid' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isGrid()">
                            <x-icon-grid size="27px" />
                        </button>
                        <button class="btn border-0" :class="[design === 'line' ? 'bg-dark-subtle' : 'bg-white']" v-on:click="isLine()">
                            <x-icon-line size="27px" />
                        </button>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <div class="card border-0 w-100 rounded shadow-sm">
                        <div class="table-responsive rounded-top">
                            <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                                <thead class="border-bottom border-light bg-light-subtle" style="font-size: 14px">
                                    <tr>
                                        <th class="w-60px ps-3">
                                            <div class="text-muted mb-0">#</div>
                                        </th>
                                        <th>
                                            <a 
                                                href="javascript: void(0);" 
                                                data-sort="name" 
                                                class="text-muted text-decoration-none" 
                                                style="display: block; width: 250px;"
                                            >
                                                Название <span class="list-sort"></span>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript: void(0);" class="d-block text-muted text-decoration-none" style="width: 120px">
                                                Артикул<span class="list-sort"></span>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript: void(0);" class="d-block text-muted text-decoration-none" style="width: 80px">
                                                Цена<span class="list-sort"></span>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript: void(0);" class="d-block text-muted text-decoration-none" style="width: 85px">
                                                Наличие<span class="list-sort"></span>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="javascript: void(0);" class="text-muted text-decoration-none" style="width: 160px">
                                                Бренд<span class="list-sort"></span>
                                            </a>
                                        </th>
                                        <th class="d-flex align-items-center gap-2 text-center border-0" style="width: 165px;height: 40px">
                                            Опции
                                            <span class="material-symbols-outlined fs-6 text-secondary">settings</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list" style="font-size: 14px">
                                    @foreach($product['rows'] as $item)
                                    <tr>
                                        <td>
                                            <div class="ms-2">{{$offset+$loop->iteration}}</div>
                                        </td> 
                                        <td>
                                            <a href="/dashboard/product/details/{{$item['id']}}" class="d-flex align-items-center gap-2 text-dark">
                                                <img src="{{$images::src($item['id'])}}" alt="{{$item['name']}}" class="rounded image-product border border-muted" /> 
                                                <div class="name fw-bold text-decoration-none">
                                                    {{$item['name']}}
                                                </div>
                                            </a>
                                        </td> 
                                        <td>
                                            <a href="/dashboard/product/details/{{$item['id']}}" class="text-dark text-decoration-none">
                                                {{$item['article']}}
                                            </a>
                                        </td> 
                                        <td>
                                            <small>
                                                <strong>
                                                    {!!$currency::summa($item['salePrices'][0]['value'])!!}
                                                </strong>
                                            </small>
                                        </td> 
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if($item["quantity"] === '0')
                                                    <x-badge color="danger" text="Нет в наличии" />
                                                @else
                                                    <x-badge color="34617" text="В наличии {{$item['quantity']}} шт." />
                                                @endif
                                            </div>
                                        </td> 
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if ($item['productFolder']['id'] === 'a2a12edf-1642-11ee-0a80-13ab00041ab9')
                                                    <img src="/img/partner/GMS/gms.png" alt="GMS" style="background: #efeded; border-radius: 50em; width: 30px; height: 30px">
                                                @elseif ($item['productFolder']['id'] === '254c7d33-15ba-11ee-0a80-09a00027e0da')
                                                    <img src="/img/partner/Gearax/gearax.png" alt="Gearax" style="background: #efeded; border-radius: 50em; width: 30px; height: 30px">
                                                @else
                                                    <img src="/img/guayaquillib/mercedes-benz.png" alt="MERCEDES-BENZ" style="width: 30px" /> 
                                                @endif
                                                {{-- <small style="font-size: 10px;">{{$item['productFolder']['name']}}</small> --}}
                                            </div>
                                        </td> 
                                        <td>
                                            <div
                                                id="preorder{{$item['id']}}"
                                                data-order="{{$item['id']}},{{$item['article']}},{{$item['name']}},1,{{$item['salePrices'][0]['value']}}"
                                                v-on:click="addToOrder('{{$item['id']}}')"
                                            >  
                                                <button type="button" class="btn btn-sm btn-dark px-4 d-flex align-items-center gap-2 justify-content-center">
                                                    <x-icon-add-card color="#fff" />
                                                    В корзину
                                                </button>         
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection