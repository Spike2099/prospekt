@php
    $accept = '.xlsx'; //, .xlsm, .xltm, .xls, .csv
    $excel = isset($_GET['excel']) ? $_GET['excel'] : '';
    $table = $excel !== '' ? $xml::parse('./img/xml/'.$excel) : '';
    //dd($table);
    $isNull = $table ? array_filter($table, function($a){return isset($a[3]) && $a[3] == '';}) : 0;
    $complete = $table ? array_filter($table, function($a){return isset($a[3]) && $a[3] !== '';}) : 0;
    $pack = $table ? ceil(count($complete)/500)-1 : [];
@endphp

@extends('layout/main')
@section('title', 'Товары')

@section('breadcrumbs')
    <div class="d-flex gap-2 mb-2">
        <a href="/dashboard" class="text-muted">Панель</a>
        <span class="text-secondary">/</span>
        <span class="text-muted">Товары</span>
    </div>
@endsection

@section('content')
    <h6 class="text-muted">Для оприходования товаров, выберите склад и загрузите Excel таблицу.</h6>
    <div class="row" :style="stock.loading ? 'cursor: progress' : ''">
        <div class="col">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    @if ($excel === '')
                        <x-alert
                                type="warning"
                                header="Внимание: "
                                message="Принимаются форматы таблиц {{$accept}}"
                                close="true"
                        />
                    @endif

                    <div class="row @if (!$table) mt-5 @endif">
                        <div class="col col-lg-6">
                            <form name="form" action="" method="get" class="d-flex flex-column gap-3">
                                @if ($table)
                                    <label class="d-flex align-items-center gap-2">
                                        <span class="material-symbols-outlined fs-1 mx-2">pallet</span>
                                        <div class="w-100">
                                            <select
                                                    v-on:
                                                    name="stock"
                                                    class="form-select"
                                                    v-model="stock.store.id"
                                                    @change="handleStock($event)"
                                                    :style="stock.loading ? 'cursor: progress' : ''"
                                                    :disabled="{{ $table[0][1] === 'Аналог' ? 'true' : 'stock.loading ? true : false' }}"
                                            >
                                                <option value="" disabled selected>Выберите склад...</option>
                                                @foreach ($stock['rows']['stock'] as $item)
                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </label>
                                    {{--                                    <label class="d-flex align-items-center gap-2">--}}
                                    {{--                                        <span class="material-symbols-outlined fs-1 mx-2">location_on</span>--}}
                                    {{--                                        <div class="w-100">--}}
                                    {{--                                            <select--}}
                                    {{--                                                    name="country"--}}
                                    {{--                                                    class="form-select"--}}
                                    {{--                                                    v-model="stock.country.id"--}}
                                    {{--                                                    @change="handleCountry($event)"--}}
                                    {{--                                                    :style="stock.loading ? 'cursor: progress' : ''"--}}
                                    {{--                                                    :disabled="stock.loading ? true : false"--}}
                                    {{--                                            >--}}
                                    {{--                                                <option value="" disabled selected>Выберите страну...</option>--}}
                                    {{--                                                @foreach ($country['rows'] as $item)--}}
                                    {{--                                                    <option value="{{$item['id']}}">{{$item['name']}}</option>--}}
                                    {{--                                                @endforeach--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </label>--}}
                                @else
                                    <label class="d-flex align-items-center gap-2">
                                        <x-icon-excel/>
                                        <div class="w-100">
                                            <input
                                                    type="file"
                                                    name="file"
                                                    accept="{{$accept}}"
                                                    class="form-control"
                                                    @change="handleExcelFile($event)"
                                            />
                                        </div>
                                    </label>
                                @endif
                            </form>

                            @if ($table)
                                <form id="createstosck" action="/api/loadstock" method="post">
                                    @csrf
                                    <input
                                            type="hidden"
                                            name="store"
                                            :value="stock.store.id"
                                    />
                                    {{--                                <input--}}
                                    {{--                                        type="hidden"--}}
                                    {{--                                        name="country"--}}
                                    {{--                                        :value="stock.country.id"--}}
                                    {{--                                />--}}
                                    <input type="hidden" name="pack" value="{{$pack}}"/>
                                    <input type="hidden" name="loadType" value="{{$table[0][1] === 'Аналог' ? 'replacement' : 'stock'}}"/>
                                    <input type="hidden" name="file" value="{{$excel}}"/>
                                    <div v-if="{{ $table[0][1] === 'Аналог' ? 'true' : 'stock.store.id' }}">
{{--                                        {{$table[0][1] === 'Аналог'}} ||--}}
                                        {{--                                <div v-if="stock.store.id && stock.country.id">--}}
                                        <div>
                                            <hr/>
                                        </div>
                                        <div>
                                            <button
                                                    v-on:click="isCompleteStock"
                                                    type="submit"
                                                    class="btn btn-dark px-4 icon-link"
                                            >
                                                <template v-if="stock.loading">
                                                    <span class="spinner-border spinner-border-sm text-danger"></span>
                                                    &#160;Tовары загружаются на склад...
                                                </template>
                                                <template v-else>
                                                    <x-icon-download/>
                                                    Загрузить
                                                </template>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="col col-lg-6 @if (!$table) d-flex align-items-center @endif">
                            <button class="btn border-0" v-if="stock.loader">
                                <span class="spinner-border spinner-border-sm text-danger"></span>
                                Файл загружается...
                            </button>

                            @if ($table)
                                <p class="m-0"><strong>Всего товаров:</strong> {{number_format(count($table)-1)}} шт.
                                </p>
                                @if ($isNull !== 0)
                                    <p class="m-0">
                                        <strong>Товаров нет в наличии:</strong>
                                        <span class="badge text-bg-danger">{{number_format(count($isNull))}} шт.</span>
                                    </p>
                                @endif
                                @if ($complete !== 0)
                                    <p class="m-0" id="pack" data-pack="{{$pack}}">
                                        <strong>Товары в наличии:</strong> {{number_format(count($complete))}} шт.
                                    </p>
                                @endif
                                <p class="m-0" v-if="stock.store.name"><strong>Склад:</strong> @{{stock.store.name}}</p>
                                {{--                                <p class="m-0" v-if="stock.country.name"><strong>Страна:</strong>--}}
                                {{--                                    @{{stock.country.name}}</p>--}}
                                <div class="progress bg-dark-subtle mt-4" v-if="stock.loading">
                                    <div id="progress"
                                         class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                    ></div>
                                </div>
                            @else
                                <p v-if="stock.size"><strong>Размер файла:</strong> @{{stock.size}}</p>
                                <p v-if="stock.size">
                                    <button class="btn border-0">
                                        <span class="spinner-border spinner-border-sm text-danger"></span>
                                        Чтение таблицы...
                                    </button>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if ($table)
                @if (isset($table[0]) && isset($table[0][1]) && $table[0][1] === 'Аналог')
                    <!-- Таблица для Replacement -->
                    <table class="table table-striped table-hover table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Артикул</th>
                            <th scope="col">Аналог</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($table as $item)
                            @if ($item[1] !== 'Аналог')
                                <tr>
                                    <td>{{ $item[0] }}</td>
                                    <td>{{ $item[1] }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <!-- Таблица для Stock -->
                    <table class="table table-striped table-hover table-bordered mt-3">
                        <thead>
                        <tr>
                            <th scope="col">Артикул</th>
                            <th scope="col">Наименование</th>
                            <th scope="col">Количество</th>
                            <th scope="col">Цена</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($table as $item)
                            @if ($item[1] !== 'Наименование' && $item[1] !== 'Номенклатура')
                                <tr>
                                    <td>{{ $item[0] }}</td>
                                    <td>{{ $item[1] }}</td>
                                    <td>{{ $item[2] }}</td>
                                    <td>{{ $item[3] }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                @endif
            @endif
        </div>
    </div>

    {{--    <div class="row">--}}
    {{--        <div class="col">--}}
    {{--            @if ($table)--}}
    {{--                <pre><?php //var_dump($table);?></pre>--}}
    {{--                <table class="table table-striped table-hover table-bordered">--}}
    {{--                    <thead>--}}
    {{--                    <tr>--}}
    {{--                        <th scope="col">Наименование</th>--}}
    {{--                        <th scope="col">Артикул</th>--}}
    {{--                        <th scope="col">Цена</th>--}}
    {{--                        <th scope="col">Описание</th>--}}
    {{--                        <th scope="col">Страна</th>--}}
    {{--                        <th scope="col">НДС</th>--}}
    {{--                        <th scope="col">Количество</th>--}}
    {{--                    </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                    @foreach ($table as $item)--}}
    {{--                        @if ($item[1] !== 'Номенклатура' && $item[3] !== '')--}}
    {{--                            <tr>--}}
    {{--                                --}}{{-- <td contenteditable="true">{{$loop->iteration-1}}</td> --}}
    {{--                                <td contenteditable="true">{{$item[1]}}</td>--}}
    {{--                                <td contenteditable="true">{{$item[0]}}</td>--}}
    {{--                                <td contenteditable="true">{{$item[4]}}</td>--}}

    {{--                                --}}{{-- <td contenteditable="true">{{$item[21]}}</td> --}}
    {{--                                <td contenteditable="true">@{{stock.country.name}}</td> <?php // 24 ?>--}}
    {{--                                <td contenteditable="true">{{$item[25] ?? 20}}%</td>--}}
    {{--                                <td contenteditable="true">{{$item[3]}}</td>--}}
    {{--                                --}}{{-- <td contenteditable="true">{{$item[29]}}</td> --}}
    {{--                            </tr>--}}
    {{--                        @endif--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}
    {{--            @endif--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection