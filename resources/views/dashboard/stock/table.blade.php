@php
    // $key = array_search('A0000920610', $json, true);
    // $key = array_filter($json, function($a){return $a["article"] == 'A5412002301-129';});
    // $test = empty($key) ? 0 : array_values($key)[0]['volume'];
@endphp

@extends('layout/main')
@section('title', 'Результат оприходования')

@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>
    <span class="text-secondary">/</span>
    <a href="/dashboard/admin/posting" class="text-muted">
        Загрузить Товары
    </a>     
    <span class="text-secondary">/</span>
    <span class="text-muted">Результат оприходования</span>
</div>
@endsection

@section('content')

        <h3>Оприходование прошло успешно</h3>
    
    @if (session('answer'))
        <x-alert 
            type="{{session('answer')['type']}}" 
            header="{{session('answer')['header']}}" 
            message="{{session('answer')['message']}}" 
        />
    @endif

    @if (session('result'))
        <pre><?php // var_dump()?></pre>
        <figure class="bg-white p-3 shadow-sm rounded">
            <blockquote class="blockquote">
                <p>Записано и обновлено {{count(session('result'))}} товаров.</p>
            </blockquote>
            <figcaption class="blockquote-footer mb-0">Товары без количества обработаны не были.</figcaption>
        </figure>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Артикул</th>
                    <th scope="col">Цена</th>
                    <th scope="col">НДС</th>
                    <th scope="col">Количество</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('result') as $item)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['article']}}</td>
                    <td>{{$currency::rubl($item['salePrices'][0]['value'])}}</td>
                    <td>{{$item['vat']}}%</td>
                    <td>{{$item['volume']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection