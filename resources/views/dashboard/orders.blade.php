@extends('layout/main')
@section('title', 'Заказы')

@section('content')
{{--<h6 class="text-muted">Всего {{$decl::custom($model['meta']['size'])}}</h6>--}}
<h6 class="text-muted">Всего {{count($model)}}</h6>
<div class="row">
    <div class="col">
        <div class="card border-0 shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white border-0">
                <form>
                    <div class="input-group input-group-merge input-group-flush">
                        <div class="input-group-prepend input-group-text bg-white border-end-0 border-light ps-2 pe-0">
                            <span class="material-symbols-outlined text-secondary fs-5">search</span>
                        </div> 
                        <input id="datatableSearch" type="search" placeholder="Поиск заказов..." class="form-control border-light border-start-0" />
                    </div>
                </form>
                <div>...</div>
            </div>
            <div class="table-responsive rounded-top">
                <table class="table table-hover m-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-3 text-muted">
                                <label style="width: 24px;">#</label>
                            </th>
                            <th class="text-muted" style="width: 70px;">
                               
                                <small>Заказ</small>
                            </th>
                            <th class="text-muted">
                                <small class="d-block" style="width: 210px">
                                    Контрагент
                                </small>
                            </th>
                            <th class="text-muted">
                                <small style="width: 124px">
                                    Статус заказа
                                </small>
                            </th>
                            <th class="text-muted">
                                <small style="width: 124px;">
                                    Сумма платежа
                                </small>
                            </th>
                            <th class="text-muted">
                                <small class="d-block" style="width: 140px">
                                    Дата заказа
                                </small>
                            </th>                            
                            <th class="text-secondary text-center" style="width: 119px;"><small>Действия</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($model as $item)
{{--                            ['rows']--}}
                        <tr class="align-middle">
                            <td class="ps-3" style="vertical-align: middle">{{$loop->iteration}}.</td>
                            <td>
                                <a href="/dashboard/payment/reports/{{$item['id']}}" class="text-decoration-none fw-bold text-dark">
                                    #{{$item['id']}}
                                </a>
                            </td>
                            <td>
                                <a href="/dashboard/payment/reports/{{$item['id']}}" class="link-dark text-decoration-none">
                                    {{$item['customer']['name']}}
                                </a>
{{--                                {{isset($item['customer']['phone']) ? $item['customer']['name'] : "Зарегестрированный покупатель"}}--}}
                            </td>
                            <td>
{{--                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />--}}
{{--                                resources/views/components/badge.blade.php тут цвет текста--}}
                                <x-badge color="{{$item['status'] === 'В работе' ? 15106326 : 34617}}" text="{{$item['status']}}" />
                            </td>
                            <td>
                                <small>
{{--                                    {!!$currency::summa($item['sum'])!!}--}}
                                    {!!$currency::summa($item['total_sum'])!!}
                                </small>
                            </td>
                            <td>
                                <small class="text-secondary">
                                {{$time::parse($item['creation_date'])->locale('ru')->translatedFormat('d F Y, H:i')}}
                                </small>
                            </td>                            
                            <td>
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="/dashboard/payment/reports/{{$item['id']}}" class="btn btn-sm material-symbols-outlined">visibility</a>
                                    <!-- <a href="#" class="btn btn-sm material-symbols-outlined">edit_note</a> -->
                                    <form action="/dashboard/orders/delete/{{$item['id']}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm material-symbols-outlined text-danger">delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
{{--                        <tr class="align-middle">--}}
{{--                            <td class="ps-3" style="vertical-align: middle">{{$loop->iteration}}.</td>--}}
{{--                            <td>--}}
{{--                                <a href="/dashboard/payment/reports/{{$item['id']}}" class="text-decoration-none fw-bold text-dark">--}}
{{--                                    #{{$item['name']}}--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="/dashboard/payment/reports/{{$item['id']}}" class="link-dark text-decoration-none">--}}
{{--                                    {{$item['agent']['name']}}--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <x-badge color="{{$item['state']['color']}}" text="{{$item['state']['name']}}" />--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <small>--}}
{{--                                    {!!$currency::summa($item['sum'])!!}--}}
{{--                                </small>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <small class="text-secondary">--}}
{{--                                    {{$time::parse($item['moment'])->locale('ru')->translatedFormat('d F Y, H:i')}}--}}
{{--                                </small>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div class="d-flex justify-content-end gap-1">--}}
{{--                                    <a href="/dashboard/payment/reports/{{$item['id']}}" class="btn btn-sm material-symbols-outlined">visibility</a>--}}
{{--                                    <a href="#" class="btn btn-sm material-symbols-outlined">edit_note</a>--}}
{{--                                    <form action="/dashboard/orders/delete/{{$item['id']}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        <button type="submit" class="btn btn-sm material-symbols-outlined text-danger">delete</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection