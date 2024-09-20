@extends('layout/main')

@section('title', 'MERCEDES-BENZ')
@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <span class="text-muted">{{$product['rows'][0]['pathName']}}</span>    
</div>
@endsection

@section('content')
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

<template v-if="design === 'grid'">
    <div class="row g-2 mt-3">
        @foreach($product['rows'] as $item)
        <div class="col-12" :class="[!isOpen ? 'col-lg-3' : 'col-lg-4']">
            <div class="card card-data border-0 shadow-sm order">
                @include('layout.main.ui.card.card-admin-image')
                <div class="card-body">
                    <h5 class="card-title fs-5 mb-3" style="height: 48px">
                        <a href="/dashboard/product/details/{{$item['id']}}" class="text-dark fw-bold text-decoration-none">
                            {{$item['name']}}
                        </a>
                    </h5>
                    @include('layout.main.ui.quantity.quantity-admin')
                    <div class="d-flex align-items-center justify-content-between">
                        @include('layout.main.ui.card.card-admin-article')
                        @include('layout.main.ui.button.card-admin-button')
                    </div>
                </div>
            </div>
        </div>
    
        @endforeach
        <div class="col-12 py-3">
            <div class="d-flex justify-content-between align-items-center">
                @include('layout.main.ui.selest.select-bottom-admin')
                @include('layout.main.ui.pagination.admin-pagination-view')
                @include('layout.main.ui.pagination.admin-pagination-button')
            </div>
        </div>  
    </div>
</template>
<template v-else>
    <div class="row mt-3">
        <div class="col">
            <div class="card border-0 w-100 rounded shadow-sm">
                <div class="table-responsive rounded-top">
                    <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                        <thead class="border-bottom border-light bg-body-tertiary" style="font-size: 14px">
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
                                @if(empty($item['code']) && $item['quantity'] !== 0)
                                @else
                                    <x-product-card 
                                        :id="$offset+$loop->iteration"
                                        :image="$item['id']"
                                        href="{{$item['id']}}"
                                        name="{{$item['name']}}"
                                        vendorcode="{{$item['code']}}"
                                        category="{{$item['stock_category_id'] ?? 'moysklad'}}"
                                        price="{{$item['salePrices'][0]['value']}}"
                                        availability="{{$item['quantity']}}"
                                        :modifications="$name"
                                    />
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        @include('layout.main.ui.selest.select-bottom-admin')
                        @include('layout.main.ui.pagination.admin-pagination-view')
                        @include('layout.main.ui.pagination.admin-pagination-button')
                    </div>
                </div>
            </div>
        </div>
    </div>    
</template>
@endsection